<?php

use App\Http\Controllers\Admin\BarangController;
use App\Http\Controllers\Admin\BarangUnitController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\PetugasController;
use App\Http\Controllers\Admin\RuanganController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Petugas\DashboardController as PetugasDashboard;
use App\Http\Controllers\Petugas\PinjamanController;
use Illuminate\Support\Facades\Route;

// ─── Publik (Beranda) ───────────────────────────────────────────────
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/pinjam', [HomeController::class, 'store'])->name('home.pinjam');
Route::get('/cek-status', [HomeController::class, 'cekStatus'])->name('cek-status');
Route::get('/api/siswa', [HomeController::class, 'cariSiswa'])->name('api.siswa');

// ─── Auth ──────────────────────────────────────────────────────────
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// ─── Admin ─────────────────────────────────────────────────────────
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');

    // Data Master Ruangan
    Route::resource('ruangan', RuanganController::class)->except(['show']);

    // Data Master Kategori
    Route::resource('kategori', KategoriController::class)->except(['show']);

    // Data Master Barang
    Route::resource('barang', BarangController::class);
    // Unit per barang
    Route::get('barang/{barang}/units', [BarangUnitController::class, 'index'])->name('barang.units');
    Route::post('barang/{barang}/units', [BarangUnitController::class, 'store'])->name('barang.units.store');
    Route::patch('barang/{barang}/units/{unit}', [BarangUnitController::class, 'update'])->name('barang.units.update');
    Route::delete('barang/{barang}/units/{unit}', [BarangUnitController::class, 'destroy'])->name('barang.units.destroy');

    // Data Siswa
    Route::resource('siswa', SiswaController::class)->except(['show']);

    // Petugas management
    Route::resource('petugas', PetugasController::class)->except(['show']);

    // Laporan
    Route::get('/laporan/kondisi-barang', [LaporanController::class, 'kondisiBarang'])->name('laporan.kondisi-barang');
    Route::get('/laporan/kondisi-barang/pdf', [LaporanController::class, 'kondisiBarangPdf'])->name('laporan.kondisi-barang.pdf');
    Route::get('/laporan/pinjaman', [LaporanController::class, 'pinjaman'])->name('laporan.pinjaman');
    Route::get('/laporan/pinjaman/pdf', [LaporanController::class, 'pinjamanPdf'])->name('laporan.pinjaman.pdf');
});

// ─── Petugas ───────────────────────────────────────────────────────
Route::prefix('petugas')->name('petugas.')->middleware(['auth', 'role:petugas,admin'])->group(function () {
    Route::get('/dashboard', [PetugasDashboard::class, 'index'])->name('dashboard');

    // Pinjaman
    Route::get('/pinjaman', [PinjamanController::class, 'index'])->name('pinjaman.index');
    Route::get('/pinjaman/create', [PinjamanController::class, 'create'])->name('pinjaman.create');
    Route::post('/pinjaman', [PinjamanController::class, 'store'])->name('pinjaman.store');
    Route::get('/pinjaman/{pinjaman}', [PinjamanController::class, 'show'])->name('pinjaman.show');
    Route::get('/pinjaman/{pinjaman}/kembali', [PinjamanController::class, 'pengembalian'])->name('pinjaman.kembali');
    Route::patch('/pinjaman/{pinjaman}/kembali', [PinjamanController::class, 'prosesKembali'])->name('pinjaman.proses-kembali');

    // Laporan Petugas
    Route::get('/laporan', [PinjamanController::class, 'laporan'])->name('laporan');
    Route::get('/laporan/pdf', [PinjamanController::class, 'laporanPdf'])->name('laporan.pdf');
});
