/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  safelist: [
    {
      pattern: /(bg|text|border|hover:bg|hover:text)-(.*)/,
    },
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}

