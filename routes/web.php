<?php

use App\Http\Controllers\AdminController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Auth/Login');
});

Route::controller(AdminController::class)->group(function(){
    Route::get('/ptms/admin/dashboard', 'AdminDashboard')->name('admin.dash');
});


require __DIR__.'/auth.php';
