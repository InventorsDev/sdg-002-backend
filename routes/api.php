<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;

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

});
