<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurchaseController;

//ログイン画面・登録画面の機能はfortify

//商品一覧ページ
Route::get('/', [ItemController::class, 'index'])->name('item.index');
//商品検索
Route::get('/search', [ItemController::class, 'search'])->name('item.search');
//商品詳細
Route::get('/item/{item_id}', [ItemController::class, 'show'])->name('item.show');

Route::middleware('auth')->group(function () {
    // マイページ（表示）
    Route::get('/mypage', [ProfileController::class, 'index'])->name('profile.index');
    //プロフィール設定画面
    Route::get('/mypage/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    //プロフィール更新処理
    Route::put('/mypage/profile', [ProfileController::class, 'update'])->name('profile.update');
    //商品出品
    Route::get('/sell', [ItemController::class, 'create'])->name('item.create');
    //商品出品処理
    Route::post('/sell', [ItemController::class, 'store'])->name('item.store');
    //いいね機能
    Route::post('/item/{item_id}/like', [ItemController::class, 'like'])->name('item.like');
    //コメント機能
    Route::post('/item/{item_id}/comment', [ItemController::class, 'comment'])->name('item.comment');
    //商品購入画面
    Route::get('/item/{item_id}/purchase', [PurchaseController::class, 'create'])->name('purchase.create');
    //商品購入
    Route::post('/item/{item_id}/purchase', [PurchaseController::class, 'store'])->name('purchase.store');
    //配送先変更画面
    Route::get('/purchase/address/{item_id}', [PurchaseController::class, 'edit'])->name('purchase.address.edit');
    // 配送先更新
    Route::patch('/purchase/address/{item_id}', [PurchaseController::class, 'update'])->name('purchase.address.update');
});
