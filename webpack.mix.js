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
    .styles([
        'node_modules/bootstrap/dist/css/bootstrap.min.css',
        'node_modules/font-awesome/css/font-awesome.min.css',
        'node_modules/froala-editor/css/froala_style.min.css',
        'workbench/syscover/pulsar-core/src/public/css/helpers/margin.css',
        'workbench/syscover/pulsar-core/src/public/css/helpers/padding.css',
        'workbench/syscover/pulsar-core/src/public/css/helpers/helpers.css',
        'public/css/styles.css'
    ], 'public/css/app.css')
    .babel([
        'node_modules/jquery/dist/jquery.min.js',
        'node_modules/bootstrap/dist/js/bootstrap.min.js',
        'workbench/syscover/pulsar-core/src/public/vendor/territories/js/jquery.territories.js'
    ], 'public/js/app.js')
    .options({
        processCssUrls: true
    })
    .version();