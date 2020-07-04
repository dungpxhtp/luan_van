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
        Route::get('ajaxbrandproduct','Frontend\BrandProducts\brandproductsController@ajaxbrandproduct')->name('ajaxbrandproduct');

        Route::get('update-status/{id_brandproducts}','Frontend\BrandProducts\brandproductsController@update_status')->name('update_status');
        Route::get('destroy/{id_brandproducts}','Frontend\BrandProducts\brandproductsController@destroy')->name('destroy');
        Route::get('update_brandproduct/{id_brandproducts}/{slug}','Frontend\BrandProducts\brandproductsController@update_brandproduct')->name('update_brandproduct');
        Route::post('post_brandproduct/{id_brandproducts}','Frontend\BrandProducts\brandproductsController@post_brandproduct')->name('post_brandproduct');

        Route::get('add_brandproduct','Frontend\BrandProducts\brandproductsController@add_brandproduct')->name('add_brandproduct');
        Route::post('post_add_brandproduct','Frontend\BrandProducts\brandproductsController@post_add_brandproduct')->name('post_add_brandproduct');

    });

    Route::group(['prefix' => 'categoryproducts'], function() {
        //
        Route::get('categoryproducts','Frontend\Categoryproduct\categoryProductsController@indexcategoryproducts')->name('indexcategoryproducts');
        Route::get('fetchcategoryproducts','Frontend\Categoryproduct\categoryProductsController@fetchcategoryproducts')->name('fetchcategoryproducts');
        Route::get('update-status/{id_categoryproducts}','Frontend\Categoryproduct\categoryProductsController@update_status')->name('update_status_categoryproducts');
        Route::get('destroy_categoryproducts/{id_categoryproducts}','Frontend\Categoryproduct\categoryProductsController@destroy')->name('destroy_categoryproducts');
        Route::get('update_categoryproducts/{id_categoryproducts}/{slug}','Frontend\Categoryproduct\categoryProductsController@update_categoryproducts')->name('update_categoryproducts');
        Route::post('post_update_categoryproducts/{id_categoryproducts}','Frontend\Categoryproduct\categoryProductsController@post_update_categoryproducts')->name('post_update_categoryproducts');
        Route::get('add_categoryproducts','Frontend\Categoryproduct\categoryProductsController@add_categoryproducts')->name('add_categoryproducts');
        Route::post('post_add_categoryproducts','Frontend\Categoryproduct\categoryProductsController@post_add_categoryproducts')->name('post_add_categoryproducts');





    });
    Route::group(['prefix' => 'gendercategoryproducts'], function () {
        Route::get('gendercategoryproducts','Frontend\genderCategoryProducts\gendercategoryproductscontroller@indexgendercategoryproducts')->name('indexgendercategoryproducts');
        Route::get('fetchgendercategoryproducts','Frontend\genderCategoryProducts\gendercategoryproductscontroller@fetchgendercategoryproducts')->name('fetchgendercategoryproducts');
        Route::get('update_status_gendercategoryproducts/{id_gendercategoryproducts}','Frontend\genderCategoryProducts\gendercategoryproductscontroller@update_status')->name('update_status_gendercategoryproducts');
        Route::get('destroy_gendercategoryproducts/{id_gendercategoryproducts}','Frontend\genderCategoryProducts\gendercategoryproductscontroller@destroy_gendercategoryproducts')->name('destroy_gendercategoryproducts');
        Route::get('update_gendercategoryproducts/{id_gendercategoryproducts}/{slug}','Frontend\genderCategoryProducts\gendercategoryproductscontroller@update_gendercategoryproducts')->name('update_gendercategoryproducts');
        Route::post('post_update_gendercategoryproducts/{id_gendercategoryproducts}','Frontend\genderCategoryProducts\gendercategoryproductscontroller@post_update_gendercategoryproducts')->name('post_update_gendercategoryproducts');
        Route::post('post_add_gendercategoryproducts','Frontend\genderCategoryProducts\gendercategoryproductscontroller@post_add_gendercategoryproducts')->name('post_add_gendercategoryproducts');
    });
    Route::group(['prefix' => 'orders'], function () {
        Route::get('orders','Frontend\orders\orderscontroller@indexorders')->name('orders');
        Route::get('fetchorders','Frontend\orders\orderscontroller@fetchorders')->name('fetchorders');
        Route::get('viewOrder/{id_orders}','Frontend\orders\orderscontroller@viewOrder')->name('viewOrder');
    });



});
Route::group(['prefix' => 'laravel-filemanager','middleware'=>'auth.auth'], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
Route::fallback(function(){
    return response()->json([
        'message' => 'Page Not Found. If error persists, contact thien.phamminhstu@gmail.com'], 404);
});
