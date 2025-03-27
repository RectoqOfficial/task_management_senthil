<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\EmployeeController;



Route::get('/', function () {
    return view('welcome');
});




// Admin Login Routes
Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login.form');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

// Admin Dashboard (Protected Route)

    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');



// middleware is pending

    Route::get('/admin/roles', [RoleController::class, 'index'])->name('admin.roles.index');
    Route::get('/admin/roles/create', [RoleController::class, 'create'])->name('admin.roles.create');
    Route::post('/admin/roles', [RoleController::class, 'store'])->name('admin.roles.store');
    Route::delete('/admin/roles/{id}', [RoleController::class, 'destroy'])->name('admin.roles.destroy');




    
    Route::get('/employees', [EmployeeController::class, 'index'])->name('admin.employee.index');
    Route::get('/employees/create', [EmployeeController::class, 'create'])->name('admin.employee.create');
    Route::post('/employees/store', [EmployeeController::class, 'store'])->name('admin.employee.store');
     