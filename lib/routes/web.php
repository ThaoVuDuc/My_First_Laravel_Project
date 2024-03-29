<?php

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

Route::get('/', 'FrontendController@getHome');
Route::get('detail/{id}/{slug}.html', 'FrontendController@getDetail');
Route::post('detail/{id}/{slug}.html', 'FrontendController@postComment');
Route::get('category/{id}/{slug}.html', 'FrontendController@getCategory');
Route::get('coment/{id}/{slug}.html', 'FrontendController@getCategory');
Route::get('search', 'FrontendController@getSearch');
Route::group(['prefix' => 'cart'], function(){
	Route::get('add/{id}', 'CartController@getAddCart');
	Route::get('show', 'CartController@getShowCart');
	Route::get('delete/{id}', 'CartController@getDeleteCart');
	Route::get('update', 'CartController@getUpdateCart');
	Route::post('show', 'CartController@postComplete');
});
Route::get('complete', 'FrontendController@getComplete');
Route::group(['namespace'=>'Admin'], function(){
	Route::group(['prefix'=>'login', 'middleware' => 'CheckLogedIn'], function(){
		Route::get('/', 'LoginController@getLogin');
		Route::post('/', [
			'as'=>'loginUser',
			'uses'=>'LoginController@postLogin']
		);
	});
	Route::get('logout', 'HomeController@getLogout');
	//route group gồm công việc liên quan đến admin
	//các route tiếp theo sẽ có url bắt đầu là admin/...
	Route::group(['prefix'=>'admin', 'middleware'=>'CheckLogedOut'], function(){
		Route::get('home', 'HomeController@getHome');//tạo một controller trong thư mục admin cú pháp : php artisan make:controller Admin\HomeController
		Route::group(['prefix' => 'category'], function(){
			Route::get('/', 'CategoryController@getCate');
			Route::post('/', 'CategoryController@postCate');
			Route::get('edit/{id}', 'CategoryController@getEditCate');
			Route::post('edit/{id}', 'CategoryController@postEditCate');
			Route::get('delete/{id}', 'CategoryController@getDeleteCate');
		});
		Route::group(['prefix' => 'product'], function(){
			Route::get('/', 'ProductController@getProduct');
			Route::get('add', 'ProductController@getAddProduct');
			Route::post('add', 'ProductController@postAddProduct');
			Route::get('edit/{id}', 'ProductController@getEditProduct');
			Route::post('edit/{id}', 'ProductController@postEditProduct');
			Route::get('delete/{id}', 'ProductController@getDeleteProduct');
		});
	});
});