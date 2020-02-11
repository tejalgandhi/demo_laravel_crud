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

//Route::resource('booking', 'BookingController');

Route::get('/booking/create','BookingController@create')->name('booking.create');

/*Route::get('/booking/add', function () {
    return view('booking.create');
})->name('booking.create');*/

Route::get('/booking','BookingController@index')->name('booking.index');
Route::post('/booking/store','BookingController@store')->name('booking.store');
Route::get('/booking/{id}/edit','BookingController@edit')->name('booking.edit');
Route::get('/booking/{id}/delete','BookingController@destroy')->name('booking.destroy');
Route::get('/booking/{id}','BookingController@show')->name('booking.show');
Route::post('/booking/{id}','BookingController@update')->name('booking.update');



/*Route::get('/booking/add', function () {
    return view('booking.create');
});*/

