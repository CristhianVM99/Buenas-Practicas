import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/user-app.js',
                'resources/js/registro-app.js',
                'resources/js/post-app.js',
                'resources/js/entidad-table.js',
                'resources/js/entidad-app.js',
                'resources/js/videos-table.js',
                'resources/js/video-app.js',
                'resources/js/admin-user-form.js',
                'resources/js/admin-user-table.js',
            ],
            refresh: true,
        }),
    ],    
});
