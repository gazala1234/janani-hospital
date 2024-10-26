<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});

Route::get('register', function () {
    return view('register');
})->name('register');

Route::get('dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('userdetails', function () {
    return view('userdetails');
})->name('userdetails');