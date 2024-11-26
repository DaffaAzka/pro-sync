<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['set.bearer.token','auth:api'])->group(function (){
    Route::get('dashboard', [\App\Http\Controllers\PageController::class, 'dashboard'])->name('dashboard');
    Route::get('logout', [\App\Http\Controllers\AuthController::class, 'revokeToken'])->name('logout');
    Route::get('partners', [\App\Http\Controllers\PartnerController::class, 'show'])->name('partners.show');
    Route::get('request', [\App\Http\Controllers\RequestController::class, 'index'])->name('request.index');

//  Project
    Route::get('project/{id}', [\App\Http\Controllers\ProjectController::class, 'show'])->name('show.project')->middleware(\App\Http\Middleware\ValidateProjectAccess::class);
    Route::get('projects', [\App\Http\Controllers\ProjectController::class, 'index'])->name('lists.project');
    Route::post('project', [\App\Http\Controllers\ProjectController::class, 'store'])->name('store.project');

//  Partners
    Route::post('find-partners', [\App\Http\Controllers\PartnerController::class, 'findUser'])->name('find.partners');
    Route::get('add-partners/{username}', [\App\Http\Controllers\PartnerController::class, 'store'])->name('store.partner');

//  Request
    Route::get('accept-partner/{username}', [\App\Http\Controllers\RequestController::class, 'responsePartners'])->name('accept.partner');
    Route::get('accept-project/{slug}', [\App\Http\Controllers\RequestController::class, 'responseInviteProject'])->name('accept.project');
    Route::post('send-project-request', [\App\Http\Controllers\RequestController::class, 'store'])->name('send.project.request');
});


Route::get('login', function () {return view('login');})->name('login');
Route::get('register', [\App\Http\Controllers\UserController::class, 'create'])->name('register');
Route::post('register', [\App\Http\Controllers\UserController::class, 'store'])->name('register.store');

Route::post('login', [\App\Http\Controllers\AuthController::class, 'login'])->name('verify.email');
Route::post('verify-code', [\App\Http\Controllers\AuthController::class, 'getTokens'])->name('verify.code');

