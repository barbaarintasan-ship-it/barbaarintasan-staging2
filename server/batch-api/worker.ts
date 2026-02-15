/**
 * Background worker for collecting and processing lessons via OpenAI Batch API
 */

import { db } from '../db';
import { lessons, quizQuestions, batchJobs, translations } from '@shared/schema';
import { isNull, eq, and, sql, notInArray } from 'drizzle-orm';
import {
  createTranslationBatchInput,
  createSummaryBatchInput,
  createQuizImprovementBatchInput,
  createBatchJob,
  checkBatchJobStatus,
  processBatchJobResults
} from './service';
import type { TranslationRequest, SummaryRequest, QuizImprovementRequest } from './types';

// Configuration constants
const MAX_CONCURRENT_BATCH_JOBS = 3;
const DEFAULT_BATCH_SIZE = 20;

/**
 * Collect lessons that need translation
 * Returns lessons that don't have translations yet
 * 
 * NOTE: This currently collects all lessons with content. In production,
 * you should filter out lessons that already have translations by checking
 * the translations table to avoid re-translating content.
 */
export async function collectLessonsForTranslation(limit: number = DEFAULT_BATCH_SIZE): Promise<TranslationRequest[]> {
  // TODO: Add check for existing translations to avoid duplicates
  // Example query:
  // WHERE lesson.id NOT IN (
  //   SELECT DISTINCT entity_id FROM translations 
  //   WHERE entity_type = 'lesson' AND target_language IN ('english', 'arabic')
  // )
  
  // Get lessons that have content
  const lessonsToTranslate = await db.select({
    id: lessons.id,
    title: lessons.title,
    description: lessons.description,
    textContent: lessons.textContent
  })
  .from(lessons)
  .where(
    sql`(${lessons.title} IS NOT NULL OR ${lessons.description} IS NOT NULL OR ${lessons.textContent} IS NOT NULL)`
  )
  .limit(limit);

  return lessonsToTranslate.map(lesson => ({
    lessonId: lesson.id,
    sourceLanguage: 'somali' as const,
    targetLanguages: ['english', 'arabic'] as ['english', 'arabic'],
    fields: {
      title: lesson.title || undefined,
      description: lesson.description || undefined,
      textContent: lesson.textContent || undefined
    }
  }));
}

/**
 * Collect lessons that need summaries and learning objectives
 */
export async function collectLessonsForSummary(limit: number = 50): Promise<SummaryRequest[]> {
  // Get lessons with content
  const lessonsForSummary = await db.select({
    id: lessons.id,
    textContent: lessons.textContent,
    description: lessons.description
  })
  .from(lessons)
  .where(
    sql`(${lessons.textContent} IS NOT NULL OR ${lessons.description} IS NOT NULL)`
  )
  .limit(limit);

  return lessonsForSummary
    .filter(lesson => lesson.textContent || lesson.description)
    .map(lesson => ({
      lessonId: lesson.id,
      language: 'somali' as const
    }));
}

/**
 * Collect quiz questions that need improvement
 */
export async function collectQuizQuestionsForImprovement(limit: number = 50): Promise<QuizImprovementRequest[]> {
  // Get quiz questions
  const quizQuestionsToImprove = await db.select({
    id: quizQuestions.id,
    question: quizQuestions.question,
    options: quizQuestions.options
  })
  .from(quizQuestions)
  .where(
    and(
      sql`${quizQuestions.questionType} = 'multiple_choice'`,
      sql`${quizQuestions.options} IS NOT NULL`
    )
  )
  .limit(limit);

  return quizQuestionsToImprove.map(q => ({
    quizQuestionId: q.id,
    language: 'somali' as const
  }));
}

/**
 * Create a translation batch job for new lessons
 */
export async function createTranslationBatchJob(limit: number = 50): Promise<string | null> {
  console.log('[Batch Worker] Collecting lessons for translation...');
  
  const requests = await collectLessonsForTranslation(limit);
  
  if (requests.length === 0) {
    console.log('[Batch Worker] No lessons found for translation');
    return null;
  }
  
  console.log(`[Batch Worker] Found ${requests.length} lessons for translation`);
  
  const batchItems = await createTranslationBatchInput(requests);
  
  if (batchItems.length === 0) {
    console.log('[Batch Worker] No translation requests generated');
    return null;
  }
  
  const jobId = await createBatchJob('translation', batchItems, {
    jobType: 'translation',
    totalItems: requests.length,
    description: `Bulk translation of ${requests.length} lessons (Somali → English → Arabic)`,
    createdBy: 'automated-worker'
  });
  
  console.log(`[Batch Worker] Created translation batch job: ${jobId}`);
  
  return jobId;
}

