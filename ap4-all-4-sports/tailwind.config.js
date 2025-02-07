/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./assets/**/*.js",
    "./templates/**/*.html.twig",
  ],
  theme: {
    extend: {
      colors: {
        "eggPlant" : "#086155",
        "eggPlantHover" : "#05453c",
        "glaucous" : "#6B7FD7",
        "bitterSweet" : "#EF6461",
        "vividBlue" : "#51D6FF",
      },
      fontFamily: {
        ultra: ["Ultra", "serif"],
      },
    },
  },
  plugins: [],
}
