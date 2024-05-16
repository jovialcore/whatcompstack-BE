<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::get('/company/stack/results', [App\Http\Controllers\Api\SearchController::class, 'search']);



//Auth::routes(['register' => true, 'reset' => true, 'verify' => true]);

Route::post('/login', [App\Http\Controllers\Api\Auth\LoginController::class, 'login']);

Route::post('/community/signup',  [App\Http\Controllers\Api\Auth\SignupController::class, 'signup']);

Route::post('/community/verify/email',  [App\Http\Controllers\Api\Auth\EmailVerficationController::class, 'verify']);


Route::middleware('auth:sanctum', 'verified')->group(function () {
    //  Route::get('/user-profile',);

    Route::get('/company/stack/all', [App\Http\Controllers\Api\CompanyStackController::class, 'index']);
});

Route::get('/profile', function () {
    // Only verified users may access this route...

})->middleware(['auth', 'verified']);




Route::get('/company/stack/details/{source_slug}', [App\Http\Controllers\Api\CompanyStackController::class, 'show']);
