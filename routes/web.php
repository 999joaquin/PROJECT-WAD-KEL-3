<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;


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
    return view('welcome');
})->name('home');

// Route Login & Logout
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Route Register
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Route User
Route::middleware(['auth', 'user'])->group(function() {
    Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');

});

// Route Admin
Route::middleware(['auth', 'admin'])->group(function() {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/patients/{patientId}/add-detail', [AdminController::class, 'showPatientsDetails'])->name('admin.details.create');
    Route::post('/admin/patients/{patientId}/add-detail', [AdminController::class, 'addPatientDetails'])->name('admin.details.store');
    Route::get('/admin/select-patient', [AdminController::class, 'selectPatient'])->name('admin.selectPatient');
    Route::get('/admin/patients/{patientId}/details', [AdminController::class, 'showPatientFullDetails'])->name('admin.patientDetails');
    Route::delete('/admin/details/{detailId}', [AdminController::class, 'deleteDetail'])->name('admin.detail.delete');

});




