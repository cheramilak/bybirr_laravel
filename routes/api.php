<?php

use App\Http\Controllers\Api\v1\AuthController;
use App\Http\Controllers\Api\v1\CardController;
use App\Http\Controllers\Api\v1\KycController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1/')->group(function () {


    Route::controller(AuthController::class)->prefix('auth/')->group(function () {
        route::post('signup', 'registor');
        route::post('login', 'login');
        route::get('getUserProfile', 'getUserProfile')->middleware('auth:sanctum');
        route::post('logout', 'logout')->middleware('auth:sanctum');
    });

    Route::middleware('auth:sanctum')->group(function () {
        Route::controller(KycController::class)->group(function () {
            route::post('set-kyc', 'store');
        });
    });

    Route::middleware('auth:sanctum')->prefix('card/')->group(function () {
        Route::controller(CardController::class)->group(function () {
            route::post('order-card', 'ordercard');
            route::get('getCurrentRate', 'getCurrentRate');
        });
    });
});
