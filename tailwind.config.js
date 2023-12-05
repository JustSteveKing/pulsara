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
      colors: {
        primary: {
          light: '#312E81',
          dark: '#1E40AF',
        },
        secondary: {
          light: '#3B82F6',
          dark: '#60A5FA'
        },
        tertiary: {
          light: '#1E40AF',
          dark: '#1E3A8A',
        },
        silver: {
          light: '#4B5563',
          dark: '#E5E7EB'
        },
      },
      fontFamily: {
        sans: ['Figtree', ...defaultTheme.fontFamily.sans],
      },
    },
  },

  plugins: [forms],
};
