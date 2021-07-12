<?php

use App\User;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\App\ProductsFeaturedController;
use \Illuminate\Database\Eloquent\SoftDeletes;

Route::prefix('admin')->name('admin.')->group(function () {
  Route::resource('users', Admin\UserController::class);
	Route::resource('products', Admin\ProductController::class);
	Route::resource('categories', Admin\CategoryController::class);
	Route::resource('points', Admin\PointController::class);
	Route::resource('points-assigned', Admin\PointAssignedController::class);
	Route::resource('points-exchanged', Admin\ExchangeController::class);

	Route::get('show_import_template', 'Admin\UserController@showImportTemplate')->name('show-import-template');
	Route::get('show_export_template', 'Admin\UserController@showExportTemplate')->name('show-export-template');
	
	Route::post('import_template', 'Admin\UserController@importTemplate')->name('import-template');
	Route::get('export_template', 'Admin\UserController@exportTemplate')->name('export-template');

	Route::get('get_users', 'Admin\UserController@getUsers')->name('get-users');
	Route::get('get_products', 'Admin\ProductController@getProducts')->name('get-products');
	Route::get('get_user_auth', 'Admin\UserController@getUserAuth')->name('get-user-auth');
	Route::get('get_roles', 'Admin\RoleController@getRole')->name('get-role');
	Route::get('get_categories', 'Admin\CategoryController@getCategories')->name('get-categories');
	Route::get('get_points', 'Admin\PointController@getPoints')->name('get-points');
	Route::get('get_points_assigned', 'Admin\PointAssignedController@getPointsAssigned')->name('get-points-assigned');
	Route::get('get_points_exchanged', 'Admin\ExchangeController@getPointsExchanged')->name('get-points-exchanged');
});

// Route::get('/', 'ProductsFeaturedController@index')->name('home');
Route::get('/', 'App\ProductsFeaturedController@catalog')->name('catalog');
Route::get('/products-featured', 'App\ProductsFeaturedController@productFeatured')->name('product-featured');
Route::get('exchange/get_user_auth', 'App\ProductsFeaturedController@getUserAuth')->name('get-user-auth');
Route::get('exchange/get_products', 'App\ProductsFeaturedController@getProducts')->name('get-products');

Auth::routes();


Route::get('/test', function () {

	return (new UsersExport)->download('ussser.xlsx');

	// Excel::import(new UsersImport, 'users.xlsx');
	// return redirect('/')->with('success', 'All good!');
	// return User::withTrashed()->find(2)->restore();
	// return Auth::user();
	// return User::onlyTrashed()->find(4)->restore();
});
