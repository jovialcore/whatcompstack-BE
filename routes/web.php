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


    Route::get('/companies/add',  [App\Http\Controllers\CompanyController::class, 'create'])->name('admin.company.add');

    Route::get('/companies',  [App\Http\Controllers\CompanyController::class, 'index'])->name('admin.company.index');

    Route::post('/companies/store',  [App\Http\Controllers\CompanyController::class, 'store'])->name('admin.company.store');

    Route::get('/companies/show/{id}',  [App\Http\Controllers\CompanyController::class, 'show'])->name('admin.company.show');

    Route::post('/preview/confirm/results/{company}',  [App\Http\Controllers\DataControlController::class, 'confirmResults'])->name('admin.preview.result.confirm');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
