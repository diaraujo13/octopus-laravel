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
      'resources/js/vendor/jquery-validation/jquery.validate.js',
      'resources/js/vendor/bootstrap-wizard/jquery.bootstrap.wizard.js',
      'resources/js/vendor/pnotify/pnotify.custom.js',
      'resources/js/vendor/jquery-ui/js/jquery-ui-1.10.4.custom.js',
      'resources/js/vendor/jquery-ui-touch-punch/jquery.ui.touch-punch.js',
      'resources/js/vendor/jquery-appear/jquery.appear.js',
      'resources/js/vendor/bootstrap-multiselect/bootstrap-multiselect.js',
      'resources/js/vendor/jquery-easypiechart/jquery.easypiechart.js',
      'resources/js/vendor/flot/jquery.flot.js',
      'resources/js/vendor/flot-tooltip/jquery.flot.tooltip.js',
      'resources/js/vendor/flot/jquery.flot.pie.js',
      'resources/js/vendor/flot/jquery.flot.categories.js',
      'resources/js/vendor/flot/jquery.flot.resize.js',
      'resources/js/vendor/jquery-sparkline/jquery.sparkline.js',
      'resources/js/vendor/raphael/raphael.js',
      'resources/js/vendor/morris/morris.js',
      
      'resources/js/javascripts/theme.js',
      'resources/js/javascripts/theme.custom.js',
      'resources/js/javascripts/theme.init.js',
   ], 'public/js/lib.js')
   .styles([
      'resources/js/vendor/bootstrap/css/bootstrap.css',
      'resources/js/vendor/font-awesome/css/font-awesome.css',
      'resources/js/vendor/magnific-popup/magnific-popup.css',
      'resources/js/vendor/bootstrap-datepicker/css/datepicker3.css',
      'resources/js/vendor/pnotify/pnotify.custom.css',

      'resources/stylesheets/theme.css',
      'resources/stylesheets/skins/default.css',
      'resources/stylesheets/theme-custom.css'
   ], 'public/css/vendor.css')
   .sass('resources/sass/theme.scss', 'public/css/app.css');