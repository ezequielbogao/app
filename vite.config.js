import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: [
                'resources/views/**/*.blade.php',
                'resources/css/**/*.css',
                'resources/js/**/*.js',
            ],
            // Optimiza el proceso de recarga
            refreshDebounce: 100, // Reduce el tiempo de debounce (default: 150ms)
        }),
        tailwindcss({
            // Configuración específica de Tailwind para mejor performance
            jit: true, // Just-In-Time compilation
            purge: [
                './resources/**/*.blade.php',
                './resources/**/*.js',
                './resources/**/*.vue',
            ],
        }),
    ],
    build: {
        rollupOptions: {
            external: [
                'node:perf_hooks',
                'node:fs/promises',
                'fsevents',
            ],
        },
    },
    resolve: {
        alias: {
            'fsevents': false,
        },
    },
});
