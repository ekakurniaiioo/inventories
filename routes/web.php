<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('hjs');
});

Route::get('/create', function () {
    return view('createCollections');
});
