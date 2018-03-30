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

Auth::routes();

Route::resource('post', 'PostController');

Route::get('/home', 'HomeController@index')->name('home');

Route::post('coords', 'HomeController@show')->name('coords');

Route::get('coords', function () {
    return view('coords');
});

Route::get('find', function () {
    return view('coords');
})->name('find');

Route::get('device', 'DeviceController@index');

Route::post('device', 'DeviceController@index')->name('device');

Route::get('devices/{function}', 'devManagerController@show')->name('devices');

Route::post('devices/all', 'devManagerController@create')->name('create_device');

Route::get('settings', 'accountManagerController@index')->name('settings');

Route::post('settings', 'accountManagerController@edit')->name('edit_user');
