<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\PendapatanController;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Route;

Route::get('/', [PublicController::class, 'landing'])->name('landing');


Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login']);
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

Route::middleware('admin')->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::resource('/admin/layanan', LayananController::class);
    Route::get('/admin/pengajuan', [PengajuanController::class, 'index'])->name('pengajuan.index');
    Route::get('/admin/pengajuan/create', [PengajuanController::class, 'create'])->name('pengajuan.create');
    Route::post('/admin/pengajuan', [PengajuanController::class, 'store'])->name('pengajuan.store');
    Route::get('/admin/pengajuan/{pengajuan}/edit', [PengajuanController::class, 'edit'])->name('pengajuan.edit');
    Route::put('/admin/pengajuan/{pengajuan}/status', [PengajuanController::class, 'updateStatus'])->name('pengajuan.updateStatus');
    Route::put('/admin/pengajuan/{pengajuan}', [PengajuanController::class, 'update'])->name('pengajuan.update');
    Route::delete('/admin/pengajuan/{pengajuan}', [PengajuanController::class, 'destroy'])->name('pengajuan.destroy');
    Route::get('/export-pdf', [PDFController::class, 'exportPDF'])->name('export.pdf');
    Route::get('/export-pengajuans', [PengajuanController::class, 'export'])->name('export-pengajuan');
    Route::get('/pengajuan/{pengajuan}/dokumen', [PengajuanController::class, 'getDokumen']);
    Route::get('/pengajuan/status/{status}', [PengajuanController::class, 'getByStatus'])->name('pengajuan.by-status');
    Route::put('/pengajuan/{pengajuan}/status-bayar', [PengajuanController::class, 'updateStatusBayar'])->name('pengajuan.updateStatusBayar');
    Route::get('/pendapatan', [PendapatanController::class, 'index'])->name('pendapatan.index');
});