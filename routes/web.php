<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

// Users
Route::prefix('users')->group(function () {
    Route::get('/', [App\Http\Controllers\UserController::class, 'index'])->name('users');
    Route::get('/export', [App\Http\Controllers\UserController::class, 'export'])->name('users.export');
    Route::get('/new', [App\Http\Controllers\UserController::class, 'new'])->name('users.new');
    Route::post('/create', [App\Http\Controllers\UserController::class, 'create'])->name('users.create');
    Route::get('/{id}/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('users.edit');
    Route::post('/{id}/update', [App\Http\Controllers\UserController::class, 'update'])->name('users.update');
    Route::get('/{id}/destroy', [App\Http\Controllers\UserController::class, 'destroy'])->name('users.destroy');
    Route::post('/{id}/change_password', [App\Http\Controllers\UserController::class, 'change_password']);
    Route::get('/password', [App\Http\Controllers\UserController::class, 'password']);
});

// Businesses
Route::prefix('businesses')->group(function () {
    Route::get('/', [App\Http\Controllers\BusinessController::class, 'index'])->name('businesses');
    Route::get('/export', [App\Http\Controllers\BusinessController::class, 'export'])->name('businesses.export');
    Route::get('/new', [App\Http\Controllers\BusinessController::class, 'new'])->name('businesses.new');
    Route::post('/create', [App\Http\Controllers\BusinessController::class, 'create'])->name('businesses.create');
    Route::get('/{id}/edit', [App\Http\Controllers\BusinessController::class, 'edit'])->name('businesses.edit');
    Route::post('/{id}/update', [App\Http\Controllers\BusinessController::class, 'update'])->name('businesses.update');
    Route::get('/{id}/destroy', [App\Http\Controllers\BusinessController::class, 'destroy'])->name('businesses.destroy');
});

// Metrics
Route::prefix('metrics')->group(function () {
    Route::get('/', [App\Http\Controllers\MetricController::class, 'index'])->name('metrics');
    Route::get('/export', [App\Http\Controllers\MetricController::class, 'export'])->name('metrics.export');
    Route::get('/new', [App\Http\Controllers\MetricController::class, 'new'])->name('metrics.new');
    Route::post('/create', [App\Http\Controllers\MetricController::class, 'create'])->name('metrics.create');
    Route::get('/{id}/edit', [App\Http\Controllers\MetricController::class, 'edit'])->name('metrics.edit');
    Route::post('/{id}/update', [App\Http\Controllers\MetricController::class, 'update'])->name('metrics.update');
    Route::get('/{id}/destroy', [App\Http\Controllers\MetricController::class, 'destroy'])->name('metrics.destroy');
});

// Tool
Route::get('/tool', [App\Http\Controllers\HomeController::class, 'tool'])->name('tool');
Route::post('/tool/result', [App\Http\Controllers\HomeController::class, 'result'])->name('tool.result');
Route::post('/tool/analyse', [App\Http\Controllers\HomeController::class, 'analyse'])->name('tool.analyse');

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
