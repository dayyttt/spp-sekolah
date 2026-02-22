<?php

use Illuminate\Support\Facades\Route;

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
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    
    // Routes khusus admin
    Route::middleware(['admin'])->group(function () {
        Route::resource('siswa', App\Http\Controllers\SiswaController::class);
        Route::resource('kelas', App\Http\Controllers\KelasController::class);
        Route::resource('tahun-ajaran', App\Http\Controllers\TahunAjaranController::class);
        Route::post('tahun-ajaran/{id}/set-active', [App\Http\Controllers\TahunAjaranController::class, 'setActive'])->name('tahun-ajaran.set-active');
        Route::resource('rekening', App\Http\Controllers\RekeningSekolahController::class);
    });
    
    // Routes untuk admin dan petugas
    Route::resource('pembayaran', App\Http\Controllers\PembayaranController::class);
    Route::get('pembayaran/history/{siswa}', [App\Http\Controllers\PembayaranController::class, 'show'])->name('pembayaran.history');
    Route::get('pembayaran/{id}/print', [App\Http\Controllers\PembayaranController::class, 'print'])->name('pembayaran.print');
    Route::get('laporan', [App\Http\Controllers\LaporanController::class, 'index'])->name('laporan.index');
    Route::get('laporan/export', [App\Http\Controllers\LaporanController::class, 'export'])->name('laporan.export');
});

require __DIR__.'/auth.php';
/*  */