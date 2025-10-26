import { defineStore} from 'pinia';
import { useI18n } from 'vue-i18n';

export const useLanguageStore = defineStore('language', () => {
    const { locale } = useI18n();

    function setLanguage(lang: string) {
        locale.value = lang;
        localStorage.setItem('lang', lang);
    }

    function loadLanguage() {
        const saved = localStorage.getItem('lang');

        if (saved) {
            locale.value = saved;
        }
    }

    return { locale, setLanguage, loadLanguage };
});