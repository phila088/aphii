<?php

use App\Http\Controllers\Admin\StatusCodeController as AdminStatusCodeController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Employee\BrandController as EmployeeBrandController;
use App\Http\Controllers\Employee\CallController as EmployeeCallController;
use App\Http\Controllers\Employee\ClientController as EmployeeClientController;
use App\Http\Controllers\Employee\DashboardsController;
use App\Http\Controllers\Employee\DocumentCategoriesController;
use App\Http\Controllers\Employee\PotentialClientController as EmployeePotentialClientController;
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

Route::get('/', function () {
    if (!auth()->check()) {
        return redirect('/login');
    } else {
        return redirect('/dashboards/personal');
    }
});

Route::get('lockscreen', [DashboardsController::class, 'personal'])
    ->middleware('lockscreen.show')
    ->name('lockscreen');

Route::middleware(['auth', 'verified', 'online-status'])
    ->group(function () {
        Route::prefix('dashboards')
            ->name('dashboards.')
            ->group(function () {
                Route::get('personal', [DashboardsController::class, 'personal'])->name('personal');

                Route::get('ap', [DashboardsController::class, 'ap'])->name('ap');

                Route::get('ar', [DashboardsController::class, 'ar'])->name('ar');

                Route::get('quoting', [DashboardsController::class, 'quoting'])->name('quoting');

                Route::get('sales', [DashboardsController::class, 'sales'])->name('sales');

                Route::get('work-orders', [DashboardsController::class, 'workOrders'])->name('work-orders');
            });

        Route::view('profile', 'profile')
            ->name('profile');

        Route::prefix('admin')
            ->name('admin.')
            ->group(function () {
                Route::prefix('status-codes')
                    ->name('status-codes.')
                    ->controller(AdminStatusCodeController::class)
                    ->group(function () {
                        Route::get('/', 'index')->name('index');
                    });

                Route::prefix('users')
                    ->name('users.')
                    ->controller(AdminUserController::class)
                    ->group(function () {
                        Route::get('/', 'index')->name('index');
                    });
            });

        Route::prefix('employee')
            ->name('employee.')
            ->group(function () {
                Route::prefix('brands')
                    ->name('brands.')
                    ->controller(EmployeeBrandController::class)
                    ->group(function () {
                        Route::get('/', 'index')->name('index');

                        Route::get('create', 'create')->name('create');

                        Route::get('view/{id}', 'view')->name('view');

                        Route::get('edit/{id}', 'edit')->name('edit');
                    });

                Route::prefix('calls')
                    ->name('calls.')
                    ->controller(EmployeeCallController::class)
                    ->group(function () {
                        Route::get('/', 'index')->name('index');
                    });

                Route::prefix('clients')
                    ->name('clients.')
                    ->controller(EmployeeClientController::class)
                    ->group(function () {
                        Route::get('/', 'index')->name('index');

                        Route::get('create', 'create')->name('create');

                        Route::get('view/{id}', 'view')->name('view');

                        Route::get('edit/{id}', 'edit')->name('edit');
                    });

                Route::prefix('potential-clients')
                    ->name('potential-clients.')
                    ->controller(EmployeePotentialClientController::class)
                    ->group(function () {
                        Route::get('/', 'index')->name('index');

                        Route::get('create', 'create')->name('create');

                        Route::get('view/{id}', 'view')->name('view');
                    });
            });
    });

require __DIR__ . '/auth.php';
