<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Pinjaman;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Auto-update terlambat
        Pinjaman::where('status', 'Dipinjam')
            ->where('tanggal_kembali_rencana', '<', Carbon::today())
            ->update(['status' => 'Terlambat']);

        $stats = [
            'pinjaman_hari_ini' => Pinjaman::whereDate('tanggal_pinjam', Carbon::today())->count(),
            'pinjaman_aktif' => Pinjaman::where('status', 'Dipinjam')->count(),
            'terlambat' => Pinjaman::where('status', 'Terlambat')->count(),
            'kembali_hari_ini' => Pinjaman::whereDate('tanggal_kembali_aktual', Carbon::today())->count(),
        ];

        $pinjaman_terlambat = Pinjaman::with('barang')
            ->where('status', 'Terlambat')
            ->orderBy('tanggal_kembali_rencana')
            ->limit(5)
            ->get();

        $pinjaman_terbaru = Pinjaman::with('barang')
            ->orderBy('created_at', 'desc')
            ->limit(8)
            ->get();

        return view('petugas.dashboard', compact('stats', 'pinjaman_terlambat', 'pinjaman_terbaru'));
    }
}
