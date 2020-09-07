<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return view('welcome');
});

// Custom Login Start
Route::get('/login', 'LoginController@showLogin')->name('login');
Route::post('/authenticate', 'LoginController@authenticate')->name('authenticate');
Route::get('/register', 'LoginController@showRegister')->name('register');
Route::post('/register', 'LoginController@register')->name('register');
Route::post('/logout', function() {Auth::logout();return redirect('/');})->name('logout');
// Custom Login End

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth'])->group(function () {
	Route::resource('item', 'ItemController', ['except' => []]);
	Route::resource('customer', 'CustomerController', ['except' => ['show']]);
	Route::resource('tag', 'TagController');
	Route::resource('code', 'ItemTagController');
	Route::resource('vendor', 'VendorController');
});

Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware(['auth', 'auth.admin'])->group(function(){
	Route::resource('user', 'UserController');
	Route::resource('department', 'DepartmentController');
});

Route::get('/generate/item/buildup/{id}', 'JasperController@generateReport')->name('jasper');