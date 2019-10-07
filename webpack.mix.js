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


mix
    .js('assets/js/app.js', 'public/assets/js')
    .js('assets/js/myvue.js', 'public/assets/js').extract(['vue'])
    .js('assets/js/downGlobal.js', 'public/assets/js')
   .sass('assets/sass/app.scss', 'public/assets/css')
    .js('assets/js/pendingPage.js', 'public/assets/js')
    .js('assets/js/successPage.js', 'public/assets/js')
    .js('assets/js/optionPages.js', 'public/assets/js')
    .js('assets/js/requestShowPage.js', 'public/assets/js').js('assets/js/vendorPage.js', 'public/assets/js')
    .copy('assets/js/requestPage.js', 'public/assets/js/requestPage.js')
    .copy('assets/js/requestPageDown.js', 'public/assets/js/requestPageDown.js');




mix.browserSync({
    //proxy: 'hisabnikash.demo/'
});
