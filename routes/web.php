<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\SuratPemberitahuanController;
use App\Http\Controllers\RencanaJadwalController;
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

Route::middleware(['auth'])->prefix('users')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('users.index');
    Route::get('/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/', [UserController::class, 'store'])->name('users.store');
    Route::get('/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/{user}', [UserController::class, 'destroy'])->name('users.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::prefix('jadwal')->group(function () {
        Route::get('/', [RencanaJadwalController::class, 'index'])->name('jadwal.index');
        Route::get('/create', [RencanaJadwalController::class, 'create'])->name('jadwal.create');
        Route::post('/', [RencanaJadwalController::class, 'store'])->name('jadwal.store');
        Route::get('/{jadwal}/edit', [RencanaJadwalController::class, 'edit'])->name('jadwal.edit');
        Route::put('/{jadwal}', [RencanaJadwalController::class, 'update'])->name('jadwal.update');
        Route::delete('/{jadwal}', [RencanaJadwalController::class, 'destroy'])->name('jadwal.destroy');
    });
});

Route::middleware(['auth'])->group(function () {
    Route::get('/jadwal-saya', [SuratPemberitahuanController::class, 'jadwalSaya'])
        ->name('jadwal.saya');
});

Route::middleware(['auth'])->prefix('surat')->group(function () {
    Route::get('/', [SuratPemberitahuanController::class, 'index'])->name('surat.index');
    Route::get('/create/{jadwal}', [SuratPemberitahuanController::class, 'create'])->name('surat.create');
    Route::post('/', [SuratPemberitahuanController::class, 'store'])->name('surat.store');
    Route::get('/download/{surat}', [SuratPemberitahuanController::class, 'download'])->name('surat.download');
    Route::post('/{jadwal}/pdf', [SuratPemberitahuanController::class, 'generatePdf'])->name('surat.generatePdf');
    Route::get('/preview/{surat}', [SuratPemberitahuanController::class, 'preview'])->name('surat.preview');
    Route::get('/export-pdf', [SuratPemberitahuanController::class, 'exportPdf'])->name('surat.exportPdf');
});

Route::middleware(['auth'])->prefix('kepala/jadwal')->group(function () {
    Route::get('/', [RencanaJadwalController::class, 'tinjau'])->name('kepala.jadwal.index');
    Route::post('/{jadwal}/update-status', [RencanaJadwalController::class, 'updateStatus'])->name('kepala.jadwal.updateStatus');
});

Route::middleware(['auth', 'verified'])->group(function () {

    // CRUD Pendaftaran
    Route::get('/pendaftaran', [PendaftaranController::class, 'index'])->name('pendaftaran.index');
    Route::get('/pendaftaran/create', [PendaftaranController::class, 'create'])->name('pendaftaran.create');
    Route::post('/pendaftaran', [PendaftaranController::class, 'store'])->name('pendaftaran.store');

    // Update status per pemohon
    Route::post('/pemohon/{pemohon_id}/status', [PemohonController::class, 'updateStatus'])
        ->name('pemohon.updateStatus')
        ->middleware('auth');

    // Validasi seluruh pendaftaran
    Route::post('/pendaftaran/{pendaftaran_id}/validasi', [PemohonController::class, 'validasiSemua'])
        ->name('pendaftaran.validasi')
        ->middleware('auth');

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

require __DIR__ . '/auth.php';
