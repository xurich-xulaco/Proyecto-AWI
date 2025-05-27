const mix = require('laravel-mix');

mix
  .js('resources/js/bootstrap.js', 'public/js')
  .sass('resources/sass/app.scss', 'public/css')
  .version();
