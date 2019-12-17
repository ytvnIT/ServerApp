<?php

use Illuminate\Http\Request;

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
Route::get("test", "Apis\AppController@test");
Route::get("grade","Apis\AppController@getGrade");
Route::post("signup",'Apis\\Authentication\\RegisterController@create');
Route::get("/product", "Apis\\ProductController@create");
Route::get("/main-product/{page}", "Apis\\MainProductController@getByPage");
Route::get("/detail-product/{id}", "Apis\\DetailController@getDetail");

//login
Route::post("login",'Apis\\Authentication\\LoginController@login');
Route::post("reset",'Apis\\Authentication\\ResetPasswordController@reset');
Route::post("setpassword",'Apis\\Authentication\\ResetPasswordController@setNewPassword');
//endlogin/

//diem danh
Route::get("generateQR/{MAMH}", "Apis\AppController@generateQR");
Route::get("diemdanh/{TOKEN}/{MAHV}", "Apis\AppController@diemDanh");
Route::get("checkInInfor/{MAHV}", "Apis\AppController@checkInInfor");
Route::get("tkb/{MAHV}", "Apis\AppController@getTKB");
Route::get("grade/{MAHV}", "Apis\AppController@getGrade");
//end diem danh

Route::get("giangday/", "Apis\\DetailController@getGD");
Route::get("diemdanhc/", "Apis\\DetailController@getDD");
Route::get("diemdanhtest","Apis\\DetailController@insert");
Route::get("get","Apis\\DetailController@get");
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

