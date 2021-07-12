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

mix.sass('resources/sass/app.scss', 'public/admin/css')
	.js('resources/js/admin/admin-users.js', 'public/js/admin')
	.js('resources/js/admin/admin-products.js', 'public/js/admin')
	.js('resources/js/admin/admin-points.js', 'public/js/admin')
	.js('resources/js/admin/admin-points-assigned.js', 'public/js/admin')
	.js('resources/js/admin/admin-points-exchanged.js', 'public/js/admin')
	.js('resources/js/admin/admin-categories.js', 'public/js/admin')
	.js('resources/js/admin/export-template-excel.js', 'public/js/admin')
	.js('resources/js/admin/import-template-excel.js', 'public/js/admin')
	.postCss('resources/css/admin/app.css', 'public/css/admin')
	.js('resources/js/app/app.js', 'public/js/app')
	.js('resources/js/app/products-featured.js', 'public/js/app')
	.js('resources/js/app/catalog.js', 'public/js/app')
	.postCss('resources/css/app/app.css', 'public/css/app')

mix.browserSync('http://puntos.test/');
