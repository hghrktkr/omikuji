<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\test_controller;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/tests/test', [test_controller::class, 'index'] );

