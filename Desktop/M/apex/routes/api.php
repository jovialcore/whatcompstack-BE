<?php

use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\MarketerMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [App\Http\Controllers\Api\AuthController::class, 'login']);
Route::post('/register', [\App\Http\Controllers\Api\AuthController::class, 'register']);

Route::middleware(['auth:api'])->group(function () {

    Route::middleware(['marketers'])->group(function () {
        
        Route::get('/list', [App\Http\Controllers\MarketingController::class, 'listMarketingChannels']);
        Route::post('/create', [App\Http\Controllers\MarketingController::class, 'createMarketChannels']);
        Route::patch('/update', [App\Http\Controllers\MarketingController::class, 'updateMarketingChannel']);
        Route::delete('/delete', [App\Http\Controllers\MarketingController::class, 'deleteMarketingChannel']);
    });


    // admin routes
    Route::prefix('admin')->group(function () {

        Route::get('/assign/role', [App\Http\Controllers\AdminController::class, 'assignMarketerRights'])
            ->middleware(AdminMiddleware::class);
    });
});
