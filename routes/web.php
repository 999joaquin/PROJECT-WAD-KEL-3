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
    Route::get('/user/patient-registration', [UserController::class, 'showRegistrationForm'])->name('user.register.form');
    Route::post('/user/register', [UserController::class, 'storeRegistration'])->name('user.register.store');
});

// Route Admin
Route::middleware(['auth', 'admin'])->group(function() {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/view-patients', [AdminController::class, 'viewPatients'])->name('admin.viewDoctors');
    Route::get('/admin/add-doctor', [AdminController::class, 'showAddDoctorForm'])->name('admin.showAddDoctorForm');
    Route::post('/admin/add-doctor', [AdminController::class, 'addDoctor'])->name('admin.addDoctor');
    Route::get('/admin/view-doctors', [AdminController::class, 'viewDoctors'])->name('admin.viewDoctors');
    Route::get('/admin/doctors/{id}/edit', [AdminController::class, 'editDoctor'])->name('admin.editDoctor');
    Route::put('/admin/doctors/{id}', [AdminController::class, 'updateDoctor'])->name('admin.updateDoctor');
    Route::delete('/admin/doctors/{id}', [AdminController::class, 'deleteDoctor'])->name('admin.deleteDoctor');
    Route::get('/admin/patients', [AdminController::class, 'viewPatients'])->name('admin.patients.dashboard');
    Route::get('/admin/patients/{patient}/edit', [AdminController::class, 'editPatients'])->name('admin.patients.edit');
    Route::put('/admin/patients/{patient}', [AdminController::class, 'updatePatients'])->name('admin.patients.update');
    Route::delete('/admin/patients/{patient}', [AdminController::class, 'destroyPatients'])->name('admin.patients.destroy');
});




