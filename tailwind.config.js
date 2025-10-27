import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    darkMode: 'class', // sötét mód váltás class alapján

    theme: {
        extend: {
            colors: {
                // 🌗 Háttérszínek
                background: {
                    light: '#f4f4f5',   // törtfehér háttér világos módban
                    dark: '#1f1f22',    // sötétszürke háttér sötét módban
                },

                // 🔳 Kártyák, dobozok
                card: {
                    light: '#ffffff',   // tiszta fehér
                    dark: '#2a2a2e',    // középszürke
                },

                // 🧭 Navigációs sáv
                nav: {
                    light: '#71747b',   // világos mód: középszürke sáv
                    dark: '#3c3e43',    // sötét mód: sötétszürke sáv
                },
                navText: {
                    light: '#ffffff',
                    dark: '#ffffff',
                },
                navHover: {
                    light: '#e5e5e5',   // világos hover
                    dark: '#d1d1d1',    // sötét hover
                },

                // 🧱 Border / vonalak
                border: {
                    light: '#d4d4d8',
                    dark: '#3f3f46',
                },

                // ✨ Szövegek
                text: {
                    light: '#1f2937',
                    dark: '#e5e7eb',
                },

                // 🔘 Gombok
                button: {
                    light: '#ffffff',
                    dark: '#4b5563',
                    hoverLight: '#f3f4f6',
                    hoverDark: '#6b7280',
                    textLight: '#000000',
                    textDark: '#ffffff',
                    borderLight: '#d4d4d8',
                    borderDark: '#6b7280',
                },

                // 🟠 Kiemelések, akciószínek (pl. aktív, fő gomb)
                accent: {
                    light: '#f97316', // narancs
                    dark: '#fb923c',  // világosabb narancs
                },
            },

            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],
};