<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AttendanceController,
    TaskLogController,
    LoginController,
    DashboardController,
    RegisterController,
    MessageController
};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and assigned to the "web" 
| middleware group. Make something great!
|
*/

// Redirect ke login sebagai halaman utama
Route::get('/', fn() => redirect()->route('login'))->name('index');

// Halaman Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Login dan Registrasi
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Middleware untuk rute yang memerlukan autentikasi
Route::middleware(['auth'])->group(function () {

    // Absensi
    Route::prefix('attendance')->group(function () {
        Route::get('/', [AttendanceController::class, 'showForm'])->name('attendance.form');
        Route::post('/check-in', [AttendanceController::class, 'checkIn'])->name('attendance.checkIn');
        Route::post('/check-out', [AttendanceController::class, 'checkOut'])->name('attendance.checkOut');
    });

    // Log Tugas
    Route::prefix('tasklog')->group(function () {
        Route::get('/', [TaskLogController::class, 'index'])->name('tasklog.index');
        Route::get('/create', [TaskLogController::class, 'showForm'])->name('tasklog.create');
        Route::post('/store', [TaskLogController::class, 'store'])->name('tasklog.store');
        Route::post('/store-with-message', [TaskLogController::class, 'storeWithMessage'])->name('tasklog.storeWithMessage');
    });

    // Pesan (Message)
    Route::prefix('messages')->group(function () {
        Route::get('/', [MessageController::class, 'index'])->name('messages.index'); // List pesan
        Route::get('/create', [MessageController::class, 'create'])->name('messages.create'); // Form kirim pesan
        Route::post('/store', [MessageController::class, 'store'])->name('messages.store'); // Simpan pesan
        Route::get('/{id}', [MessageController::class, 'show'])->name('messages.show'); // Tampilkan pesan
    });

    // Admin Routes (hanya untuk admin)
    Route::middleware(['admin'])->prefix('admin/messages')->group(function () {
        Route::get('/', [MessageController::class, 'adminIndex'])->name('admin.messages.index'); // List pesan untuk admin
        Route::get('/reply/{id}', [MessageController::class, 'showReplyForm'])->name('admin.messages.reply_form'); // Form balasan admin
        Route::post('/reply/{id}', [MessageController::class, 'reply'])->name('admin.messages.reply'); // Tanggapan admin
        Route::post('/delete/{id}', [MessageController::class, 'delete'])->name('admin.messages.delete'); // Hapus pesan
    });
});
