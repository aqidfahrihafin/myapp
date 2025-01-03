import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/filament/admin/theme.css',
                'resources/js/app.js', // atau file JS utama Anda
            ],
            refresh: true,
        }),
    ],
});
