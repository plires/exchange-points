<?php

use App\User;
use App\Mail\MessageToUser;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Illuminate\Support\Facades\Route;
use \Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Controllers\App\WallpaperController;
use App\Http\Controllers\App\RegisterPendingController;
use App\Http\Controllers\Admin\ExchangeDetailController;
use App\Http\Controllers\App\ProductsFeaturedController;

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

	Route::put('/users/{id}/cambiar_confirmed', 'Admin\UserController@changeUserConfirmed')->name('change-user-confirmed');

	Route::get('get_users', 'Admin\UserController@getUsers')->name('get-users');
	Route::get('get_products', 'Admin\ProductController@getProducts')->name('get-products');
	Route::get('get_user_auth', 'Admin\UserController@getUserAuth')->name('get-user-auth');
	Route::get('get_roles', 'Admin\RoleController@getRole')->name('get-role');
	Route::get('get_categories', 'Admin\CategoryController@getCategories')->name('get-categories');
	Route::get('get_points', 'Admin\PointController@getPoints')->name('get-points');
	Route::get('get_points_assigned', 'Admin\PointAssignedController@getPointsAssigned')->name('get-points-assigned');
	Route::get('get_points_exchanged', 'Admin\ExchangeController@getPointsExchanged')->name('get-points-exchanged');
	Route::get('get_points_exchanged', 'Admin\ExchangeController@getPointsExchanged')->name('get-points-exchanged');
	Route::get('get_exchanges_details', 'Admin\ExchangeDetailController@getExchangesDetails')->name('get-exchanges-details');
});

Route::get('/', 'App\ProductsFeaturedController@catalog')->name('catalog');
Route::get('/wallpapers', 'App\WallpaperController@wallpapers')->name('wallpapers');
Route::get('/products-featured', 'App\ProductsFeaturedController@productFeatured')->name('product-featured');
Route::get('/exchange/get_user_auth', 'App\ProductsFeaturedController@getUserAuth')->name('get-user-auth');
Route::get('/exchange/get_products', 'App\ProductsFeaturedController@getProducts')->name('get-products');

Route::get('/registro-pendiente', 'App\RegisterPendingController@userPendingVerification')->name('register-pending');

Route::post('/user-points-exchanged', 'App\ExchangeController@store')->name('user-points-exchange');

Route::put('/user/{user}', 'App\UserController@update')->name('user-edit');

Auth::routes();

Route::get('/test', function () {

	// Enviar email
  // $to_name = 'Pablo De Pisos';
  // $to_email = 'plires@depisos.com';
  
  // $data = array(
  //     'name'      => 'Carlos', 
  //     'points'    => 3000, 
  // );

  // Mail::queue('emails.new-exchange-manual', $data, function($message) use ($to_name, $to_email) {
  // $message->to($to_email, $to_name)
  // ->subject('Laravel Test Mail');
  // $message->from('pruebas@librecomunicacion.net','Test Mail');
  // });

	// return (new UsersExport)->download('ussser.xlsx');

	// Excel::import(new UsersImport, 'users.xlsx');
	// return redirect('/')->with('success', 'All good!');
	// return User::withTrashed()->find(2)->restore();
	// return Auth::user();
	// return User::onlyTrashed()->find(4)->restore();

});
