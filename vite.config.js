import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/js/app.js',
                'resources/js/cms.js',
                'resources/js/dropzone.js',
                'resources/js/quill.js',
            ],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            '~bootstrap': path.resolve(__dirname, 'node_modules/bootstrap'),
            '~bootstrap-icons': path.resolve(__dirname, 'node_modules/bootstrap-icons'),
            '~dropzone': path.resolve(__dirname, 'node_modules/dropzone'),
            '~quill': path.resolve(__dirname, 'node_modules/quill'),
        }
    },
});
