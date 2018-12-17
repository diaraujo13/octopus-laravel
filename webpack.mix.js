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
   .copy('resources/js/vendor/modernizr/modernizr.js', 'public/js/')
   .copy('resources/images', 'public/images')
   .copy('resources/js/vendor/font-awesome/fonts', 'public/fonts')
   .scripts([
      'resources/js/vendor/jquery/jquery.js',
      'resources/js/vendor/jquery-browser-mobile/jquery.browser.mobile.js',
      'resources/js/vendor/bootstrap/js/bootstrap.js',
      'resources/js/vendor/nanoscroller/nanoscroller.js',
      'resources/js/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js',
      'resources/js/vendor/magnific-popup/magnific-popup.js',
      'resources/js/javascripts/theme.js',
      'resources/js/javascripts/theme.custom.js',
      'resources/js/javascripts/theme.init.js',
   ], 'public/js/lib.js')
   .styles([
      'resources/js/vendor/bootstrap/css/bootstrap.css',
      'resources/js/vendor/font-awesome/css/font-awesome.css',
      'resources/js/vendor/magnific-popup/magnific-popup.css',
      'resources/js/vendor/bootstrap-datepicker/css/datepicker3.css',
      'resources/stylesheets/theme.css',
      'resources/stylesheets/skins/default.css',
      'resources/stylesheets/theme-custom.css'
   ], 'public/css/vendor.css')
   .sass('resources/sass/theme.scss', 'public/css/app.css');