/**
 * Create a summary generation batch job
 */
export async function createSummaryBatchJob(limit: number = 50): Promise<string | null> {
  console.log('[Batch Worker] Collecting lessons for summary generation...');
  
  const requests = await collectLessonsForSummary(limit);
  
  if (requests.length === 0) {
    console.log('[Batch Worker] No lessons found for summary generation');
    return null;
  }
  
  console.log(`[Batch Worker] Found ${requests.length} lessons for summary generation`);
  
  const batchItems = await createSummaryBatchInput(requests);
  
  if (batchItems.length === 0) {
    console.log('[Batch Worker] No summary requests generated');
    return null;
  }
  
  const jobId = await createBatchJob('summary', batchItems, {
    jobType: 'summary',
    totalItems: requests.length,
    description: `Generate summaries and learning objectives for ${requests.length} lessons`,
    createdBy: 'automated-worker'
  });
  
  console.log(`[Batch Worker] Created summary batch job: ${jobId}`);
  
  return jobId;
}

/**
 * Create a quiz improvement batch job
 */
export async function createQuizImprovementBatchJob(limit: number = 50): Promise<string | null> {
  console.log('[Batch Worker] Collecting quiz questions for improvement...');
  
  const requests = await collectQuizQuestionsForImprovement(limit);
  
  if (requests.length === 0) {
    console.log('[Batch Worker] No quiz questions found for improvement');
    return null;
  }
  
  console.log(`[Batch Worker] Found ${requests.length} quiz questions for improvement`);
  
  const batchItems = await createQuizImprovementBatchInput(requests);
  
  if (batchItems.length === 0) {
    console.log('[Batch Worker] No quiz improvement requests generated');
    return null;
  }
  
  const jobId = await createBatchJob('quiz_improvement', batchItems, {
    jobType: 'quiz_improvement',
    totalItems: requests.length,
    description: `Improve ${requests.length} quiz questions`,
    createdBy: 'automated-worker'
  });
  
  console.log(`[Batch Worker] Created quiz improvement batch job: ${jobId}`);
  
  return jobId;
}

/**
 * Check status of all pending/processing batch jobs
 */
export async function checkAllBatchJobsStatus(): Promise<void> {
  console.log('[Batch Worker] Checking status of all batch jobs...');
  
  const pendingJobs = await db.select()
    .from(batchJobs)
    .where(
      sql`${batchJobs.status} IN ('pending', 'processing')`
    );
  
  if (pendingJobs.length === 0) {
    console.log('[Batch Worker] No pending/processing jobs found');
    return;
  }
  
  console.log(`[Batch Worker] Found ${pendingJobs.length} jobs to check`);
  
  for (const job of pendingJobs) {
    try {
      await checkBatchJobStatus(job.id);
      
      // If job is completed, process results
      const [updatedJob] = await db.select()
        .from(batchJobs)
        .where(eq(batchJobs.id, job.id));
      
      if (updatedJob.status === 'completed' && updatedJob.outputFileId) {
        console.log(`[Batch Worker] Processing results for completed job ${job.id}`);
        await processBatchJobResults(job.id);
      }
    } catch (err) {
      console.error(`[Batch Worker] Error checking job ${job.id}:`, err);
      
      // Mark job as failed
      await db.update(batchJobs)
        .set({
          status: 'failed',
          error: err instanceof Error ? err.message : 'Unknown error',
          updatedAt: new Date()
        })
        .where(eq(batchJobs.id, job.id));
    }
  }
}

/**
 * Main worker function - runs all batch processing tasks
 */
export async function runBatchWorker(): Promise<void> {
  console.log('[Batch Worker] Starting batch processing worker...');
  
  try {
    // Check status of existing jobs first
    await checkAllBatchJobsStatus();
    
    // Create new batch jobs if needed (check if we have capacity)
    const activeJobs = await db.select()
      .from(batchJobs)
      .where(
        sql`${batchJobs.status} IN ('pending', 'processing')`
      );
    
    // Limit to MAX_CONCURRENT_BATCH_JOBS concurrent batch jobs to avoid overwhelming the API
    if (activeJobs.length >= MAX_CONCURRENT_BATCH_JOBS) {
      console.log('[Batch Worker] Maximum concurrent jobs reached, skipping new job creation');
      return;
    }
    
    // Create new jobs (staggered to avoid rate limits)
    // Only create translation jobs for now - can expand later
    await createTranslationBatchJob(DEFAULT_BATCH_SIZE);
    
    console.log('[Batch Worker] Batch processing worker completed');
  } catch (err) {
    console.error('[Batch Worker] Error running batch worker:', err);
  }
}
