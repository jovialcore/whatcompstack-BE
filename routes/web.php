<?php

use App\Http\Controllers\CrudController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

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


Auth::routes(['register' => false, 'reset' => false, 'verify' => false]);

Route::group(['middleware' => 'admin'], function () {


    Route::get('/',  [App\Http\Controllers\DashboardController::class, 'index'])->name('admin.dashboard.index');

    Route::prefix('/dashboard')->name('admin.')->group(function () {

        Route::get('/preview/data-control',  [App\Http\Controllers\DataControlController::class, 'index'])->name('dataControl.index');

        Route::post('/intialize',  [App\Http\Controllers\DataControlController::class, 'initiateDataSourcing'])->name('datasource.initialize');

        Route::get('/preview/soruced-results/{company}',  [App\Http\Controllers\DataControlController::class, 'preview'])->name('preview.results');

        Route::get('/companies/add',  [App\Http\Controllers\CompanyController::class, 'create'])->name('company.add');

        Route::get('/companies',  [App\Http\Controllers\CompanyController::class, 'index'])->name('company.index');

        Route::post('/companies/store',  [App\Http\Controllers\CompanyController::class, 'store'])->name('company.store');

        Route::get('/companies/{id}/show',  [App\Http\Controllers\CompanyController::class, 'show'])->name('company.show');

        Route::post('/preview/confirm/results/{company}',  [App\Http\Controllers\DataControlController::class, 'confirmResults'])->name('preview.result.confirm');


        //source

        Route::get('/source/create', [App\Http\Controllers\DataSourceController::class, 'create'])->name('source.create');
        Route::get('/source/index', [App\Http\Controllers\DataSourceController::class, 'index'])->name('source.index');
        Route::post('/source/store', [App\Http\Controllers\DataSourceController::class, 'store'])->name('source.store');


        //stacks
        Route::get('/stack/index', [App\Http\Controllers\GeneralStackController::class, 'index'])->name('stack.index');

        //backend
        Route::prefix('/stack/backend')->group(function () {
            Route::get('/stack/backend/create', [App\Http\Controllers\BackendController::class, 'create'])->name('stack.backend.create');
            Route::post('/stack/store', [App\Http\Controllers\BackendController::class, 'store'])->name('stack.backend.store');
        });

        //frontend
        Route::prefix('/stack/frontend')->group(function () {

            Route::get('/create', [App\Http\Controllers\FrontendController::class, 'create'])->name('stack.frontend.create');
            Route::post('/store', [App\Http\Controllers\FrontendController::class, 'store'])->name('stack.frontend.store');
        });


        //mobile
        Route::prefix('/stack/mobile')->group(function () {

            Route::get('/create', [App\Http\Controllers\MobileController::class, 'create'])->name('stack.mobile.create');
            Route::post('/store', [App\Http\Controllers\MobileController::class, 'store'])->name('stack.mobile.store');
        });

    });
});


Route::get('/not-an-admin', function () {
    return View('nonAdmin.home');
})->name('non.admin.user')->middleware('not.an.admin');
