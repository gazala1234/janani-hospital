<?php

use App\Http\Controllers\AskDoctorController;
use App\Http\Controllers\AskSuggestionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BabyShowerController;
use App\Http\Controllers\IntroduceYourselfController;
use App\Http\Controllers\BookConsultController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\SettingsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Login & Register routes start
Route::post('user-auth-login', [AuthController::class,'auth_login']);
Route::apiResource('user-auth', AuthController::class);
// Login & Register routes end

Route::apiResource('ask-doctor', AskDoctorController::class);
Route::apiResource('book-consult', BookConsultController::class);
Route::apiResource('settings', SettingsController::class);
Route::apiResource('services', ServicesController::class);
Route::apiResource('events', EventsController::class);
Route::apiResource('ask-suggestion', AskSuggestionController::class);
Route::apiResource('baby-shower', BabyShowerController::class);
Route::apiResource('introduce-yourself', IntroduceYourselfController::class);

?>