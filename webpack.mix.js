let mix = require('laravel-mix');
let tailwindcss = require('tailwindcss');
let glob = require('glob-all');
let PurgeCssPlugin = require('purgecss-webpack-plugin');

mix.disableNotifications();

mix.js('resources/js/app.js', 'public/js').
    js('resources/js/service-worker.js', 'public').
    sass('resources/sass/app.scss', 'public/css').
    options({
        processCssUrls: false,
        postCss: [tailwindcss('./tailwind.config.js')],
    });

if (mix.inProduction()) {
    mix.webpackConfig({
        plugins: [
            new PurgeCssPlugin({
                paths: glob.sync([
                    path.join(__dirname, 'resources/views/**/*.blade.php'),
                    path.join(__dirname, 'resources/js/**/*.js'),
                ]),
            }),
        ],
    });
}
