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

    // NILUH
    Route::get('/user/appointment', [UserController::class, 'showAppointmentForm'])->name('user.showAppointmentForm');
    Route::get('/user/show-appointment-form', [UserController::class, 'showAppointmentForm'])->name('user.showAppointmentForm');
    Route::post('/user/create-appointment', [UserController::class, 'createAppointment'])->name('user.createAppointment');

    // JOA
    Route::get('/user/register', [UserController::class, 'showRegistrationForm'])->name('user.register.form');
    Route::post('/user/register', [UserController::class, 'storeRegistration'])->name('user.register.store');

    // ARIO
    Route::get('/doctors', [UserController::class, 'listDoctors'])->name('user.listDoctors');
    Route::get('/doctors/{doctorId}/schedule', [UserController::class, 'viewDoctorSchedule'])->name('user.viewDoctorSchedule');

    // APIP
    Route::get('/user/article', [UserController::class, 'articleIndexUser'])->name('user.articleIndexUser');
    Route::get('/user/article/detail/{id}', [UserController::class,'articleDetailUser'])->name('user.articleDetailUser');
});

// Route Admin
Route::middleware(['auth', 'admin'])->group(function() {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // ILMA
    Route::get('/admin/view-patients', [AdminController::class, 'viewPatients'])->name('admin.viewDoctors');
    Route::get('/admin/add-doctor', [AdminController::class, 'showAddDoctorForm'])->name('admin.showAddDoctorForm');
    Route::post('/admin/add-doctor', [AdminController::class, 'addDoctor'])->name('admin.addDoctor');
    Route::get('/admin/view-doctors', [AdminController::class, 'viewDoctors'])->name('admin.viewDoctors');
    Route::get('/admin/doctors/{id}/edit', [AdminController::class, 'editDoctor'])->name('admin.editDoctor');
    Route::put('/admin/doctors/{id}', [AdminController::class, 'updateDoctor'])->name('admin.updateDoctor');
    Route::delete('/admin/doctors/{id}', [AdminController::class, 'deleteDoctor'])->name('admin.deleteDoctor');

    // NILUH
    Route::get('/admin/appointments', [AdminController::class, 'viewAppointments'])->name('admin.viewAppointments');
    Route::get('/admin/appointments/{id}/edit', [AdminController::class, 'editAppointment'])->name('admin.editAppointment');
    Route::put('/admin/appointments/{id}', [AdminController::class, 'updateAppointment'])->name('admin.updateAppointment');
    Route::delete('/admin/appointments/{id}', [AdminController::class, 'deleteAppointment'])->name('admin.deleteAppointment');

    // JOA
    Route::get('/admin/patients', [AdminController::class, 'viewPatients'])->name('admin.patients.dashboard');
    Route::get('/admin/patients/{patient}/edit', [AdminController::class, 'editPatients'])->name('admin.patients.edit');
    Route::put('/admin/patients/{patient}', [AdminController::class, 'updatePatients'])->name('admin.patients.update');
    Route::delete('/admin/patients/{patient}', [AdminController::class, 'destroyPatients'])->name('admin.patients.destroy');

    // NAJMA
    Route::get('/admin/patients/{patientId}/add-detail', [AdminController::class, 'showPatientsDetails'])->name('admin.details.create');
    Route::post('/admin/patients/{patientId}/add-detail', [AdminController::class, 'addPatientDetails'])->name('admin.details.store');
    Route::get('/admin/select-patient', [AdminController::class, 'selectPatient'])->name('admin.selectPatient');
    Route::get('/admin/patients/{patientId}/details', [AdminController::class, 'showPatientFullDetails'])->name('admin.patientDetails');

    // ARIO
    Route::delete('/admin/details/{detailId}', [AdminController::class, 'deleteDetail'])->name('admin.detail.delete');
    Route::get('/admin/schedules/create', [AdminController::class, 'showAddScheduleForm'])->name('admin.addScheduleForm');
    Route::post('/admin/schedules', [AdminController::class, 'addSchedule'])->name('admin.addSchedule');
    Route::get('/admin/schedules', [AdminController::class, 'viewSchedules'])->name('admin.viewSchedules');
    Route::get('/admin/schedules/{schedule}/edit', [AdminController::class, 'editSchedule'])->name('admin.editSchedule');
    Route::put('/admin/schedules/{schedule}', [AdminController::class, 'updateSchedule'])->name('admin.updateSchedule');
    Route::delete('/admin/schedules/{schedule}', [AdminController::class, 'deleteSchedule'])->name('admin.deleteSchedule');

    // RIZKY
    Route::post('/admin/add-medicine', [AdminController::class, 'addMedicine'])->name('admin.addMedicine');
    Route::get('/admin/detailMedicin/{id}', [AdminController::class, 'detailMedicine'])->name('admin.detailMedicine');    
    Route::get('/admin/view-medicine', [AdminController::class, 'showMedicine'])->name('admin.showMedicine');
    Route::get('/admin/add-medicines', [AdminController::class, 'addMedicines'])->name('admin.addMedicines');
    Route::delete('/admin/detailMedicin/{id}', [AdminController::class, 'deleteMedicine'])->name('admin.deleteMedicine');
    Route::put('/admin/editMedicine/{id}', [AdminController::class, 'updateMedicine'])->name('admin.updateMedicine');
    Route::get('/admin/edit-medicines/{id}', [AdminController::class, 'editMedicines'])->name('admin.editMedicines');

    // APIP
    Route::get('/admin/article', [AdminController::class, 'articleIndex'])->name('admin.articleIndex');
    Route::get('/admin/article/detail/{id}', [AdminController::class,'articleDetail'])->name('admin.articleDetail'); 
    Route::get('/admin/article/create', [AdminController::class, 'articleCreate'])->name('admin.articleCreate'); 
    Route::post('/admin/article/create', [AdminController::class, 'store'])->name('admin.store'); 
    Route::get('/admin/article/detail/{id}/edit', [AdminController::class, 'articleEdit'])->name('admin.articleEdit'); 
    Route::put('/admin/article/detail/{id}', [AdminController::class, 'articleUpdate'])->name('admin.articleUpdate'); 
    Route::delete('/admin/article/detail/{id}', [AdminController::class, 'articleDelete'])->name('admin.articleDelete'); 
});




