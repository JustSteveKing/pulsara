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
          light: '#1E40AF',
          dark: '#312E81',
        },
        secondary: {
          light: '#60A5FA',
          dark: '#3B82F6'
        },
        tertiary: {
          light: '#1E3A8A',
          dark: '#1E40AF',
        },
        silver: {
          light: '#E5E7EB',
          dark: '#4B5563'
        },
      },
      fontFamily: {
        sans: ['Figtree', ...defaultTheme.fontFamily.sans],
      },
    },
  },

  plugins: [forms],
};
