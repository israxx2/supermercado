const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .copy('node_modules/vuetify/dist/vuetify.js.map', 'public/js/vuetify.js.map')
    .copy('node_modules/material-design-icons-iconfont/dist/material-design-icons.css.map', 'public/css/material-design-icons.css.map');
