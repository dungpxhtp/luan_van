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

/*user */



Route::get('/','Backend\HomeController@home')->name('home');
//show sản phẩm

Route::get('san-pham/{slug}','Backend\HomeController@productDetail')->name('productDetail');
//bình luận sản phẩm

/* admin */
Route::get('admin','Frontend\loginAdminController@getLogin')->name('getLogin');
Route::post('loginAdmin','Frontend\loginAdminController@loginAdmin')->name('loginAdmin');

//show san pham theo hãng
Route::get('thuong-hieu/{slug}','Backend\HomeController@brands_products')->name('brands_products.thuong-hieu');
Route::get('filter/{slug}','Backend\HomeController@brands_filter_products')->name('brands_products.filter');
//end show san pham theo hãng


//show san pham theo loai san pham
Route::get('loai-san-pham/{slug}','Backend\HomeController@category')->name('category_products.loai-san-pham');
Route::get('filter-loai-san-pham/{slug}','Backend\HomeController@category_filter_products')->name('category.filter');


//end show sanpham theo loai
//show san pham theo đối tượgn
Route::get('doi-tuong/{slug}','Backend\HomeController@gender')->name('gender.index');
Route::get('filter-doi-tuong/{slug}','Backend\HomeController@gender_filter_products')->name('gender.filter');

//end show sản phẩm theo đối tượng

//tin tứcc
Route::get('tin-tuc','Backend\HomeController@topic')->name('tin-thuc.index');
Route::get('danh-muc-tin-tuc/{slug}','Backend\HomeController@topicPost')->name('topicPost');
Route::get('bai-viet/{slug}','Backend\HomeController@postdetail')->name('postdetail');
//end tin tức
//đăng nhập
Route::get('dang-nhap-khach-hang','Backend\HomeController@getdangnhap')->name('get_dang_nhap_user');
Route::post('post-dang-nhap-user','Backend\HomeController@postdangnhap')->name('post_dang_nhap_user');
//end đăng nhập
Route::get('dang-xuat-khach-hang','Backend\HomeController@logoutUser')->name('logoutUser');
Route::get('lien-he','Backend\HomeController@contact')->name('contact');
Route::post('post-lien-he','Backend\HomeController@postContact')->name('postContact');
Route::group(['middleware' => 'auth.user'], function () {
    Route::post('binh-luan/{id_products}','Backend\HomeController@commentProduct')->name('commentProduct');
    Route::post('tra-loi/{id_products}/{parentid}','Backend\HomeController@replyCommentProduct')->name('replyCommentProduct');
});


        ///phần admin //

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
    //Đơn Hàng
    Route::group(['prefix' => 'orders'], function () {
        Route::get('orders','Frontend\orders\orderscontroller@indexorders')->name('orders');
        Route::get('fetchorders','Frontend\orders\orderscontroller@fetchorders')->name('fetchorders');
        Route::get('fetchordersconfirm','Frontend\orders\orderscontroller@fetchordersconfirm')->name('fetchordersconfirm');
        Route::post('update-quantity-order/{id_order_products}','Frontend\orders\orderscontroller@update_quantity_order')->name('update_quantity_order');
        Route::get('viewOrder/{id_orders}','Frontend\orders\orderscontroller@viewOrder')->name('viewOrder');
        Route::get('update_status_orders/{id_orders}','Frontend\orders\orderscontroller@update_status_orders')->name('update_status_orders');
        Route::get('export-pdf-order/{id_orders}/hoadon','Frontend\orders\orderscontroller@export_pdf_order')->name('export_pdf_order');
        Route::post('post-export-pdf-order/{id_orders}','Frontend\orders\orderscontroller@post_export_pdf_order')->name('post_export_pdf_order');
        Route::get('export/{id}','Frontend\orders\orderscontroller@export')->name('export');
    });
    //Quản Lý User
    Route::group(['prefix' => 'users'], function () {
        Route::get('users','Frontend\UserController@index')->name('users.view');
        Route::get('FetchUsersList','Frontend\UserController@fetchUserAjax')->name('users.FetchAjax');
    });


});
Route::group(['prefix' => 'laravel-filemanager','middleware'=>'auth.auth'], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
Route::fallback(function(){
    return response()->json([
        'message' => 'Page Not Found. If error persists, contact thien.phamminhstu@gmail.com'], 404);
});
