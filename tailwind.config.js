import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.jsx',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['"Plus Jakarta Sans"', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'brand-olive': '#475C39',
                'brand-cream': '#FDF8E7',
                'brand-primary': '#BD712A',
                'brand-input': '#FDF6DE',
                'brand-border': '#E5DCB3',
            }
        },
    },

    plugins: [forms],
};
