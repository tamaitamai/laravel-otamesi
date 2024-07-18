<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',function(){return view('home');})->name('home');
Route::get('/hello', [ItemController::class, 'otamesi']);

// アイテム
Route::get('/item/list', [ItemController::class, 'list'])->name('item.list');
Route::get('/item/detail/{item}',[ItemController::class,'detail'])->name('item.detail');
Route::get('/item/add/{item}',[ItemController::class,'itemAdd'])->name('item.add');

// レビュー
Route::get('/review/{itemId}',[ReviewController::class,'review'])->name('review');
Route::post('/reviewAdd',[ReviewController::class,'reviewAdd'])->name('review.add');
Route::post('/reviewEdit',[ReviewController::class,'reviewEdit'])->name('review.edit');
Route::get('/reviewGood',[ReviewController::class,'reviewGood'])->name('review.good');

// カート
Route::get('/cart/index',[CartController::class,'index'])->name('cart.index');
Route::delete('/cart/destroy/{id}',[CartController::class,'destroy'])->name('cart.destroy');
Route::post('/cart/update/{cart}',[CartController::class,'update'])->name('cart.update');

// ユーザー
Route::get('/toLogin',function(){return view('user.login');})->name('user.toLogin');
Route::get('/toInsert',function(){return view('user.insert');})->name('user.toInsert');
Route::post('/login',[UserController::class,'login'])->name('user.login');
Route::post('/insert',[UserController::class,'insert'])->name('user.insert');
Route::get('/logOut',[UserController::class,'logOut'])->name('user.logOut');
Route::get('/user/toEdit',function(){return view('user.edit');})->name('user.toEdit');
Route::post('/user/edit',[UserController::class,'edit'])->name('user.edit');

//商品購入履歴
Route::get('history/list',[HistoryController::class,'list'])->name('history.list');

// 注文
Route::get('order/confirm',[OrderController::class,'confirm'])->name('order.confirm');
Route::post('/order/payment',[OrderController::class,'payment'])->name('order.payment');
Route::get('/order/buy',function(){return view('order.payment');});
