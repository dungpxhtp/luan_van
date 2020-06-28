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

    Route::group(['prefix' => 'products'], function() {
        //
        Route::get('brandsproducts.html','Frontend\Product\product@index')->name('productindex');
        Route::get('brandsproducts.html/{slug}','Frontend\Product\product@productbrands')->name('productbrands');
        Route::get('products.html/{id_brandproducts}/{id_cate}','Frontend\Product\product@get_products_cat_brands')->name('get_products_cat_brands');
        Route::get('updatestatus/{id_products}','Frontend\Product\product@updateStatusProduct')->name('updateStatusProduct');
        /* endproduct */
        //Sửa Sản Phẩm
        Route::get('repair/{slug_products}/{id_product}','Frontend\Product\product@repair')->name('repair');
        Route::post('save-repair/{id_product}','Frontend\Product\product@save_repair')->name('save_repair');
        Route::get('delete/{id_product}','Frontend\Product\product@deleteProducts')->name('deleteProducts');

        Route::get('categoryproducts','Frontend\Categoryproduct\category@index')->name('categoryproducts');
        //xóa Sản Phẩm
        //Thêm Sản Phẩm
        Route::get('index_save','Frontend\Product\product@getSaveProducts')->name('getSaveProducts');
        Route::post('post_index_save','Frontend\Product\product@postSaveProducts')->name('post_index_save');

    });
    Route::group(['prefix' => 'brandproducts'], function () {
        Route::get('brandproduct','Frontend\BrandProducts\brandproductsController@index')->name('indexbrandproduct');
        Route::get('update-status/{id_brandproducts}','Frontend\BrandProducts\brandproductsController@update_status')->name('update_status');
        Route::get('update_brandproduct/{id_brandproducts}/{slug}','Frontend\BrandProducts\brandproductsController@update_brandproduct')->name('update_brandproduct');
        Route::post('post_brandproduct/{id_brandproducts}','Frontend\BrandProducts\brandproductsController@post_brandproduct')->name('post_brandproduct');
    });



});
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth.auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
