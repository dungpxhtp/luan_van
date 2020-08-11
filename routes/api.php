<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
/*
Route::post('dang-nhap', 'ApiController@login')->name('loginuser');
Route::post('dang-ky-user', 'ApiController@register');

Route::group(['middleware' => 'auth.jwt'], function () {
    Route::get('products','Frontend\Home@products');

});
//Uses Cate Gory
Route::get('brandproducts','Frontend\Home@brandproducts');
Route::get('categoryproducts','Frontend\Home@categoryproducts');


// User Comment
Route::get('getAllComment/{id}','Api\commentUser@index');
//call back erorr url api
Route::fallback(function(){
    return response()->json([
        'message' => 'Page Not Found. If error persists, contact thien.phamminhstu@gmail.com'], 404);
});
*/
