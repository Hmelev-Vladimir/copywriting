import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
// Плагин для компиляции однофайловых компонентов Vue.
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        // Правила компиляции для Laravel.
        laravel({
            input: ['resources/js/index.js'],
            refresh: true
        }),
        // Правила компиляции для Vue.
        vue({
            template: {
                transformAssetUrls: {
                    base: "http://copywriting",
                    includeAbsolute: false
                },
            },
        }),
    ],
    // Настройки подгрузки главного SCSS-файла в компоненты Vue
    // для создания глобальных переменных, миксинов, функций и прочего.
    css: {
        preprocessorOptions: {
            scss: {
                additionalData: `@import "resources/scss/index.scss";`
            }
        }
    }
});
