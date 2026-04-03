<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;

Route::get('/', [ItemController::class, 'index']);

Route::get('/create', [ItemController::class, 'create']);

Route::resource('items', ItemController::class);
Route::post('/items/{id}/stock-in', [ItemController::class, 'stockIn'])->name('items.stock.in');
Route::post('/items/{id}/stock-out', [ItemController::class, 'stockOut'])->name('items.sotck.out');
