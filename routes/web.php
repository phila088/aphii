<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\Admin\BrandController as AdminBrandController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardsController;
use App\Http\Controllers\DocumentCategoriesController;
use Livewire\Volt\Volt;

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

Route::prefix('dashboards')
    ->middleware(['auth', 'verified'])
    ->name('dashboards.')
    ->group(function () {
        Route::get('personal', [DashboardsController::class, 'personal'])->name('personal');

        Route::get('ap', [DashboardsController::class, 'ap'])->name('ap');

        Route::get('ar', [DashboardsController::class, 'ar'])->name('ar');

        Route::get('quoting', [DashboardsController::class, 'quoting'])->name('quoting');

        Route::get('sales', [DashboardsController::class, 'sales'])->name('sales');

        Route::get('work-orders', [DashboardsController::class, 'workOrders'])->name('work-orders');
    });

Route::prefix('brands')
    ->middleware(['auth', 'verified'])
    ->name('brands.')
    ->group(function () {
        Route::get('/', [BrandController::class, 'index'])->name('index');
    });

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::prefix('admin')
    ->middleware(['auth', 'verified'])
    ->name('admin.')
    ->group(function () {
        // Route::get('/', [AdminDashboardController::class, 'index'])->name('index');

        Route::prefix('brands')
            ->name('brands.')
            ->group(function () {
                Route::get('/', [AdminBrandController::class, 'index'])->name('index');

                Route::get('view/{id}', [AdminBrandController::class, 'view'])->name('view');

                Route::get('/create', [AdminBrandController::class, 'create'])->name('create');

                Route::get('/edit/{id}', [AdminBrandController::class, 'edit'])->name('edit');

                Route::get('/delete/{id}', [AdminBrandController::class, 'delete'])->name('delete');

                Route::get('/destroy/{id}', [AdminBrandController::class, 'destroy'])->name('destroy');
            });

        Route::prefix('certifications')
            ->name('certifications.')
            ->group(function () {
                // Route::get('/', [AdminCertificationController::class])->name('index');

                // Route::get('view/{id}', [AdminCertificationController::class, 'view'])->name('view');

                // Route::get('create', [AdminCertificationController::class, 'create'])->name('create');

                // Route::get('edit/{id}', [AdminCertificationController::class, 'edit'])->name('edit');

                // Route::get('delete/{id}', [AdminCertificationController::class, 'delete'])->name('delete');

                // Route::get('destroy/{id}', [AdminCertificationController::class, 'destroy'])->name('destroy');
            });

        Route::prefix('cities')
            ->name('cities.')
            ->group(function () {});

        Route::prefix('clients')
            ->name('clients.')
            ->group(function () {
                Route::prefix('portals')
                    ->name('portals.')
                    ->group(function () {});

                Route::prefix('rates')
                    ->name('rates.')
                    ->group(function () {});
            });

        Route::prefix('contacts')
            ->name('contacts.')
            ->group(function () {
                Route::prefix('departments')
                    ->name('departments.')
                    ->group(function () {
                        // Route::get('/', [AdminContactDepartmentController::class, 'index'])->name('index');

                        // Route::get('view/{id}', [AdminContactDepartmentController::class, 'view'])->name('view');

                        // Route::get('create', [AdminContactDepartmentController::class, 'create'])->name('create');

                        // Route::get('edit/{id}', [AdminContactDepartmentController::class, 'edit'])->name('edit');

                        // Route::get('delete/{id}', [AdminContactDepartmentController::class, 'delete'])->name('delete');

                        // Route::get('destroy/{id}', [AdminContactDepartmentController::class, 'destroy'])->name('destroy');
                    });

                Route::prefix('positions')
                    ->name('positions.')
                    ->group(function () {
                        // Route::get('/', [AdminContactPositionController::class, 'index'])->name('index');

                        // Route::get('view/{id}', [AdminContactPositionController::class, 'view'])->name('view');

                        // Route::get('create', [AdminContactPositionController::class, 'create'])->name('create');

                        // Route::get('edit/{id}', [AdminContactPositionController::class, 'edit'])->name('edit');

                        // Route::get('delete/{id}', [AdminContactPositionController::class, 'delete'])->name('delete');

                        // Route::get('destroy/{id}', [AdminContactPositionController::class, 'destroy'])->name('destroy');
                    });
            });

        Route::prefix('counties')
            ->name('counties.')
            ->group(function () {
                // Route::get('/', [AdminCountyController::class, 'index'])->name('index');

                // Route::get('view/{id}', [AdminCountyController::class, 'view'])->name('view');

                // Route::get('create', [AdminCountyController::class, 'create'])->name('create');

                // Route::get('edit/{id}', [AdminCountyController::class, 'edit'])->name('edit');

                // Route::get('delete/{id}', [AdminCountyController::class, 'delete'])->name('delete');

                // Route::get('destroy/{id}', [AdminCountyController::class, 'destroy'])->name('destroy');
            });

        Route::prefix('documents')
            ->name('documents.')
            ->group(function () {
                Route::get('categories', [DocumentCategoriesController::class, 'index'])->name('categories');

                // Route::get('/', [AdminContactController::class, 'index'])->name('index');

                // Route::get('view/{id}', [AdminContactCountyController::class, 'view'])->name('view');

                // Route::get('create', [AdminContactCountyController::class, 'create'])->name('create');

                // Route::get('edit/{id}', [AdminContactCountyController::class, 'edit'])->name('edit');

                // Route::get('delete/{id}', [AdminContactCountyController::class, 'delete'])->name('delete');

                // Route::get('destroy/{id}', [AdminContactCountyController::class, 'destroy'])->name('destroy');
            });
    });

Route::prefix('employee')
    ->middleware(['auth', 'verified'])
    ->name('employee.')
    ->group(function () {
        Route::prefix('clients')
            ->name('clients.')
            ->controller(ClientController::class)
            ->group(function () {
                Route::get('/', 'index')->name('index');

                Route::get('create', 'create')->name('create');

                Route::get('view/{id}', 'view')->name('view');

                Route::get('edit/{id}', 'edit')->name('edit');
            });
    });

require __DIR__ . '/auth.php';
