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

Auth::routes();

Route::group([
    'prefix' => 'admin',
    'middleware' => 'auth'
], function () {
    Route::get('/', 'Admin\AdminController')->name('admin');
    Route::get('songs', 'Admin\SongController@index')->name('admin.songs.index');
    Route::get('songs/create', 'Admin\SongController@create')->name('admin.songs.create');
    Route::post('songs', 'Admin\SongController@store')->name('admin.songs.store');
    Route::get('songs/{song}/edit', 'Admin\SongController@edit')->name('admin.songs.edit');
    Route::put('songs/{song}', 'Admin\SongController@update')->name('admin.songs.update');
    Route::delete('songs/{song}', 'Admin\SongController@destroy')->name('admin.songs.destroy');
});

Route::get('/', 'SongController@index')->name('front.songs.index');
Route::get('{song}', 'SongController@show')->name('front.songs.show');
