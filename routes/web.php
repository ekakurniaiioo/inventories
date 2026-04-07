<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('landing-page'); 
});

Route::get('/login', function () {
    return view('auth.login'); 
})->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::get('/dashboard/admin', function () {
    return view('dashboard.admin.index');
})->name('dashboard.admin');

Route::get('/dashboard/petugas', function () {
    return view('dashboard.petugas.index');
})->name('dashboard.petugas');

Route::get('/dashboard/user', function () {
    return view('dashboard.user.index');
})->name('dashboard.user');

Route::resource('items', ItemController::class);

Route::post('/items/{id}/stock-in', [ItemController::class, 'stockIn'])
    ->name('items.stock.in');

Route::post('/items/{id}/stock-out', [ItemController::class, 'stockOut'])
    ->name('items.stock.out');