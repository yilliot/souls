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

// mix.js('resources/assets/js/app.js', 'public/js');
  // .sass('resources/assets/sass/app.scss', 'public/css')
  // .sass('resources/assets/sass/office.scss', 'public/css')
mix.copy('resources/assets/semantic/dist', 'public/semantic', false);

mix
.copyDirectory('resources/assets/jquery-ui', 'public/css/jquery-ui-1.12.1.custom')
.sass('resources/assets/sass/app.scss', 'public/css')
.sass('resources/assets/sass/zz.scss', 'public/css')
.sass('resources/assets/sass/admin.scss', 'public/css')
.sass('resources/assets/sass/event.just-begin.scss', 'public/css')
.sass('resources/assets/sass/event.supreme-vote.scss', 'public/css')
.sass('resources/assets/sass/event.bible-reading.scss', 'public/css')
.sass('resources/assets/sass/future-fund.scss', 'public/css')
.js([
  'resources/assets/js/app.js',
  ], 'public/js/app.js')
.js([
      'resources/assets/js/admin.js',
  ], 'public/js/admin.js')
.js([
      'resources/assets/js/event.just-begin.js',
  ], 'public/js/event.just-begin.js')
.js([
      'resources/assets/js/future-fund.js',
  ], 'public/js/future-fund.js')
.js([
      'resources/assets/js/event.supreme-vote.js',
  ], 'public/js/event.supreme-vote.js')

.js([
      'resources/assets/js/event.bible-reading.js',
  ], 'public/js/event.bible-reading.js')
  .extract(['jquery', 'moment']);