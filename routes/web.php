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
//tìm kiếm
Route::get('auto-complete-search','Backend\HomeController@search_complete')->name('search_complete');
Route::get('view-search','Backend\HomeController@view_search_result')->name('view_search_result');
//end show sanpham theo loai
//show san pham theo đối tượgn
Route::get('doi-tuong/{slug}','Backend\HomeController@gender')->name('gender.index');
Route::get('filter-doi-tuong/{slug}','Backend\HomeController@gender_filter_products')->name('gender.filter');

//end show sản phẩm theo đối tượng
//Quên mật khẩu reset password
Route::get('quen-mat-khau','Backend\HomeController@resetPassword')->name('resetPassword');
Route::post('send-quen-mat-khau','Backend\HomeController@postResetPassword')->name('postResetPassword');
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
//login facebook
Route::get('/auth/facebook/', 'SocialAuthController@redirectToProvider')->name('loginfacebook');
Route::get('/auth/facebook/callback/', 'SocialAuthController@handleProviderCallback');
Route::get('/auth/google/', 'SocialAuthController@redirectToGoogle')->name('logingoogle');
Route::get('/auth/google/callback/', 'SocialAuthController@handleGoogleCallback');
//route đăng ký
Route::get('dang-ky','Backend\HomeController@register')->name('resgister');
Route::post('post-dang-ky','Backend\HomeController@postRegister')->name('postRegister');
Route::post('xac-thuc-email','Backend\HomeController@xacthucgmail')->name('active_email');
Route::get('xac-thuc','Backend\HomeController@getxacthuc')->name('getxacthuc');
Route::group(['middleware' => 'auth.user'], function () {
    Route::post('binh-luan/{id_products}','Backend\HomeController@commentProduct')->name('commentProduct');
    Route::post('tra-loi/{id_products}/{parentid}','Backend\HomeController@replyCommentProduct')->name('replyCommentProduct');
    Route::get('them-san-pham/{id}','Backend\CartController@add')->name('cart-add');
    Route::get('gio-hang','Backend\CartController@showCartOrder')->name('gio-hang');
    Route::get('cap-nhat/{id}/{quantity}','Backend\CartController@update')->name('giam-so-luong');
    Route::get('xoa-san-pham/{id}','Backend\CartController@remove')->name('remove');
    Route::get('huy-gio-hang','Backend\CartController@clear')->name('clear');
    Route::get('thanh-toan','Backend\HomeController@paycart')->name('paycart');
    Route::post('post-thanh-toan','Backend\HomeController@postPayCart')->name('postPayCart');
    Route::get('send-mail','Backend\HomeController@sendmail')->name('sendmail');
    //thông tin tài khoản
    Route::get('thong-tin-tai-khoan','Backend\HomeController@accountUser')->name('accountUser');
    Route::post('post-thong-tin','Backend\HomeController@postAccountUser')->name('postAccountUser');
    //Thanh Toán Online
    Route::get('thanh-toan-vnpay/{codeOder}','Backend\vnpayController@requestVnpay')->name('vnpay_create');
    //return kết quả thanh toán
    Route::get('kiem-tra-thanh-toan','Backend\vnpayController@complete_purchase')->name('complete_purchase')->middleware('completePurchase:VNPay');
    //đơn hàng đã mua
    Route::get('don-hang-da-mua','Backend\HomeController@cart_order_user')->name('cart_order_user');
    Route::get('fetch-don-hang-all','Backend\HomeController@fetch_order')->name('fetch_don_hang_all');
    Route::get('danh-sach-san-pham/{id}','Backend\HomeController@ds_order')->name('ds_order');
    Route::get('danh-sach-san-pham-accept','Backend\HomeController@fetch_order_accept')->name('fetch_order_accept');
    Route::get('danh-sach-san-pham-error','Backend\HomeController@fetch_order_error')->name('fetch_order_error');

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
        //thêm số lượng sản phẩm
        Route::get('products-quantity-view','Frontend\Product\product@view_product_quantity')->name('view_product_quantity');
        Route::get('fetch-products-quantity-view','Frontend\Product\product@fetch_view_product_quantity')->name('fetch_view_product_quantity');
        Route::post('update-quantity-product/{id}','Frontend\Product\product@update_quantity')->name('update_quantity');

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
        //danh sách đơn hàng duyệt đơn
        Route::get('view-exportorders','Frontend\orders\orderscontroller@view_exportorders')->name('view_exportorders');
        Route::get('fetch-view-exportorders','Frontend\orders\orderscontroller@fetch_view_export_orders')->name('fetch_view_export_orders');
        Route::get('export/{id}','Frontend\orders\orderscontroller@export')->name('export');
        ///Báo lỗi đơn hàng lúc liên hệ
        Route::get('order-error/{id}','Frontend\orders\orderscontroller@update_erorr')->name('update_erorr');
        Route::get('error-order','Frontend\orders\orderscontroller@error_order')->name('error_order');
        Route::get('fetch-error-order','Frontend\orders\orderscontroller@fetch_error_order')->name('fetch_error_order');
        //Báo lỗi đơn hàng sau khi duyệt xong
        Route::get('cancel-orders-quantity/{id}','Frontend\orders\orderscontroller@update_erorr_products')->name('update_erorr_products');
    });
    //Quản Lý User
    Route::group(['prefix' => 'users'], function () {
        Route::get('users','Frontend\UserController@index')->name('users.view');
        Route::get('FetchUsersList','Frontend\UserController@fetchUserAjax')->name('users.FetchAjax');
    });
    //Quản Lý Chủ Đề Tin Tức
    Route::group(['prefix' => 'topic'], function () {
        Route::get('all-topic','Frontend\Topic\topicController@index')->name('index.Topic');
        //jdatatable
        Route::get('fetch-all-topic','Frontend\Topic\topicController@fetchindex')->name('fetchindex');
        //update status
        Route::get('update-status/{id}','Frontend\Topic\topicController@update_status')->name('update_status');
        //xóa topic
        Route::get('delete-topic/{id}','Frontend\Topic\topicController@delete_topic')->name('delete_topic');
        Route::get('find-topic/{id}','Frontend\Topic\topicController@find')->name('find.topic');
        Route::post('insert-topic','Frontend\Topic\topicController@insert')->name('insert.topic');
        //cập nhật topic
        Route::post('update-topic/{id}','Frontend\Topic\topicController@update')->name('update.topic');
    });
    //Quản Lý Tin Tức
    Route::group(['prefix' => 'news'], function () {
        Route::get('all-post','Frontend\post\postController@index')->name('index.post');
        Route::get('fetch-all-post','Frontend\post\postController@fetchindex')->name('fetchindex.post');
        Route::get('update-status/{id}','Frontend\post\postController@update_status')->name('update_status.post');
        Route::get('delete-news/{id}','Frontend\post\postController@delete_news')->name('delete_news.post');
        //Thêm
        Route::get('insert-new','Frontend\post\postController@insert')->name('insert.getPost');
        Route::post('post-insert-new','Frontend\post\postController@postInsert')->name('insert.postPost');
        //sửa
        Route::get('update-news-detail/{slug}/{id}','Frontend\post\postController@get_update')->name('get_update.post');
        Route::post('post-update-detail/{id}','Frontend\post\postController@post_update')->name('post_update.post');
    });
    // quản lý admin
    Route::group(['prefix' => 'admin'], function () {
        Route::get('admin-all','Frontend\Admin\admin@index')->name('admin.index');
        Route::get('fetch-data-admin','Frontend\Admin\admin@fetchindex')->name('admin.fetchIndex');
        Route::get('update-status-admin/{id}','Frontend\Admin\admin@update_status')->name('admin.updateStatus');
        Route::get('find-admin/{id}','Frontend\Admin\admin@find')->name('admin.find');
        Route::post('update-admin/{id}','Frontend\Admin\admin@update_admin')->name('admin.update_admin');
    });
    // quản lý biểu đồ

    Route::group(['prefix' => 'charts'], function() {
        //
        Route::get('users-charts','Frontend\charts@chartsUser')->name('chartsUser');
    });

});
Route::group(['prefix' => 'laravel-filemanager','middleware'=>'auth.auth'], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
Route::fallback(function(){
    return response()->json([
        'message' => 'Page Not Found. If error persists, contact thien.phamminhstu@gmail.com'], 404);
});
