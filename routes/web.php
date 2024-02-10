<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
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

Route::get('/', 'BuildingController@index')->name('home');
Route::get('/exportpdf', 'BuildingController@exportpdf')->name('pdf');

Route::prefix('building')->group(function () {
    Route::get('/add', 'BuildingController@create')->name('add-building');
    Route::get('/edit/{id}', 'BuildingController@edit')->name('edit');
    Route::get('/delete/{id}', 'BuildingController@delete')->name('delete');
    Route::post('/store', 'BuildingController@store')->name('store');
    Route::post('/update', 'BuildingController@update')->name('update');

});
