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




Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['middleware' => 'admin'], function () {

    Auth::routes(['register' => false]);

    Route::get('/',  [App\Http\Controllers\DashboardController::class, 'index'])->name('admin.dashboard.index');

    Route::prefix('/dashboard')->group(function () {

        Route::get('/preview/data-control',  [App\Http\Controllers\DataControlController::class, 'index'])->name('admin.dataControl.index');

        Route::post('/intialize',  [App\Http\Controllers\DataControlController::class, 'initiateDataSourcing'])->name('admin.datasource.initialize');

        Route::get('/preview/soruced-results/{company}',  [App\Http\Controllers\DataControlController::class, 'preview'])->name('admin.preview.results');

        Route::get('/companies/add',  [App\Http\Controllers\CompanyController::class, 'create'])->name('admin.company.add');

        Route::get('/companies',  [App\Http\Controllers\CompanyController::class, 'index'])->name('admin.company.index');

        Route::post('/companies/store',  [App\Http\Controllers\CompanyController::class, 'store'])->name('admin.company.store');

        Route::get('/companies/{id}/show',  [App\Http\Controllers\CompanyController::class, 'show'])->name('admin.company.show');

        Route::post('/preview/confirm/results/{company}',  [App\Http\Controllers\DataControlController::class, 'confirmResults'])->name('admin.preview.result.confirm');


        //source

        Route::get('/source/create', [App\Http\Controllers\DataSourceController::class, 'create'])->name('admin.source.create');
        Route::get('/source/index', [App\Http\Controllers\DataSourceController::class, 'index'])->name('admin.source.index');
        Route::post('/source/store', [App\Http\Controllers\DataSourceController::class, 'store'])->name('admin.source.store');


        //stacks
        Route::get('/stack/index', [App\Http\Controllers\GeneralStackController::class, 'index'])->name('admin.stack.index');

        //backend
        Route::prefix('/stack/backend')->group(function () {
            Route::get('/stack/backend/create', [App\Http\Controllers\BackendController::class, 'create'])->name('admin.stack.backend.create');
            Route::post('/stak/store', [App\Http\Controllers\BackendController::class, 'store'])->name('admin.stack.backend.store');
        });

        //frontend
        Route::prefix('/stack/frontend')->group(function () {

            Route::get('/create', [App\Http\Controllers\FrontendController::class, 'create'])->name('admin.stack.frontend.create');
            Route::post('/store', [App\Http\Controllers\FrontendController::class, 'store'])->name('admin.stack.frontend.store');
        });
    });
});


Route::get('/not-an-admin', function () {
    return View('nonAdmin.home');
})->name('non.admin.user');
