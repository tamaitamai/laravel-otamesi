<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',function(){return view('home');})->name('home');
Route::get('/hello', [ItemController::class, 'otamesi']);

// アイテムs
Route::get('/item/list', [ItemController::class, 'list'])->name('item.list');
Route::get('/item/detail/{item}',[ItemController::class,'detail'])->name('item.detail');
Route::get('/item/add/{item}',[ItemController::class,'itemAdd'])->name('item.add');

// レビュー
Route::get('/review/{itemId}',[ReviewController::class,'review'])->name('review');
Route::post('/reviewAdd',[ReviewController::class,'reviewAdd'])->name('review.add');
Route::post('/reviewEdit',[ReviewController::class,'reviewEdit'])->name('review.edit');

// カート
Route::get('/cart/index',[CartController::class,'index'])->name('cart.index');
Route::delete('/cart/destroy/{id}',[CartController::class,'destroy'])->name('cart.destroy');
Route::post('/cart/update/{cart}',[CartController::class,'update'])->name('cart.update');
Route::post('/cart/payment',[CartController::class,'payment'])->name('cart.payment');
Route::get('/cart/buy',function(){return view('cart.payment');});

// ログイン
Route::get('/toLogin',function(){return view('user.login');})->name('user.toLogin');
Route::get('/toInsert',function(){return view('user.insert');})->name('user.toInsert');
Route::post('/login',[UserController::class,'login'])->name('user.login');
Route::post('/insert',[UserController::class,'insert'])->name('user.insert');
Route::get('/logOut',[UserController::class,'logOut'])->name('user.logOut');

//商品購入履歴
Route::get('history/list',[HistoryController::class,'list'])->name('history.list');
