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


