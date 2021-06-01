const defaultTheme = require("tailwindcss/defaultTheme");
const colors = require("tailwindcss/colors");

module.exports = {
  purge: [
    "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
    "./vendor/laravel/jetstream/**/*.blade.php",
    "./storage/framework/views/*.php",
    "./resources/views/*.blade.php",
    "./resources/views/**/*.blade.php",
  ],

  theme: {
    extend: {
      fontFamily: {
        sans: [...defaultTheme.fontFamily.sans],
        display: ["Poppins", ...defaultTheme.fontFamily.sans],
      },
    },
    colors: {
      transparent: "transparent",
      current: "currentColor",
      black: colors.black,
      white: colors.white,
      gray: colors.coolGray,
      red: colors.red,
      yellow: colors.amber,
      green: colors.emerald,
      indigo: colors.indigo,
      purple: colors.violet,
      pink: colors.pink,
      blue: {
        light: "#465BC3",
        DEFAULT: "#2A3982",
        dark: "#141C3E",
        50: "#A3ADE1",
        100: "#8492D7",
        200: "#6576CD",
        300: "#465BC3",
        400: "#374AA9",
        500: "#2A3982",
        600: "#232F6C",
        700: "#19224D",
        800: "#141C3E",
        900: "#0F142E",
      },
      orange: {
        light: "#EE9E58",
        DEFAULT: "#E98225",
        dark: "#BA6012",
        50: "#F2B47D",
        100: "#F0A96A",
        200: "#EE9E58",
        300: "#ED9345",
        400: "#EB8933",
        500: "#E97E20",
        600: "#DF7416",
        700: "#CC6A14",
        800: "#BA6012",
        900: "#A75711",
      },
    },
  },

  variants: {
    extend: {
      opacity: ["disabled"],
      borderColor: ["disabled"],
      backgroundColor: ["disabled"],
      cursor: ["disabled"],
      boxShadow: ["disabled"]
    },
  },

  plugins: [
    require("@tailwindcss/forms"),
    require("@tailwindcss/typography"),
  ],
};
