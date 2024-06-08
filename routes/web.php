<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('main');
})->name('mainpage');

Route::get('/dashboard', function () {
    return view('dashboard');
});
Route::get('/add_assignment', function () {
    return view('add_assignment');
})->name('add_assignment');

Route::get('/contact', function () {
    return view('contact');
})->name('contactpage');