import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'sass/app.scss',
                'js/app.js',
            ],
            refresh: true,
        }),
        
    ],
});
