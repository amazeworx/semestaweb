const defaultTheme = require("tailwindcss/defaultTheme");
const colors = require("tailwindcss/colors");

module.exports = {
  purge: {
    content: [
      "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
      "./vendor/laravel/jetstream/**/*.blade.php",
      "./storage/framework/views/*.php",
      "./resources/views/*.blade.php",
      "./resources/views/**/*.blade.php",
      './vendor/livewire-ui/modal/resources/views/*.blade.php',
      './storage/framework/views/*.php',
      './resources/views/**/*.blade.php',
    ],
    options: {
      safelist: [
        'sm:max-w-2xl'
      ]
    }
  },
  theme: {
    extend: {
      fontFamily: {
        sans: [...defaultTheme.fontFamily.sans],
        display: ["Poppins", ...defaultTheme.fontFamily.sans],
      },
    },
    screens: {
      'sm': '640px',
      'md': '768px',
      'lg': '1024px',
      'xl': '1280px',
      '2xl': '1440px',
      '3xl': '1536px',
    },
    fontSize: {
      '3xs': ['10px', '1.5'],
      '2xs': ['11px', '1.5'],
      xs: ['.75rem', '1.5'],
      sm: ['.875rem', '1.5'],
      base: ['1rem', '1.5'],
      lg: ['1.125rem', '1.5'],
      xl: ['1.25rem', '1.4'],
      '2xl': ['1.5rem', '1.33'],
      '3xl': ['1.875rem', '1.2'],
      '4xl': ['2.25rem', '1.1'],
      '5xl': ['3rem', '1'],
      '6xl': ['3.75rem', '1'],
      '7xl': ['4.5rem', '1'],
      '8xl': ['6rem', '1'],
      '9xl': ['8rem', '1'],
    },
    colors: {
      transparent: "transparent",
      current: "currentColor",
      black: colors.black,
      white: colors.white,
      gray: colors.blueGray,
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
