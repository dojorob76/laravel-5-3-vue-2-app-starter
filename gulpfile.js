const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

var paths = {
    'bower': './vendor/bower_components/',
    'vendor': './resources/assets/vendor/',
    'assets': './resources/assets/',
    'bootstrap': 'node_modules/bootstrap-sass/assets/'
};

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(mix => {
    mix.sass('app.scss')

        //.copy(paths.assets + 'images/**', 'public/images')
        //.copy(paths.assets + 'fonts/**', 'public/fonts')
        .copy(paths.bower + 'font-awesome/fonts/**', 'public/fonts')
        .copy(paths.bootstrap + 'fonts/bootstrap/**', 'public/fonts')
        .copy(paths.bower + 'es6-promise/es6-promise.auto.min.js', paths.vendor + 'js/es6-promise.auto.min.js')

        .scripts([
            paths.vendor + 'js/**',
            paths.bower + 'sweetalert2/dist/sweetalert2.min.js',
            'custom/**'
        ])

        .styles([
            paths.bower + 'font-awesome/css/font-awesome.min.css',
            paths.bower + 'sweetalert2/dist/sweetalert2.min.css',
            paths.vendor + 'css/**',
            './public/css/app.css'
        ])

        .webpack('app.js', 'public/js/bundle.js')

        .version(['css/all.css', 'js/all.js', 'js/bundle.js']);
});