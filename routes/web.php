<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\OrderController;

/**
 * Redirect '/' langsung ke halaman pelanggan
 */
Route::redirect('/', '/pelanggan');

/**
 * Group untuk Admin Only
 */
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('pelanggan', PelangganController::class);
    Route::resource('orders', OrderController::class);
    Route::post('/orders/{order}/upload-foto-after', [OrderController::class, 'uploadFotoAfter'])->name('orders.uploadFotoAfter');
    Route::resource('pegawai', PegawaiController::class);
});

/**
 * Group untuk Semua Authenticated Users (admin dan pelanggan)
 */
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/**
 * Load auth routes Breeze
 */
require __DIR__.'/auth.php';
    