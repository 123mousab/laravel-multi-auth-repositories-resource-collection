<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::group([
    'prefix' => 'user'
], function () {
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
});

// Route Admin
Route::group([
    'prefix' => 'admin'
], function () {
    Route::post('login', 'AdminController@login');
    Route::post('signup', 'AdminController@signup');
});


Route::group([
    'prefix' => 'admin',
    'middleware' => 'auth:admins'
], function () {
    Route::post('logout', 'AdminController@logout');
    Route::post('refresh', 'AdminController@refresh');
    Route::post('profile', 'AdminController@me');
});

Route::group([
    'prefix' => 'user',
    'middleware' => 'auth:api'
], function () {
    Route::post('logout', 'AuthController@logout');
    Route::get('get_users', 'AuthController@getUsers');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('profile', 'AuthController@me');
    Route::get('find/{user_id}', 'ProfileController@find');
});

Route::group([
    'prefix' => 'auth'
], function () {
    Route::get('index', 'AuthController@index');
});

Route::group(['prefix' => 'customer'], function (){
    Route::get('/', 'CustomerController@index');
    Route::get('/{customerId}', 'CustomerController@show');
    Route::post('/{customerId}/update', 'CustomerController@update');
    Route::delete('/{customerId}/delete', 'CustomerController@delete');
});

Route::group(['prefix' => 'pay'], function (){
    Route::get('/', 'PayOrderController@store');
});



Route::group(['prefix' => 'book'], function (){
    Route::get('find/{book_id}', 'BookController@find');
    Route::get('find_books/{author_id}', 'BookController@findBooks');
    Route::get('authors', 'BookController@authors');
});

Route::group(['prefix' => 'product'], function (){
    Route::post('attach_product', 'ProductController@attachProduct');
    Route::post('detach_product', 'ProductController@detachProduct');
    Route::post('attach_category', 'ProductController@attachCategory');
    Route::post('detach_category', 'ProductController@detachCateogry');
});

Route::group(['prefix' => 'affilate'], function (){
    Route::get('first', 'PostController@first');
});

Route::group(['prefix' => 'video'], function (){
    Route::post('store', 'VideoController@store');
    Route::get('find/{series_id}', 'VideoController@find');
    Route::get('find_video/{video_id}', 'VideoController@findVideo');
});

Route::group(['prefix' => 'post'], function (){
    Route::post('like', 'PostController@like')->middleware('auth:api');
});
