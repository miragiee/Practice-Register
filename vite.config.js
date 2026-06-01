import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { bunny } from 'laravel-vite-plugin/fonts';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/css/main.css',
                'resources/js/main.js',
                'resources/css/company-profile.css',
                'resources/js/company-profile.js',
                'resources/js/profile-documents.js',
                'resources/css/company-request.css',
                'resources/js/company-request.js',
                'resources/css/create_internship.css',
                'resources/js/create_internship.js',
                'resources/css/catalog_of_universities.blade.css',
                'resources/js/catalog_of_universities.blade.js',
                'resources/css/auth.css',
                'resources/js/auth.js',
                'resources/css/register.css',
                'resources/js/register.js',
                'resources/css/register-step-2.css',
                'resources/css/student-profile.css',
                'resources/js/student-profile.js',
                'resources/css/students-in-search.css',
                'resources/js/students-in-search.js',
                'resources/css/university-profile.css',
                'resources/js/university-profile.js',
                'resources/css/partnerships.css',
                'resources/js/partnerships.js',
                'resources/css/admin.css',
            ],
            refresh: true,
            fonts: [
                bunny('Instrument Sans', {
                    weights: [400, 500, 600],
                }),
            ],
        }),
        tailwindcss(),
    ],
    server: {
        host: 'localhost',
        cors: true,
    },
});
