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

Route::get('/', 'AppController@index')->name('index');
Route::get('/domains/{domain}', 'DomainController@show')->name('domains.show');

Route::get('/registrars', 'RegistrarController@index')->name('registrars.index');
Route::get('/registrars/{registrar}', 'RegistrarController@show')->name('registrars.show');

Route::name('admin.')->namespace('Admin')->prefix('admin')->group(function () {
  Route::middleware('guest')->group(function () {
    Route::get('/login', 'AdminController@login')->name('login');
    Route::post('/users/login', 'UserController@login')->name('users.login');
  });

  Route::middleware('auth')->group(function () {
    Route::post('/users/logout', 'UserController@logout')->name('users.logout');
    Route::get('/', 'AdminController@index')->name('index');
    Route::resource('/domains', 'DomainController');
    Route::resource('/registrars', 'RegistrarController');
    Route::resource('/prices', 'PriceController');
    Route::resource('/users', 'UserController');
  });
});
