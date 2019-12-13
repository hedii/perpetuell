const mix = require('laravel-mix')

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
  // front
  .js('resources/js/front/app.js', 'public/js/front/app.js')
  .sass('resources/sass/front/app.scss', 'public/css/front/app.css')

  // admin
  .js('resources/js/admin/app.js', 'public/js/admin/app.js')
  .sass('resources/sass/admin/app.scss', 'public/css/admin/app.css')

  // general
  .copyDirectory('resources/images', 'public/images')
  .version()
