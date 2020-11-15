const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.disableNotifications();  // aby nie wyświetlało rożnych powiadomień 'mało istotne'

mix.browserSync({             // browserSync narzędzie do automatycznego przeładowywania strony scroll
    port: 3002,
    proxy: "larablogger.test",
    open: false,             // nie otwierać w domyślnej przeglądarce
    notify: false,           // nie wysyłaj powiadomień o zmianie pliku
});

if (!mix.inProduction()) {
    mix.webpackConfig({ devtool: "inline-source-map" }).sourceMaps();
}
mix.js("resources/js/main.js", "public/js").version();
mix.sass("resources/sass/main.scss", "public/css").version();
