import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
  mode: 'jit',
  content: [
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    './storage/framework/views/*.php',
    './resources/views/**/*.blade.php',
    './resources/js/**/*.vue',
  ],

  theme: {
    extend: {
      fontFamily: {
        sans: [
          'Figtree',
          ...defaultTheme.fontFamily.sans,

        ],
        "hanken-grotesk": ['Hanken Grotesk', "sans-serif"]
      },
      padding: {
        '4.375rem': '4.375rem',
      }
    },
  },

  plugins: [forms],
};
