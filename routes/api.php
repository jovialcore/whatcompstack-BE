<?php

use App\Http\Controllers\Api\Auth\EmailVerficationController;
use App\Http\Controllers\Auth\VerificationController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\ApiResponse;


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


Route::post('/community/signup',  [App\Http\Controllers\Api\Auth\SignupController::class, 'signup']);


Route::get('/email/verify/{id}/{hash}', [EmailVerficationController::class, 'verificationHandler'])
    ->middleware(['auth:sanctum', 'signed'])->name('verification.verify');



Route::post('/login', [App\Http\Controllers\Api\Auth\LoginController::class, 'login']);


Route::post('/community/verify/email',  [App\Http\Controllers\Api\Auth\EmailVerficationController::class, 'verify']);


Route::middleware('auth:sanctum')->prefix('/community/member')->group(function () {

    Route::get('/', function (Request $request) {
        return $request->user() ?: response()->json(['message' => 'Sorry. No user found']);
    });


    Route::post('/logout', function (Request $request) {

        auth()->guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json(['message' =>  "You have been successfully logout"]);
    });

    // Route::get('/company/stack/all', [App\Http\Controllers\Api\CompanyStackController::class, 'index']);
});

// Route::get('/profile', function () {
//     // Only verified users may access this route...

// })->middleware(['auth', 'verified']);






Route::get('/company/stack/details/{source_slug}', [App\Http\Controllers\Api\CompanyStackController::class, 'show']);
