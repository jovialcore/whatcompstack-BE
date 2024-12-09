<?php

use App\Http\Controllers\Api\CrudController;
use App\Http\Controllers\HngController;
use Illuminate\Http\Request;
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

Route::get('/company/stack/all', [App\Http\Controllers\Api\CompanyStackController::class, 'index']);



Route::get('/company/stack/details/{id}', [App\Http\Controllers\Api\CompanyStackController::class, 'show']);
Route::get('/companies', [App\Http\Controllers\Api\CompanyStackController::class, 'index']);
Route::get('/companies/search', [App\Http\Controllers\Api\CompanyStackController::class, 'findByName']);

