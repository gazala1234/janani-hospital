<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Controllers\AuthController;

Route::get('/', function () {
    return view('login');
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

Route::get('/register', function () {
    return view('register');
})->name('register');