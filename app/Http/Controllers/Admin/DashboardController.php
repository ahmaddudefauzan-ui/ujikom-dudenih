<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Pinjaman;
use App\Models\Ruangan;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_barang' => Barang::count(),
            'total_ruangan' => Ruangan::count(),
            'total_pinjaman' => Pinjaman::count(),
            'pinjaman_aktif' => Pinjaman::where('status', 'Dipinjam')->count(),
            'terlambat' => Pinjaman::where('status', 'Terlambat')->count(),
            'barang_baik' => Barang::where('kondisi', 'Baik')->count(),
            'barang_rusak_ringan' => Barang::where('kondisi', 'Rusak Ringan')->count(),
            'barang_rusak_berat' => Barang::where('kondisi', 'Rusak Berat')->count(),
            'total_petugas' => User::where('role', 'petugas')->count(),
        ];

        // Update status terlambat otomatis
        Pinjaman::where('status', 'Dipinjam')
            ->where('tanggal_kembali_rencana', '<', Carbon::today())
            ->update(['status' => 'Terlambat']);

        $pinjaman_terbaru = Pinjaman::with('barang')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        $barang_kritis = Barang::where('stok_tersedia', '<=', 2)
            ->orderBy('stok_tersedia')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'pinjaman_terbaru', 'barang_kritis'));
    }
}
