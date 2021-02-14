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

//商品一覧画面
Route::get('/','ShopController@index');

//カート画面 ログインしている人にだけ表示する
Route::get('/mycart','ShopController@myCart')->middleware('auth');

//カートに追加
Route::post('/mycart','ShopController@addMyCart');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
