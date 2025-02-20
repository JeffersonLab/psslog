import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    server: {

        hmr: {
            host: 'localhost',
        },
        watch: {
            ignored: ['./app/**', './bootstrap/**', './config/**', './database/**', './lang/**', './node_modules/**', './public/**', './routes/**', './storage/**', './tests/**', './vendor/**'],
        },
    },
    plugins: [
        laravel({
            input: 'resources/js/app.js',
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
});
