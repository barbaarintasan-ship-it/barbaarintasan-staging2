/**
 * Utility functions for translation handling
 */

/**
 * Checks if the language is Somali (default language)
 * @param language - Language code to check
 * @returns true if the language is Somali or not specified
 */
export function isSomaliLanguage(language: string | undefined): boolean {
  return !language || language === 'so' || language === 'somali';
}
