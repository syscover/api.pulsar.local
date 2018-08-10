let mix = require('laravel-mix');

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

mix
    .sass('resources/assets/sass/app.scss', 'public/css')
    .js('resources/assets/js/app.js', 'public/js')
    .styles([
        'node_modules/swiper/dist/css/swiper.min.css',
        'node_modules/magnific-popup/dist/magnific-popup.css',
        'node_modules/animate.css/animate.min.css'
    ], 'public/css/all.css')
    .scripts([
        'node_modules/jquery/dist/jquery.min.js',
        'node_modules/popper.js/dist/umd/popper.min.js',
        'node_modules/bootstrap/dist/js/bootstrap.min.js',
        'node_modules/moment/moment.js',
        'node_modules/jquery-validation/dist/jquery.validate.js',
        'node_modules/jquery-validation/dist/additional-methods.js',
        'node_modules/swiper/dist/js/swiper.min.js',
        'node_modules/magnific-popup/dist/jquery.magnific-popup.js',
        'workbench/syscover/pulsar-core/src/public/vendor/territories/js/jquery.territories.js'
    ], 'public/js/all.js')
    .options({
        processCssUrls: true
    })
    .version();