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

Route::namespace('Admin')->prefix('admin')->group(function () {
  Route::get('/', 'DashboardController@index');
  Route::resource('domains', 'DomainController');
  Route::resource('registrars', 'RegistrarController');
  Route::resource('prices', 'PriceController');
  Route::resource('users', 'UserController');
});
