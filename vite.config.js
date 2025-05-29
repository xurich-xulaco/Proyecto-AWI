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
            '@adwavecss': 'node_modules/adwavecss/dist/styles.min.css',
            '@adwaveui':  'node_modules/adwaveui/dist/bundle/index.js',
        },
        extensions: ['.js', '.mjs'],
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
