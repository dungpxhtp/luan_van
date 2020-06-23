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
    /* product */
    Route::get('brandsproducts.html','Frontend\Product\product@index')->name('productindex');
    Route::get('brandsproducts.html/{slug}','Frontend\Product\product@productbrands')->name('productbrands');
    Route::get('products.html/{id_brandproducts}/{id_cate}','Frontend\Product\product@get_products_cat_brands')->name('get_products_cat_brands');
    Route::get('updatestatus/{id_products}','Frontend\Product\product@updateStatusProduct')->name('updateStatusProduct');
    /* endproduct */
    //Sửa Sản Phẩm
    Route::get('repair/{id_products}','Frontend\Product\product@repair')->name('repair');
    Route::get('categoryproducts','Frontend\Categoryproduct\category@index')->name('categoryproducts');



});
