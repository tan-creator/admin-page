<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\CertificationsController;
use App\Http\Controllers\ProjectsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::controller(\App\Http\Controllers\Auth\AuthController::class)->group(function () {
    Route::get('/', 'index')->name('login');
    Route::post('/', 'login');
    Route::get('/logout', 'logout')->name('logout');
});

Route::middleware('auth')->group(function () {
    Route::controller(HomeController::class)->group(function () {
        Route::prefix('/dashboard')->group(function () {
            Route::get('/', 'index')->name('dashboard');
            Route::post('/import', 'import')->name('dashboard.import');
        });
    });

    Route::controller(UserController::class)->group(function () {
        Route::prefix('/users')->group(function () {
            Route::get('/export', 'export')->name('users.export');
            Route::get('/import', 'import')->name('users.import');
            Route::post('/import', 'upload')->name('users.upload');
            Route::post('/template', 'template')->name('users.template');
            Route::get('/', 'index')->name('users.index');
            Route::get('/create', 'create')->name('users.create');
            Route::post('/create', 'store')->name('users.store');
            Route::get('/{user}', 'show')->name('users.show');
            Route::get('/{user}/edit', 'edit')->name('users.edit');
            Route::put('/{user}', 'update')->name('users.update');
            Route::delete('/deletes', 'multipleDestroy')->name('users.deletes');
            Route::delete('/{user}', 'destroy')->name('users.destroy');
            Route::post('/changePassword', 'changePassword')->name('users.changePassword');
        });
    });
 
    Route::controller(\App\Http\Controllers\DepartmentsController::class)->group(function () {
        Route::prefix('/departments')->group(function () {
            Route::get('/', 'index')->name('departments.index');
            Route::get('/create', 'create')->name('departments.create');
            Route::post('/create', 'store');
            Route::get('/{department}', 'show')->name('departments.show');
            Route::get('/{department}/edit', 'edit')->name('departments.update');
            Route::patch('/{department}/edit', 'update');
            Route::delete('/{department}', 'destroy')->name('departments.destroy');
            Route::get('/{department}/addUser', 'loadAddUserForm')->name('departments.add-user');
            Route::post('/{department}/addUser', 'addUserForDepartment');
        });
    });

    Route::controller(CertificationsController::class)->group(function () {
        Route::prefix('certifications')->group(function () {
            Route::delete('/', 'destroy')->name('certifications.destroy');
            Route::post('/', 'store');
            Route::get('/create', 'create')->name('certifications.create');
            Route::get('/', 'index')->name('certifications.index');
            Route::get('/{certification}', 'show')->name('certifications.show');
            Route::patch('/{certification}', 'update');
            Route::get('{certification}/edit',  'edit')->name('certifications.edit');

            Route::get('/addUser/{user}', 'loadUserFormAdd')->name('certifications.addUser');
            Route::post('/addUser/{user} ', 'addCertificationForUser');
        });
    });
    
    Route::controller(ProjectsController::class)->group(function () {
        Route::prefix('projects')->group(function () {
            Route::delete('/', 'destroy')->name('projects.destroy');
            Route::get('/create', 'create')->name('projects.create');
            Route::post('/', 'store');

            Route::get('/', 'index')->name('projects.index');
            Route::get('/{project}', 'show')->name('projects.show');
            Route::patch('/{project}', 'update');
            Route::get('/{project}/edit', 'edit')->name('projects.edit');
            Route::get('/{project}/addUser', 'loadAddUserForm')->name('project.add-user');
            Route::post('/{project}/addUser', 'addUserToProject');
        });
    });

    Route::get('/setLang/{locale}',[\App\Http\Controllers\LocalizationController::class, 'setLang'])->name('setLang');
});

