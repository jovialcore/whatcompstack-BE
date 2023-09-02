<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/scrapper/company', [App\Http\Controllers\ScraperController::class, 'fetch']);

Route::get('/scrapper/home', [App\Http\Controllers\ScraperController::class, 'homepageScrape']);


Route::get('/', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');

Route::prefix('admin')->group(function () {



    Route::get('/dashboard',  [App\Http\Controllers\DataControlController::class, 'index'])->name('admin.scrapper');

    Route::post('/dashboard/intialize',  [App\Http\Controllers\DataControlController::class, 'initiateDataSourcing'])->name('admin.datasource.initialize');

    Route::get('/dashboard/preview/soruced-results/{company}',  [App\Http\Controllers\DataControlController::class, 'preview'])->name('admin.preview.results');

    Route::post('/dashboard/preview/confirm/results/{company}',  [App\Http\Controllers\DataControlController::class, 'confirmResults'])->name('admin.preview.result.confirm');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
