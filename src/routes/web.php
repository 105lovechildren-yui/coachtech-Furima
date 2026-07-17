<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProfileController;

//ログイン画面・登録画面の機能はfortify

//商品一覧ページ
Route::get('/', [ItemController::class, 'index'])->name('item.index');
//商品検索
Route::get('/search', [ItemController::class, 'search'])->name('item.search');
//商品詳細
Route::get('/item/{item_id}', [ItemController::class, 'show'])->name('item.show');

Route::middleware('auth')->group(function () {
    //プロフィール設定画面
    Route::get('/mypage/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    //プロフィール更新処理
    Route::put('/mypage/profile', [ProfileController::class, 'update'])->name('profile.update');
    //商品出品
    Route::get('/sell', [ItemController::class, 'create'])->name('item.create');
    //商品出品処理
    Route::post('/sell', [ItemController::class, 'store'])->name('item.store');
});

