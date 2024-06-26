<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::middleware(['web'])->group(function () {
    // Routes handled by AuthController
    Route::controller(AuthController::class)->group(function () {
        Route::get('/register', 'register')->name('register');
        Route::post('/login', 'login')->name('login');
    });

    // Routes handled by AssignmentController
    Route::controller(AssignmentController::class)->group(function () {
        // Route::get('/register', 'register')->name('register');
        // Route::post('/login', 'login')->name('login');
        // Route::get('/add','index')->name('index');
    });


    // Logout route (outside of groups)
    Route::get('/logout', function (Request $request) {
        $request->session()->forget(['id', 'name', 'cid', 'did']);
        $request->session()->flush();
        return redirect()->route('login');
    })->name('logout');
});
