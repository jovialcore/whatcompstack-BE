<?php

use App\Http\Controllers\CrudController;
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
Route::get('/slackbot/passed/stage', [App\Http\Controllers\HngController::class,  'downloadCsv']);

Route::get('/',  [App\Http\Controllers\DashboardController::class, 'index'])->name('admin.dashboard.index');

Route::prefix('/dashboard')->group(function () {

    Route::get('/preview/data-control',  [App\Http\Controllers\DataControlController::class, 'index'])->name('admin.dataControl.index');

    Route::post('/intialize',  [App\Http\Controllers\DataControlController::class, 'initiateDataSourcing'])->name('admin.datasource.initialize');

    Route::get('/preview/soruced-results/{company}',  [App\Http\Controllers\DataControlController::class, 'preview'])->name('admin.preview.results');

    Route::post('/preview/confirm/results/{company}',  [App\Http\Controllers\DataControlController::class, 'confirmResults'])->name('admin.preview.result.confirm');
});



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
