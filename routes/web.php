<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardsController;
use App\Http\Controllers\DocumentCategoriesController;

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

Route::get('/', [DashboardsController::class, 'dashboard']);

Route::prefix('dashboards')
    ->middleware(['auth', 'verified'])
    ->name('dashboards.')
    ->controller(DashboardsController::class)
    ->group(function () {
        Route::get('personal', 'personal')->name('personal');
    });

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::prefix('admin')
    ->middleware(['auth', 'verified'])
    ->name('admin.')
    ->group(function () {
        Route::prefix('documents')
            ->name('documents.')
            ->group(function () {
                Route::get('categories', [DocumentCategoriesController::class, 'index'])->name('categories');
            });
    });

require __DIR__.'/auth.php';
