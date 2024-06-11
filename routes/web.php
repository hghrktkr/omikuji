<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\HistoryController;
use Illuminate\Support\Facades\Route;

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

Route::post('/result', [ItemController::class, 'omikuji_draw'])->name('omikuji.result');
Route::post('/dashboard', [HistoryController::class, 'add_history'])->name('omikuji.savehistory');
Route::get('/history', [HistoryController::class, 'show_history'])->name('omikuji.history');

require __DIR__.'/auth.php';
