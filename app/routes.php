<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

//Route::get('/', function()
//{
//	return View::make('hello');
//});
Route::get('/', 'HomeController@home');
Route::get('/home/getproduct', 'HomeController@getproduct_ajax');
Route::get('/home/getproduct/featured', 'HomeController@getproductFeatured_ajax');

Route::get('/san-pham', 'HomeController@product_view');
Route::get('/san-pham/{name}/{id}', 'HomeController@productdetail');

Route::get('/blog', 'HomeController@blog_view');
Route::get('/blog/{name}/{id}', 'HomeController@blogdetail');

Route::get('/dang-nhap', 'UserController@login');
Route::post('/dang-nhap', 'UserController@login_post');
Route::get('/dang-ky', 'UserController@signup');
Route::post('/dang-ky', 'UserController@signup_post');
Route::get('/logout', 'UserController@logout');

Route::get('/addtocart', 'CartController@addtocart');
Route::get('/cart/update', 'CartController@updateCart');
Route::get('/gio-hang', 'CartController@cart');
Route::get('/removeall', 'CartController@removeallCart');
Route::get('/cart/remove/item', 'CartController@removeItemCart');
Route::get('/gio-hang/dat-hang', 'CartController@checkout');
Route::post('/gio-hang/dat-hang', 'CartController@checkout_oder');
Route::get('/cart/district', 'CartController@getdistrict');
Route::get('/cart/shipping', 'CartController@getdistrict_shipping');
Route::get('/hoan-tat-dat-hang', 'CartController@CartSuccess');

Route::get('/san-pham/sale', 'HomeController@product_sale');

Route::get('/lien-he', 'HomeController@contact');
Route::post('/lien-he', 'HomeController@contact_post');

Route::post('/newsletter', 'HomeController@newsletter');

Route::post('/cart/check-code-coupon', 'CartController@checkcodecoupon');
Route::post('/cart/remove-code-coupon', 'CartController@removecodecoupon');
require(app_path() . '/tproutes/admin.php');