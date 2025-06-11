import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
// Плагин для компиляции однофайловых компонентов Vue.
import vue from '@vitejs/plugin-vue';
import { fileURLToPath, URL } from 'node:url';
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
                    base: "https://copywriting",
                    includeAbsolute: false
                },
            },
        }),
    ],
    resolve: {
        alias: {
            'vue': 'vue/dist/vue.esm-bundler.js',
            '@': fileURLToPath(new URL('./resources/js/vue/components', import.meta.url)),
            '#': fileURLToPath(new URL('./resources/js/vue/global', import.meta.url)),


        }
    },
    // Настройки подгрузки главного SCSS-файла в компоненты Vue
    // для создания глобальных переменных, миксинов, функций и прочего.
    css: {
        preprocessorOptions: {
            scss: {
                additionalData: `@import "resources/scss/index.scss";`
            }
        }
    },
    server:{
        cors: true,
    },
});
