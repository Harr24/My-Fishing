import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php", // Pastikan semua file di dalam views terbaca
    ],
    theme: {
        extend: {
            colors: {
                ocean: "#0B4F6C",
                sun: "#FFD23F",
                coral: "#FF6B35",
                foam: "#FFF9F0",
                ink: "#14213D",
                seaweed: "#2A9D8F",
            },
            fontFamily: {
                display: ['"Space Grotesk"', ...defaultTheme.fontFamily.sans],
                body: ["Inter", ...defaultTheme.fontFamily.sans],
            },
            boxShadow: {
                brutal: "4px 4px 0px 0px #14213D",
                "brutal-hover": "2px 2px 0px 0px #14213D",
            },
            borderWidth: {
                3: "3px",
            },
        },
    },
    plugins: [forms],
};
