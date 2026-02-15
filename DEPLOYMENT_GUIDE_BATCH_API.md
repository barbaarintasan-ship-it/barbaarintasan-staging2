# OpenAI Batch API Implementation - Deployment Guide

## Overview

Waxaan dhamaystirney OpenAI Batch API integration oo dhammaystiran. Nidaamka cusub wuxuu u oggolyahay Barbaarintasan Academy inay samayso:

1. **Turjumaad ballaaran** - Somali → English → Arabic
2. **Soo koobid iyo ujeedooyin waxbarasho**
3. **Hagaajinta su'aalaha quiz-ka**
4. **Nidaam otomaatig ah habeenkii**

## What Was Built

### Database Tables (3 New Tables)

1. **batch_jobs** - Raadinta shaqooyinka weyn
   - Job type, status, OpenAI batch ID
   - Progress tracking
   - Error logging

2. **batch_job_items** - Raadinta items gaar ah
   - Individual lesson/quiz references
   - Request/response storage
   - Processing status

3. **translations** - Kaydinta turjumaadyada
   - Stores English and Arabic translations
   - Links to original content
   - Versioning and timestamps

### Core Features

✅ **Automated Processing**
- Runs every night at 2:00 AM East Africa Time
- Checks status every hour
- Creates translation jobs automatically
- Applies results to database

✅ **Admin API (10 Endpoints)**
- Create jobs manually
- Monitor job status
- View job details
- Process results
- Cancel jobs
- View statistics

✅ **Cost Optimization**
- 50% cheaper than regular API
- Limits concurrent jobs to 3
- Uses efficient gpt-4o-mini model
- Processes during low-traffic hours

✅ **Security**
- Admin-only access
- Input validation
- Error handling
- Secure API key management

## How to Deploy

### Step 1: Database Migration

Run this command to create the new tables:

```bash
npm run db:push
```

This will create:
- `batch_jobs`
- `batch_job_items`
- `translations`

### Step 2: Environment Variables

Make sure these are set in your `.env` file:

```bash
# Required
DATABASE_URL=postgres://...
OPENAI_API_KEY=sk-...
# OR
AI_INTEGRATIONS_OPENAI_API_KEY=sk-...

# To enable cron jobs
STAGING=false
```

### Step 3: Deploy to Fly.io

```bash
# Deploy the updated code
fly deploy

# Or if using the existing deployment pipeline
# Just push to main branch and it will auto-deploy
```

### Step 4: Verify Deployment

Check the logs to ensure cron jobs are scheduled:

```bash
fly logs
```

Look for these log messages:
```
[CRON] Cron jobs scheduled (... batch worker 2AM EAT, batch status check hourly)
```

### Step 5: Test Manually (Optional)

You can test by creating a manual job via API:

```bash
# Login as admin first, then:
curl -X POST https://your-app.fly.dev/api/admin/batch-jobs/translation \
  -H "Content-Type: application/json" \
  -d '{"limit": 5}'
```

## How It Works

### Automatic Processing (Default)

Every night at 2:00 AM:
1. System collects lessons with content
2. Creates translation batch job
3. Uploads to OpenAI
4. Waits for processing (24 hours max)

Every hour at :30 past:
1. Checks status of all pending jobs
2. Downloads completed results
3. Stores translations in database

### Manual Processing (Admin)

Admins can trigger jobs manually:
1. Log into admin panel
2. Call API endpoint (see docs)
3. Monitor progress
4. View results

## API Endpoints

All endpoints require admin authentication.

### Create Jobs

```bash
POST /api/admin/batch-jobs/translation
POST /api/admin/batch-jobs/summary
POST /api/admin/batch-jobs/quiz-improvement

Body: { "limit": 20 }
```

### Monitor Jobs

```bash
GET /api/admin/batch-jobs                    # List all jobs
GET /api/admin/batch-jobs/:id                # Get job details
GET /api/admin/batch-jobs/stats              # View statistics
POST /api/admin/batch-jobs/:id/check-status  # Check status
```

