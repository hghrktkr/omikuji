<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminUserEditController;

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckActiveSession;


Route::get('/', function () {
    return view('welcome');
});

// ユーザー情報の修正(今回は使ってない)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ユーザーログイン後のページ
Route::middleware('auth')->group(function(){
    Route::post('/result', [ItemController::class, 'omikuji_draw'])->name('omikuji.result');
    Route::get('/history', [HistoryController::class, 'show_history'])->name('omikuji.history');
    Route::get('/empty', function(){return view('omikuji.empty');})->name('omikuji.empty');
    Route::post('/start', function(){return view('omikuji.start');})->name('omikuji.start');
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// 管理者ルーティング
Route::prefix('admin')->group(function(){

    // 管理者ログイン処理
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login']);
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

    // 管理者ログイン後のページ
    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', [AdminUserEditController::class, 'index'])->name('admin.dashboard');
        Route::post('/dashboard/edit', [AdminUserEditController::class, 'edit'])->name('admin.dashboard.edit');
        Route::get('/dashboard/edit', [AdminUserEditController::class, 'edit'])->name('admin.dashboard.edit.get');
        Route::post('/dashboard/update', [AdminUserEditController::class, 'update'])->name('admin.dashboard.update');
    });
});


require __DIR__.'/auth.php';
