<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\OrderController;

/**
 * Redirect '/' langsung ke halaman pelanggan
 */
Route::redirect('/', '/pelanggan');

/**
 * 🔒 Pelanggan Only (status aktif)
 */
Route::middleware(['auth', 'role:pelanggan', 'pelanggan.aktif'])->group(function () {
    // ✅ Tampilkan profil milik sendiri, aman dari konflik
    Route::get('/my-profile', [PelangganController::class, 'myProfile'])->name('pelanggan.profile');
});

/**
 * 🛡️ Admin Only
 */
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('pelanggan', PelangganController::class);
    Route::resource('orders', OrderController::class);
    Route::post('/orders/{order}/upload-foto-after', [OrderController::class, 'uploadFotoAfter'])->name('orders.uploadFotoAfter');
    Route::resource('pegawai', PegawaiController::class);
    Route::patch('/pelanggan/{id}/clear-password', [PelangganController::class, 'clearPassword'])->name('pelanggan.clearPassword');
});

/**
 * Shared untuk Semua Authenticated User
 */
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/**
 * Manual Reset Session (debug)
 */
Route::get('/reset-session', function () {
    auth()->logout();
    session()->invalidate();
    session()->regenerateToken();
    
    return redirect('/login')->with('status', 'Session telah dibersihkan ✅');
});

/**
 * Breeze Auth Routes
 */
require __DIR__.'/auth.php';
