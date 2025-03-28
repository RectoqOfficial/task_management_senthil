<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ScoreController;
use App\Http\Controllers\EmployeeAuthController;




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



// Admin Create Employee Details
    
    Route::get('/employees', [EmployeeController::class, 'index'])->name('admin.employee.index');
    Route::get('/employees/create', [EmployeeController::class, 'create'])->name('admin.employee.create');
    Route::post('/employees/store', [EmployeeController::class, 'store'])->name('admin.employee.store');
    Route::get('/admin/employees/{id}', [EmployeeController::class, 'show'])->name('admin.employee.show');
    
     


// Admin Create Task Details

        Route::get('admin/tasks', [TaskController::class, 'index'])->name('admin.tasks.index');
        Route::get('admin/tasks/create', [TaskController::class, 'create'])->name('admin.tasks.create');
        Route::post('admin/tasks/store', [TaskController::class, 'store'])->name('admin.tasks.store');


 
        Route::get('/score', function () {
            return view('score.index');
        })->name('score.index');

        Route::get('/score/create', function () {
            return view('admin.score.create');
        })->name('admin.score.create');



            Route::get('/score', [ScoreController::class, 'index'])->name('admin.score.index');
            Route::get('/tasks/create', [ScoreController::class, 'create'])->name('tasks.create');
            Route::post('/tasks', [ScoreController::class, 'store'])->name('tasks.store');

        


        // employee


//Employee Login page

Route::get('/employee/login', [EmployeeAuthController::class, 'showLoginForm'])->name('employee.login');
Route::post('/employee/login', [EmployeeAuthController::class, 'login'])->name('employee.login.submit');
Route::post('/employee/logout', [EmployeeAuthController::class, 'logout'])->name('employee.logout');

//Employee Dashboard Page

    Route::get('/employee/dashboard', [EmployeeAuthController::class, 'dashboard'])->name('employee.dashboard');

