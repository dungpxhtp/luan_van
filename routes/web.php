<?php

use Illuminate\Support\Facades\Route;

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

Route::get('','Frontend\loginAdminController@getLogin')->name('getLogin');
Route::post('loginAdmin','Frontend\loginAdminController@loginAdmin')->name('loginAdmin');

Route::group(['prefix' => 'admin','middleware'=>'auth.auth'], function () {
    Route::get('dashboard','Frontend\Backend@dashboard')->name('dashboard');
    Route::get('logOutAdmin','Frontend\Backend@logOutAdmin')->name('logOutAdmin');
    Route::get('products','Frontend\Product\product@index')->name('product');
});
