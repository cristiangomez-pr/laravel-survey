module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  darkMode: "class",
  theme: {
    extend: {
      fontFamily: {
        sans: ["Nunito"],
        heading: ["Inter"],
      },
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
  ],
}