import { useTranslation } from 'react-i18next';

/**
 * Custom hook to get the current language code for API calls
 * Maps i18next language codes to API-compatible format
 */
export function useLanguage() {
  const { i18n } = useTranslation();
  
  // Get current language from i18n
  const currentLang = i18n.language || 'so';
  
  // Map to API format (so -> somali, en -> english)
  const apiLang = currentLang === 'so' ? 'so' : 'en';
  
  return {
    currentLanguage: currentLang,
    apiLanguage: apiLang,
    isSomali: currentLang === 'so',
    isEnglish: currentLang === 'en',
  };
}
