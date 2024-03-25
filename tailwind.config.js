import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            width: {
                'logo': '130px', // Tamaño existente para el logo
                'dashboard-logo': '100px', // Nuevo tamaño más pequeño para el dashboard
            },
            height: {
                'logo': 'auto', // Mantener la proporción automáticamente
                'dashboard-logo': 'auto', // Para el dashboard, mantiene la proporción
            },
            // Mantén las extensiones existentes
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },
    plugins: [forms],
};
