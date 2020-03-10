let mix = require('laravel-mix');
let tailwindcss = require('tailwindcss');

const purgecss = require('@fullhuman/postcss-purgecss')({
    content: [
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
    ],
    defaultExtractor: content => content.match(/[\w-/:]+(?<!:)/g) || [],
});

mix.disableNotifications();

mix.js('resources/js/app.js', 'public/js').
    js('resources/js/service-worker.js', 'public').
    sass('resources/sass/app.scss', 'public/css').
    options({
        processCssUrls: false,
        postCss: [
            tailwindcss('./tailwind.config.js'),
            ...process.env.NODE_ENV === 'production'
                ? [purgecss]
                : [],
        ],
    });
