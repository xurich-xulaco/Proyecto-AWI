import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path';

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
            '@adwavecss': path.resolve(__dirname, 'resources/vendor/ADWaveCSS/dist'),
            '@adwaveui':  path.resolve(__dirname, 'resources/vendor/ADWaveUI/dist'),
        },
    },
});
