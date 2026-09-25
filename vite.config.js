import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/jsgeolinkmasivo.js',
                'resources/js/jsregistrogeolink.js'
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],

    /*** server: {
        host: '127.0.0.1',
        port: 5173,
        strictPort: true,

        // URL que utilizará el túnel
        origin: 'https://vite.cdstorage.co',

        // Permitir que Laravel local pueda comunicarse con Vite
        cors: {
            origin: [
                'http://127.0.0.1:8000',
                'https://vite.cdstorage.co',
            ],
        },

        
    },*/
    server: {
        host: '127.0.0.1',
        port: 5173,
        strictPort: true,

        origin: 'http://127.0.0.1:5173',

        cors: {
            origin: 'http://127.0.0.1:8000',
        },

        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});