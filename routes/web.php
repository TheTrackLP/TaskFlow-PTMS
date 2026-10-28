<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\UsersController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Auth/Login');
});

Route::middleware('auth')->group(function() {
    Route::controller(AdminController::class)->group(function(){
        Route::get('/ptms/admin/dashboard', 'AdminDashboard')->name('admin.dash');
    });

    Route::controller(UsersController::class)->group(function(){
        Route::get('ptms/admin/users', 'UsersListDashboard')->name('users.list');
        Route::post('ptms/admin/users/store', 'UsersStoreData')->name('users.store');
        Route::post('ptms/admin/users/{id}/change-status', 'userChangeStatus')->name('users.status');
    });

    Route::controller(ProjectsController::class)->group(function(){
        Route::get('/ptms/admin/projects', 'ProjectsDashboard')->name('project.dash');
        Route::post('/ptms/admin/projects/store', 'ProjectsStore')->name('project.store');
    });
});


require __DIR__.'/auth.php';
