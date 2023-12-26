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
    Route::get('/user/appointment', [UserController::class, 'showAppointmentForm'])->name('user.showAppointmentForm');
    Route::get('/user/show-appointment-form', [UserController::class, 'showAppointmentForm'])->name('user.showAppointmentForm');
    Route::post('/user/create-appointment', [UserController::class, 'createAppointment'])->name('user.createAppointment');
});

// Route Admin
Route::middleware(['auth', 'admin'])->group(function() {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/add-doctor', [AdminController::class, 'showAddDoctorForm'])->name('admin.showAddDoctorForm');
    Route::post('/admin/add-doctor', [AdminController::class, 'addDoctor'])->name('admin.addDoctor');
    Route::get('/admin/view-doctors', [AdminController::class, 'viewDoctors'])->name('admin.viewDoctors');
    Route::get('/admin/appointments', [AdminController::class, 'viewAppointments'])->name('admin.viewAppointments');
    Route::get('/admin/appointments/{id}/edit', [AdminController::class, 'editAppointment'])->name('admin.editAppointment');
    Route::put('/admin/appointments/{id}', [AdminController::class, 'updateAppointment'])->name('admin.updateAppointment');
    Route::delete('/admin/appointments/{id}', [AdminController::class, 'deleteAppointment'])->name('admin.deleteAppointment');
});




