/** @type {import('tailwindcss').Config} */
module.exports = {
  darkMode: ["class"],
  content: [
    // Correct paths for your WordPress theme
    "./*.php",
    "./inc/**/*.php",
    "./templates/**/*.php",
    "./template-parts/**/*.php",
    "./src/js/**/*.js"
  ],
  theme: {
    container: {
      center: true,
      padding: "2rem",
      screens: {
        "2xl": "1400px"
      }
    },
    extend: {
      fontFamily: {
        sans: ["Inter", "sans-serif"],
        serif: ["Lora", "serif"]
      }
    }
  },

  plugins: [
    require("tailwindcss-animate"),
    require("@tailwindcss/typography"),
    require("@tailwindcss/forms")({
      strategy: "class" // Add this strategy option
    }),
    require("daisyui")
  ],

  // Set "nord" as the one and only theme
  daisyui: {
    themes: [
      {
        nord: {
          // This imports all the default nord theme colors and variables
          ...require("daisyui/src/theming/themes")["nord"],

          // This overrides the button radius variable
          "--rounded-btn": "9999px"
        }
      }
    ]
  }
};
