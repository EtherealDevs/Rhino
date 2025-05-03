import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";
import typography from "@tailwindcss/typography";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./vendor/laravel/jetstream/**/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],

    theme: {
        extend: {
            fontFamily: {
                blinker: ["Blinker", ...defaultTheme.fontFamily.sans],
                encode: [
                    '"Encode Sans Semi Expanded"',
                    ...defaultTheme.fontFamily.sans,
                ],
                josefin: ["'Josefin Sans'", ...defaultTheme.fontFamily.sans],
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
                calsans: ['"Cal Sans"', ...defaultTheme.fontFamily.sans],
            },
            screens: {
                sm: "640px",
                // => @media (min-width: 640px) { ... }
                md: "768px",
                // => @media (min-width: 768px) { ... }
                lg: "1024px",
                // => @media (min-width: 1024px) { ... }
                xl: "1280px",
                // => @media (min-width: 1280px) { ... }
                "2xl": "1536px",
                // => @media (min-width: 1536px) { ... }
            },
        },
    },

    plugins: [forms, typography],
};
