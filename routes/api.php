<?php

use App\Http\Controllers\AskDoctorController;
use App\Http\Controllers\AskSuggestionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BabyShowerController;
use App\Http\Controllers\IntroduceYourselfController;
use App\Http\Controllers\BookConsultController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RepliesController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\UserDetailsController;
use App\Http\Controllers\ViewsCallController;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::group(['middleware' => ['web']], function () {

    Route::controller(ViewsCallController::class)->group(function () {
        Route::get('/dashboard', 'index');
        Route::get('/settings', 'getSettings');
        Route::get('/book-page', 'getBookConsult');
        Route::get('/event-page', 'getEvents');
    });

    Route::apiResource('ask-doctor', AskDoctorController::class);
    Route::apiResource('book-consult', BookConsultController::class);
    Route::apiResource('services', ServicesController::class);
    Route::apiResource('events', EventsController::class);
    Route::apiResource('ask-suggestion', AskSuggestionController::class);
    Route::apiResource('baby-shower', BabyShowerController::class);
    Route::apiResource('introduce-yourself', IntroduceYourselfController::class);
    Route::apiResource('profile', ProfileController::class);

    Route::post('/login/send-otp', [AuthController::class, 'sendOtp']);
    Route::post('/login/verify-otp', [AuthController::class, 'verifyOtp']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::apiResource('/details-user', UserDetailsController::class);
    Route::apiResource('posts', PostsController::class);
    Route::apiResource('comments', CommentsController::class);
    Route::apiResource('replies', RepliesController::class);
    // routes/api.php
    Route::put('posts/{id}/like', [PostsController::class, 'like'])->name('posts.like');
});