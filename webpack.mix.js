const { mix } = require('laravel-mix');

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

// mix.js('resources/assets/js/app.js', 'public/js')
//   .sass('resources/assets/sass/app.scss', 'public/css')
//   .sass('resources/assets/sass/office.scss', 'public/css')
//   .copy('resources/assets/semantic/dist', 'public/semantic', false);

mix
.sass('resources/assets/sass/admin.scss', 'public/css')
.sass('resources/assets/sass/event.just-begin.scss', 'public/css')
.js([
      'resources/assets/js/admin.js',
  ], 'public/js/admin.js')
.js([
      'resources/assets/js/event.just-begin.js',
  ], 'public/js/event.just-begin.js')
  .extract(['jquery', 'moment']);