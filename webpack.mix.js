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

mix.setPublicPath('public_html/');
mix.sass('resources/sass/app.scss', 'public_html/admin/css')
	.js('resources/js/admin/admin-users.js', 'public_html/js/admin')
	.js('resources/js/admin/admin-products.js', 'public_html/js/admin')
	.js('resources/js/admin/admin-points.js', 'public_html/js/admin')
	.js('resources/js/admin/admin-points-assigned.js', 'public_html/js/admin')
	.js('resources/js/admin/admin-points-exchanged.js', 'public_html/js/admin')
	.js('resources/js/admin/admin-categories.js', 'public_html/js/admin')
	.js('resources/js/admin/export-template-excel.js', 'public_html/js/admin')
	.js('resources/js/admin/import-template-excel.js', 'public_html/js/admin')
	.postCss('resources/css/admin/app.css', 'public_html/css/admin')
	.js('resources/js/app/app.js', 'public_html/js/app')
	.js('resources/js/app/catalog.js', 'public_html/js/app')
	.js('resources/js/app/wallpaper.js', 'public_html/js/app')
	.postCss('resources/css/app/app.css', 'public_html/css/app')

mix.browserSync('http://puntos.test/');
