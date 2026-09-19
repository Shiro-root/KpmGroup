import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
    ],
    theme: {
        extend: {
            colors: {
                gold: {
                    50:  '#fdf8ec',
                    100: '#faedcc',
                    200: '#f4d78a',
                    300: '#edb94a',
                    400: '#e5a020',
                    DEFAULT: '#C88719',
                    600: '#a96d12',
                    700: '#87530f',
                    800: '#6e4212',
                    900: '#5c3712',
                },
                charcoal: {
                    DEFAULT: '#1C1C1E',
                    900: '#121214',
                    800: '#2a2a2e',
                    700: '#3a3a3e',
                    600: '#52525b',
                    500: '#71717a',
                    400: '#a1a1aa', // <-- Tambahkan ini (kamu bisa ganti hex-nya jika kurang pas)
                },
            },
            fontFamily: {
                display: ['"Cormorant Garamond"', 'Georgia', 'serif'],
                sans:    ['"DM Sans"', ...defaultTheme.fontFamily.sans],
                mono:    ['"JetBrains Mono"', ...defaultTheme.fontFamily.mono],
            },
            spacing: {
                'section':    '7rem',
                'section-sm': '4rem',
            },
            backgroundImage: {
                'grid-pattern': "url(\"data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23C88719' fill-opacity='0.045'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E\")",
            },
            keyframes: {
                fadeUp: {
                    '0%':   { opacity: '0', transform: 'translateY(20px)' },
                    '100%': { opacity: '1', transform: 'translateY(0)' },
                },
                fadeIn: {
                    '0%':   { opacity: '0' },
                    '100%': { opacity: '1' },
                },
                pulseGold: {
                    '0%, 100%': { opacity: '1' },
                    '50%':      { opacity: '0.4' },
                },
            },
            animation: {
                'fade-up':   'fadeUp 0.6s ease forwards',
                'fade-in':   'fadeIn 0.5s ease forwards',
                'pulse-gold': 'pulseGold 2s ease-in-out infinite',
            },
        },
    },
    plugins: [],
};