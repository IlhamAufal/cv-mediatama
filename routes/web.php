<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KontenController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// ─── Authentication (Guest Only) ──────────────────────────────────────────────
Route::get('/signin', [AuthController::class, 'showLogin'])->name('signin')->middleware('guest');
Route::post('/signin', [AuthController::class, 'login'])->name('signin.post')->middleware('guest');

// ─── Logout ───────────────────────────────────────────────────────────────────
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// ═══════════════════════════════════════════════════════════════════════════════
// ─── Protected Routes (Auth Required — Semua role) ─────────────────────────────
// ═══════════════════════════════════════════════════════════════════════════════
Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        if (Auth::check() && Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('customer.dashboard');
    });

    Route::get('/user/monitoring', [UserController::class, 'index'])->name('users.index');

    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/customer/dashboard', [DashboardController::class, 'index'])->name('customer.dashboard');

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::resource('/users', UserController::class)->names(['users']);

    // ─── Customer: Pengajuan Akses Konten ────────────────────────────────────
    Route::middleware('role:customer')->prefix('customer')->name('customer.')->group(function () {
        Route::get('/konten', [KontenController::class, 'index'])->name('konten.index');
        Route::get('/konten/riwayat-pengajuan', [PengajuanController::class, 'riwayatPengajuan'])->name('pengajuan.riwayat');
        Route::get('/konten/{konten}', [KontenController::class, 'show'])->name('konten.show');
        Route::post('/konten/{konten}/pengajuan', [PengajuanController::class, 'store'])->name('pengajuan.store');
    });

    // ─── Admin Routes ────────────────────────────────────────────────────────
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/pengajuan', [PengajuanController::class, 'index'])->name('pengajuan.index');
        Route::put('/pengajuan/{pengajuan}/approve', [PengajuanController::class, 'approve'])->name('pengajuan.approve');
        Route::put('/pengajuan/{pengajuan}/reject', [PengajuanController::class, 'reject'])->name('pengajuan.reject');
        
        Route::get('/konten', [KontenController::class, 'index'])->name('konten.index');
        Route::get('/konten/create', [KontenController::class, 'create'])->name('konten.create');
        Route::post('/konten', [KontenController::class, 'store'])->name('konten.store');
        Route::get('/konten/{konten}', [KontenController::class, 'show'])->name('konten.show');
        Route::get('/konten/{konten}/edit', [KontenController::class, 'edit'])->name('konten.edit');
        Route::put('/konten/{konten}', [KontenController::class, 'update'])->name('konten.update');
        Route::delete('/konten/{konten}', [KontenController::class, 'destroy'])->name('konten.destroy');

    });

    Route::get('/blank', fn () => view('pages.blank', ['title' => 'Blank']))->name('blank');
    Route::get('/error-404', fn () => view('pages.errors.error-404', ['title' => 'Error 404']))->name('error-404');
});
