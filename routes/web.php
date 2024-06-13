<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\HistoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckActiveSession;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth', CheckActiveSession::class)->group(function(){
    Route::post('/result', [ItemController::class, 'omikuji_draw'])->name('omikuji.result');
    Route::get('/history', [HistoryController::class, 'show_history'])->name('omikuji.history');
    Route::get('/empty', function(){return view('omikuji.empty');})->name('omikuji.empty');
    Route::post('/start', function(){return view('omikuji.start');})->name('omikuji.start');
});


require __DIR__.'/auth.php';
