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
    Route::get('/user/patient-registration', [UserController::class, 'showPatientForm'])->name('user.patient.form');

    Route::get('/doctors', [UserController::class, 'listDoctors'])->name('user.listDoctors');
    Route::get('/doctors/{doctorId}/schedule', [UserController::class, 'viewDoctorSchedule'])->name('user.viewDoctorSchedule');
});

// Route Admin
Route::middleware(['auth', 'admin'])->group(function() {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/patients', [AdminController::class, 'viewPatients'])->name('admin.view.patients');

    Route::get('/admin/schedules/create', [AdminController::class, 'showAddScheduleForm'])->name('admin.addScheduleForm');
    Route::post('/admin/schedules', [AdminController::class, 'addSchedule'])->name('admin.addSchedule');
    Route::get('/admin/schedules', [AdminController::class, 'viewSchedules'])->name('admin.viewSchedules');
    Route::get('/admin/schedules/{schedule}/edit', [AdminController::class, 'editSchedule'])->name('admin.editSchedule');
    Route::put('/admin/schedules/{schedule}', [AdminController::class, 'updateSchedule'])->name('admin.updateSchedule');
    Route::delete('/admin/schedules/{schedule}', [AdminController::class, 'deleteSchedule'])->name('admin.deleteSchedule');
 


});

