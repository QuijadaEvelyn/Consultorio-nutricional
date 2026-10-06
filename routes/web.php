<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\Admin\AppointmentController as AdminAppointment;
use App\Http\Controllers\Admin\PatientController;
use App\Http\Controllers\Admin\ClinicalRecordController;
use App\Http\Controllers\Admin\SiteContentController;
use App\Http\Controllers\Patient\PatientDashboardController;
use App\Http\Controllers\Patient\PatientAppointmentController;

// Pública
Route::get('/', [PublicController::class, 'index'])->name('public.index');

// Autenticación Nativa
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rutas de Nutriólogo (Admin)
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');
    
    // Horarios
    Route::get('/schedules', [ScheduleController::class, 'index'])->name('schedules.index');
    Route::post('/schedules', [ScheduleController::class, 'store'])->name('schedules.store');
    
    // Citas
    Route::get('/appointments', [AdminAppointment::class, 'index'])->name('appointments.index');
    Route::patch('/appointments/{appointment}', [AdminAppointment::class, 'updateStatus'])->name('appointments.updateStatus');
    
    // Pacientes
    Route::get('/patients', [PatientController::class, 'index'])->name('patients.index');
    Route::get('/patients/create', [PatientController::class, 'create'])->name('patients.create');
    Route::post('/patients', [PatientController::class, 'store'])->name('patients.store');
    Route::patch('/patients/{patient}/toggle', [PatientController::class, 'toggleActive'])->name('patients.toggleActive');
    
    // Expedientes Clínicos
    Route::get('/records', [ClinicalRecordController::class, 'index'])->name('records.index');
    Route::get('/records/create/{patient}', [ClinicalRecordController::class, 'create'])->name('records.create');
    Route::post('/records/{patient}', [ClinicalRecordController::class, 'store'])->name('records.store');

    // Publicidad y Contenido
    Route::get('/site-content', [SiteContentController::class, 'index'])->name('site.index');
    Route::put('/site-content/{siteContent}', [SiteContentController::class, 'update'])->name('site.update');
});

// Rutas de Paciente
Route::middleware(['auth', 'role:patient'])->prefix('patient')->name('patient.')->group(function () {
    Route::get('/dashboard', [PatientDashboardController::class, 'index'])->name('dashboard');
    Route::get('/appointments/create', [PatientAppointmentController::class, 'create'])->name('appointments.create');
    Route::post('/appointments', [PatientAppointmentController::class, 'store'])->name('appointments.store');
});