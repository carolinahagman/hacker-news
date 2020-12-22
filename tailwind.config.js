module.exports = {
  purge: {
    mode: "layers",
    content: [".public/**/*.php"],
  },
  darkMode: "media", // or 'media' or 'class'
  theme: {
    extend: {},
  },
  variants: {
    extend: {},
  },
  plugins: [require("@tailwindcss/forms")],
};
