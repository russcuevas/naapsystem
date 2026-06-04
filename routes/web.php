<?php

use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\superadmin\SuperAdminDashboardController;
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

Route::get('login', [LoginController::class, 'LoginPage'])->name('auth.login.page');

// Superadmin Route
Route::get('superadmin/dashboard', [SuperAdminDashboardController::class, 'SuperAdminDashboardPage'])->name('superadmin.dashboard.page');


Route::get('/', function () {
    return view('welcome');
});
