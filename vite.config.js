import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/js/app.js',
                'resources/sass/app.scss',
            ],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            '@adwavecss': 'node_modules/@ncpa0/adwavecss/css/adwave.min.css',
            '@adwaveui':  'node_modules/@ncpa0/adwaveui/dist/adwaveui.js',
        },
    },
    build: {
        rollupOptions: {
            input: {
            app: 'resources/js/app.js',
            pizzaLogo: 'resources/js/pizzaLogo.js',
            },
        },
    },
});
