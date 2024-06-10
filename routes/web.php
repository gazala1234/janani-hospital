<?php

use Illuminate\Support\Facades\Route;
use App\Controllers\AuthController;

Route::get('/', function () {
    return view('main');
})->name('mainpage');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/add_assignment', function () {
    return view('add_assignment');
})->name('add_assignment');

Route::get('/contact', function () {
    return view('contact');
})->name('contactpage');

Route::get('/login', function () {
    return view('login');
});
Route::get('/login1', function () {
    return view('register');
});