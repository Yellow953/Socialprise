<?php

use App\Http\Controllers\BusinessController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MetricController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

// Users
Route::prefix('users')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('users');
    Route::get('/export', [UserController::class, 'export'])->name('users.export');
    Route::get('/new', [UserController::class, 'new'])->name('users.new');
    Route::post('/create', [UserController::class, 'create'])->name('users.create');
    Route::get('/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::post('/{user}/update', [UserController::class, 'update'])->name('users.update');
    Route::get('/{user}/destroy', [UserController::class, 'destroy'])->name('users.destroy');
    Route::post('/{user}/change_password', [UserController::class, 'change_password'])->name('users.change_password');
    Route::get('/password', [UserController::class, 'password'])->name('users.password');
});

// Businesses
Route::prefix('businesses')->group(function () {
    Route::get('/', [BusinessController::class, 'index'])->name('businesses');
    Route::get('/export', [BusinessController::class, 'export'])->name('businesses.export');
    Route::get('/new', [BusinessController::class, 'new'])->name('businesses.new');
    Route::post('/create', [BusinessController::class, 'create'])->name('businesses.create');
    Route::get('/{business}/edit', [BusinessController::class, 'edit'])->name('businesses.edit');
    Route::post('/{business}/update', [BusinessController::class, 'update'])->name('businesses.update');
    Route::get('/{business}/destroy', [BusinessController::class, 'destroy'])->name('businesses.destroy');
});

// Metrics
Route::prefix('metrics')->group(function () {
    Route::get('/', [MetricController::class, 'index'])->name('metrics');
    Route::get('/export', [MetricController::class, 'export'])->name('metrics.export');
    Route::get('/new', [MetricController::class, 'new'])->name('metrics.new');
    Route::post('/create', [MetricController::class, 'create'])->name('metrics.create');
    Route::get('/{metric}/edit', [MetricController::class, 'edit'])->name('metrics.edit');
    Route::post('/{metric}/update', [MetricController::class, 'update'])->name('metrics.update');
    Route::get('/{metric}/destroy', [MetricController::class, 'destroy'])->name('metrics.destroy');
});

// Roles
Route::prefix('roles')->group(function () {
    Route::get('/', [RoleController::class, 'index'])->name('roles');
    Route::get('/export', [RoleController::class, 'export'])->name('roles.export');
    Route::get('/new', [RoleController::class, 'new'])->name('roles.new');
    Route::post('/create', [RoleController::class, 'create'])->name('roles.create');
    Route::get('/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit');
    Route::post('/{role}/update', [RoleController::class, 'update'])->name('roles.update');
    Route::get('/{role}/destroy', [RoleController::class, 'destroy'])->name('roles.destroy');
});

// Tool
Route::get('/tool', [HomeController::class, 'tool'])->name('tool');
Route::post('/tool/result', [HomeController::class, 'result'])->name('tool.result');
Route::post('/tool/analyse', [HomeController::class, 'analyse'])->name('tool.analyse');

Route::get('/', [HomeController::class, 'index'])->name('home');
