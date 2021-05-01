<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\EmergencyContactController;
use App\Http\Controllers\MedicationController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'v1'], function(){

    Route::group(['prefix' => 'auth'], function(){
        Route::post('/register', [RegisterController::class, 'store']);
        Route::post('/login', [LoginController::class, 'login']);
        Route::post('/logout', [LoginController::class, 'logout']);
        Route::get('/user', [LoginController::class, 'me']);
        Route::post('/refresh', [LoginController::class, 'refresh']);
        Route::post('/forgot-password', [ForgotPasswordController::class, 'store']);
        Route::post('/reset-password', [ResetPasswordController::class, 'store']);
    });

    Route::apiResource('contacts', EmergencyContactController::class)->parameters([
        'contacts' => 'emergencyContact',
    ]);

    Route::group(['prefix' => 'user'], function(){
        Route::post('fcm/token', [UserController::class, 'fcmToken']);
    });

    Route::apiResource('medications', MedicationController::class)->only(['store', 'show']);

    Route::get('reminders', [MedicationController::class, 'reminders']);

    Route::post('reminders/{reminder}/mark-as-read', [MedicationController::class, 'markAsRead']);

    Route::post('reminders/{reminder}/mark-as-completed', [MedicationController::class, 'markAsCompleted']);

});
