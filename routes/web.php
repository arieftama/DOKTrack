<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\TaskLogController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\MessageController;
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
    return redirect()->route('login');
})->name('index');


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::middleware(['auth'])->group(function () {
    // Absensi
    Route::get('/attendance', [AttendanceController::class, 'showForm'])->name('attendance.form');
    Route::post('/attendance/check-in', [AttendanceController::class, 'checkIn'])->name('attendance.checkIn');
    Route::post('/attendance/check-out', [AttendanceController::class, 'checkOut'])->name('attendance.checkOut');

    // Log Tugas
    Route::get('/tasklog', [TaskLogController::class, 'index'])->name('tasklog.index');
    Route::get('/tasklog/create', [TaskLogController::class, 'showForm'])->name('tasklog.create');
    Route::post('/tasklog/store', [TaskLogController::class, 'store'])->name('tasklog.store');
    Route::post('/tasklog/store-with-message', [TaskLogController::class, 'storeWithMessage'])->name('tasklog.storeWithMessage');
});

// Member
Route::get('/messages', [MessageController::class, 'index'])->name('messages.index'); // List pesan
Route::get('/messages/create', [MessageController::class, 'create'])->name('messages.create'); // Form kirim pesan
Route::post('/messages/store', [MessageController::class, 'store'])->name('messages.store'); // Simpan pesan

// Admin
Route::get('/admin/messages', [MessageController::class, 'adminIndex'])->name('admin.messages.index'); // List pesan untuk admin
Route::post('/admin/messages/respond/{id}', [MessageController::class, 'respond'])->name('admin.messages.respond'); // Tanggapan admin
Route::post('/admin/messages/delete/{id}', [MessageController::class, 'delete'])->name('admin.messages.delete'); // Hapus pesan