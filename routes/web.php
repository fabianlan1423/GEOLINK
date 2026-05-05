<?php

use Illuminate\Support\Facades\Route;

/*Route::get('/', function () {
    return view('welcome');
});*/
Route::get('/', function () {
    return view('registro');
});

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');


