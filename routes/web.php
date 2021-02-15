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

Route::group(['middleware' => ['auth']], function() {
  //カート画面 ログインしている人にだけ表示する
  Route::get('/mycart','ShopController@myCart');
  
  //カートに追加
  Route::post('/mycart','ShopController@addMyCart');
  
  //削除機能
  Route::post('/cartdelete','ShopController@deleteCart');
  
  //購入機能
  Route::post('/checkout','ShopController@checkout');

  //購入履歴
  Route::get('/history','HistoryController@history');

}); 

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
