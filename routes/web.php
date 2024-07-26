<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\StorePreviousUrl;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',[HomeController::class,'home'])->name('home');
Route::get('/hello', [ItemController::class, 'otamesi']);

// アイテム
Route::get('/item/view',function() {return view('item.list');})->name('item.view');
Route::get('/item/list', [ItemController::class, 'list'])->name('item.list');
Route::get('/item/detail/{item}',[ItemController::class,'detail'])->name('item.detail');
Route::get('/item/add/{item}',[ItemController::class,'itemAdd'])->name('item.add');
Route::get('/item/search',[ItemController::class,'itemSearch'])->name('item.search');
Route::get('/item/genreList',[ItemController::class,'genreList'])->name('item.genreList');
Route::get('/item/genre',[ItemController::class,'genre'])->name('item.genre');

// レビュー
Route::get('/review/{itemId}',[ReviewController::class,'review'])->name('review');
Route::post('/reviewAdd',[ReviewController::class,'reviewAdd'])->name('review.add');
Route::post('/reviewEdit',[ReviewController::class,'reviewEdit'])->name('review.edit');
Route::get('/reviewGood',[ReviewController::class,'reviewGood'])->name('review.good');

// カート
Route::get('/cart/index',[CartController::class,'index'])->name('cart.index')->middleware(StorePreviousUrl::class);
Route::delete('/cart/destroy/{id}',[CartController::class,'destroy'])->name('cart.destroy');
Route::post('/cart/update/{cart}',[CartController::class,'update'])->name('cart.update');
Route::get('/cart/after/{cartId}',[CartController::class,'after'])->name('cart.after');
Route::get('/cart/return/{cartId}',[CartController::class,'return'])->name('cart.return');

// ユーザー
Route::get('/toLogin',function(){return view('user.login');})->name('user.toLogin');
Route::get('/toInsert',function(){return view('user.insert');})->name('user.toInsert');
Route::post('/login',[UserController::class,'login'])->name('user.login');
Route::post('/insert',[UserController::class,'insert'])->name('user.insert');
Route::get('/logOut',[UserController::class,'logOut'])->name('user.logOut');
Route::get('/user/toEdit',function(){return view('user.edit');})->name('user.toEdit');
Route::post('/user/edit',[UserController::class,'edit'])->name('user.edit');

//商品購入履歴
Route::get('history/list',[HistoryController::class,'list'])->name('history.list')->middleware(StorePreviousUrl::class);

// 注文
Route::get('/order/confirm',[OrderController::class,'confirm'])->name('order.confirm');
Route::post('/order/payment',[OrderController::class,'payment'])->name('order.payment');
Route::get('/order/buy',function(){return view('order.payment');});
Route::get('/order/delivery/{historyId}',[OrderController::class,'delivery'])->name('order.delivery');
Route::get('/order/detail/{historyId}',[OrderController::class,'detail'])->name('order.detail');
