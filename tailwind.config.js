const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require('tailwindcss/colors')

module.exports = {
    purge: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            animation: {
                'autoplay-carousel': 'scroll 40s linear infinite',
            },
            keyframes: {
                scroll: {
                  '0%': { transform: 'translateX(0)' },
                  '100%': { transform: 'translateX(calc(-250px * 7))'}
                }
            },
            colors: {
                transparent: 'transparent',
                current: 'currentColor',
                orange: colors.orange,
                fuchsia: colors.fuchsia,
                rose: colors.rose,
            },
        },
    },

    variants: {
        extend: {
            opacity: ['disabled'],
            animation: ['motion-safe'],
        },
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],

    corePlugins: {
        container: false,
    }
};
