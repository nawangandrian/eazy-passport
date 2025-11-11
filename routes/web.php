<?php

use App\Http\Controllers\PemohonController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
})->name('home');  

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {

    // CRUD Pendaftaran
    Route::get('/pendaftaran', [PendaftaranController::class, 'index'])->name('pendaftaran.index');
    Route::get('/pendaftaran/create', [PendaftaranController::class, 'create'])->name('pendaftaran.create');
    Route::post('/pendaftaran', [PendaftaranController::class, 'store'])->name('pendaftaran.store');

    Route::post('pendaftaran/{pendaftaran}/validasi', [PendaftaranController::class, 'validasi'])
        ->name('pendaftaran.validasi');

    // CRUD Pemohon per pendaftaran
    Route::prefix('pendaftaran/{pendaftaran}/pemohon')->group(function () {
        Route::get('/', [PemohonController::class, 'index'])->name('pemohon.index');
        Route::get('/create', [PemohonController::class, 'create'])->name('pemohon.create');
        Route::post('/', [PemohonController::class, 'store'])->name('pemohon.store');

        Route::get('/{pemohon}/edit', [PemohonController::class, 'edit'])->name('pemohon.edit');
        Route::put('/{pemohon}', [PemohonController::class, 'update'])->name('pemohon.update');
        Route::delete('/{pemohon}', [PemohonController::class, 'destroy'])->name('pemohon.destroy');
    });
});

require __DIR__.'/auth.php';
