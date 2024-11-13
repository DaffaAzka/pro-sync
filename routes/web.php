<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['set.bearer.token','auth:api'])->group(function (){
    Route::get('dashboard', [\App\Http\Controllers\PageController::class, 'dashboard'])->name('dashboard');
    Route::get('logout', [\App\Http\Controllers\AuthController::class, 'revokeToken'])->name('logout');
});


Route::get('login', function () {return view('login');})->name('login');
Route::get('register', [\App\Http\Controllers\UserController::class, 'create'])->name('register');
Route::post('register', [\App\Http\Controllers\UserController::class, 'store'])->name('register.store');

Route::post('verify-email', [\App\Http\Controllers\AuthController::class, 'verifyEmail'])->name('verify.email');
Route::post('verify-code', [\App\Http\Controllers\AuthController::class, 'getTokens'])->name('verify.code');