### Control Jobs

```bash
POST /api/admin/batch-jobs/:id/process-results  # Process results
POST /api/admin/batch-jobs/:id/cancel          # Cancel job
POST /api/admin/batch-jobs/check-all-status    # Check all jobs
```

## Monitoring

### Logs to Watch

Look for these tags in your logs:
- `[Batch API]` - Service operations
- `[Batch Worker]` - Background worker
- `[CRON]` - Scheduled jobs

### Expected Log Messages

**Success:**
```
[Batch Worker] Found 15 lessons for translation
[Batch API] Created translation batch job with 45 requests
[Batch API] Job status: processing (25/45)
[Batch API] Stored english translation for lesson abc123.title
```

**Errors:**
```
[Batch Worker] Error checking job xyz: ...
[Batch API] Failed to parse quiz improvement result: ...
```

## Cost Estimates

OpenAI Batch API pricing (50% discount vs regular):

**Translation (gpt-4o-mini):**
- Input: $0.075 per 1M tokens
- Output: $0.30 per 1M tokens

**Example:**
- 20 lessons × 3 fields × 2 languages = 120 requests
- Average 500 tokens per request = 60,000 tokens
- Cost: ~$0.02 per batch

**Monthly estimate:**
- 30 batches × $0.02 = $0.60/month for translations

Much cheaper than real-time API! 💰

## Troubleshooting

### Jobs Not Running

**Problem:** Batch jobs not being created automatically

**Solutions:**
1. Check `STAGING=false` in environment
2. Verify OpenAI API key is set
3. Check logs for errors
4. Ensure database migration ran successfully

### Jobs Stuck in Processing

**Problem:** Jobs stay in "processing" status

**Solutions:**
1. Run status check manually: `POST /api/admin/batch-jobs/check-all-status`
2. Check OpenAI dashboard for batch status
3. Wait up to 24 hours (OpenAI completion window)
4. Cancel and recreate if stuck

### Translations Not Appearing

**Problem:** Jobs complete but no translations in database

**Solutions:**
1. Check `translations` table in database
2. Run process results manually: `POST /api/admin/batch-jobs/:id/process-results`
3. Check logs for processing errors
4. Verify job completed successfully

### API Authentication Errors

**Problem:** 401 Unauthorized when accessing endpoints

**Solutions:**
1. Ensure logged in as admin user
2. Check session is valid
3. Verify isAdmin flag in users table
4. Try logging out and back in

## Documentation

- **Technical Details**: `server/batch-api/README.md`
- **Quick Start Guide**: `docs/BATCH_API_QUICK_START.md`
- **Implementation Summary**: `BATCH_API_IMPLEMENTATION_SUMMARY.md`
- **Security Analysis**: `BATCH_API_SECURITY_SUMMARY.md`

## Future Enhancements

Consider adding:
1. Admin UI dashboard for visual monitoring
2. Email notifications when jobs complete
3. Webhook support for real-time updates
4. Support for more languages
5. A/B testing for prompt variations
6. Automatic retry for failed items
7. Translation quality scoring

## Support

**Questions?**
- Check the documentation files
- Review server logs
- Check OpenAI Batch API docs: https://platform.openai.com/docs/guides/batch

**Issues?**
- Look for error messages in logs
- Check database for job status
- Try manual status check
- Review security summary for known issues

---

## Quick Reference

**Start using it:**
```bash
# 1. Migrate database
npm run db:push

# 2. Set environment
STAGING=false

# 3. Deploy
fly deploy

# 4. Monitor
fly logs -a your-app
```

**Create a test job:**
```bash
curl -X POST https://your-app/api/admin/batch-jobs/translation \
  -H "Cookie: connect.sid=YOUR_SESSION" \
  -H "Content-Type: application/json" \
  -d '{"limit": 5}'
```

**Check status:**
```bash
curl https://your-app/api/admin/batch-jobs \
  -H "Cookie: connect.sid=YOUR_SESSION"
```

That's it! The system will automatically process content every night. 🎉
