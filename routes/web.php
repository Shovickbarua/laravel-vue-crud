<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/{uri?}', function () {
    return view('home');
})->where('uri', '(.*)');
