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
        sans: ["Inter", "sans‑serif"],
        serif: ["Lora", "serif"]
      },
      colors: {
        // Neutrals
        light: "#D9D9DB", // for backgrounds
        dark: "#3A3B3E", // for body text / UI elements

        // Brand
        primary: "#1B3052", // deep navy for headers, navbars

        // Accents
        accent: "#2E4F7F", // medium blue for CTAs, link hovers
        support: "#7B95AB", // soft pastel blue for subtle backgrounds
        charcoal: "#1A1A1A",
        graphite: "#2E2E2E",
        anthracite: "#333333",
        "deep-navy": "#1B3052"

        // Optional pop color (use sparingly)
        // pop:    "#7067CB"
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

  // Set "nord" as the one and only daisyUI theme
  daisyui: {
    themes: [
      {
        nord: {
          // Import all the default nord theme colors and variables
          ...require("daisyui/src/theming/themes")["nord"]

          // Override button radius
          // "--rounded-btn": "9999px"
        }
      }
    ]
  }
};
