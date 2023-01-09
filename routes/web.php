<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes(
    [
        'register' => false,
        'reset' => false,
        'verify' => false,
    ]
);

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');




// Admin Routes
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    // Route::get('dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('employees', App\Http\Controllers\Admin\EmployeeController::class);
    Route::get('employee/delete/{id}', [App\Http\Controllers\Admin\EmployeeController::class, 'destroy'])->name('employee.delete');
    Route::resource('departments', App\Http\Controllers\Admin\DepartmentController::class);
    Route::resource('designations', App\Http\Controllers\Admin\DesignationController::class);
    Route::get('export-employee', [App\Http\Controllers\Admin\EmployeeController::class, 'ExportEmployee'])->name('export-employee');
    Route::post('import-employee', [App\Http\Controllers\Admin\EmployeeController::class, 'ImportEmployee'])->name('import-employee');
});

// Employee Routes
Route::group(['prefix' => 'employee', 'middleware' => ['auth', 'employee']], function () {
    Route::get('dashboard', [App\Http\Controllers\Employee\DashboardController::class, 'index'])->name('employee.dashboard');
    Route::get('profile', [App\Http\Controllers\Employee\DashboardController::class, 'profile'])->name('employee.profile');
    Route::get('edit-profile/{id}', [App\Http\Controllers\Employee\DashboardController::class, 'editProfile'])->name('employee.edit-profile');
    Route::put('update-profile/{id}', [App\Http\Controllers\Employee\DashboardController::class, 'updateProfile'])->name('employee.update-profile');
});


//Lost routes
Route::get('/lost', function () {
    return view('lost');
})->name('lost');
