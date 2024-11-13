<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['set.bearer.token','auth:api'])->group(function (){
    Route::get('dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


Route::get('login', function () {
    return view('login');
})->name('login');

Route::post('verify-email', [\App\Http\Controllers\AuthController::class, 'verifyEmail'])->name('verify.email');
Route::post('verify-code', [\App\Http\Controllers\AuthController::class, 'getTokens'])->name('verify.code');

