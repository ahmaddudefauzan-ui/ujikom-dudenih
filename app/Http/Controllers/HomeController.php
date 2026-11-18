<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Pinjaman;
use App\Models\Ruangan;
use App\Models\Siswa;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(Request $request): View
    {
        $barangs = Barang::with(['kategori', 'ruangan'])
            ->where('stok_tersedia', '>', 0)
            ->orderBy('nama_barang')
            ->get();

        $kategoris = Kategori::withCount(['barangs' => function ($q) {
            $q->where('stok_tersedia', '>', 0);
        }])->get();

        $ruangans = Ruangan::whereHas('barangs', function ($q) {
            $q->where('stok_tersedia', '>', 0);
        })->orderBy('nama_ruangan')->get();

        $kelasList = Siswa::select('kelas')
            ->distinct()
            ->orderByRaw("
                CASE 
                    WHEN kelas LIKE 'X %' THEN 1 
                    WHEN kelas LIKE 'XI %' THEN 2 
                    WHEN kelas LIKE 'XII %' THEN 3 
                    ELSE 4 
                END, kelas ASC
            ")
            ->pluck('kelas');

        $stats = [
            'total_barang' => Barang::count(),
            'stok_tersedia' => Barang::sum('stok_tersedia'),
            'total_ruangan' => Ruangan::count(),
            'kategori_count' => Kategori::count(),
        ];

        $cekPinjaman = null;
        $searchPerformed = false;
        if ($request->filled('kode_pinjam')) {
            $searchPerformed = true;
            $cekPinjaman = Pinjaman::with(['barang.ruangan', 'barang.kategori'])
                ->where('kode_pinjam', strtoupper(trim($request->kode_pinjam)))
                ->first();
        }

        return view('home', compact('barangs', 'kategoris', 'ruangans', 'kelasList', 'stats', 'cekPinjaman', 'searchPerformed'));
    }

    // Autocomplete siswa by NIS / nama
    public function cariSiswa(Request $request): JsonResponse
    {
        $q = $request->q;
        $kelas = $request->kelas;

        $query = Siswa::query();
        if ($kelas) {
            $query->where('kelas', $kelas);
        }
        if ($q) {
            $query->where(function ($sq) use ($q) {
                $sq->where('nama_lengkap', 'like', '%'.$q.'%')
                    ->orWhere('nis', 'like', '%'.$q.'%');
            });
        }

        $results = $query->orderBy('nama_lengkap')->limit(20)->get(['id', 'nis', 'nama_lengkap', 'kelas', 'jenis_kelamin']);

        return response()->json($results);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nama_peminjam' => 'required|string|max:100',
            'no_identitas' => 'nullable|string|max:50',
            'jenis_peminjam' => 'required|in:Siswa,Guru,Staff,Tamu',
            'no_hp' => 'nullable|string|max:20',
            'barang_id' => 'required|exists:barangs,id',
            'jumlah' => 'required|integer|min:1',
            'tanggal_kembali_rencana' => 'required|date|after_or_equal:today',
            'keperluan' => 'nullable|string|max:255',
        ]);

        $barang = Barang::findOrFail($request->barang_id);

        if ($request->jumlah > $barang->stok_tersedia) {
            return back()->withErrors(['jumlah' => 'Stok tidak mencukupi. Stok tersedia: '.$barang->stok_tersedia])->withInput();
        }

        $pinjaman = Pinjaman::create([
            'kode_pinjam' => Pinjaman::generateKode(),
            'nama_peminjam' => $request->nama_peminjam,
            'no_identitas' => $request->no_identitas,
            'jenis_peminjam' => $request->jenis_peminjam,
            'no_hp' => $request->no_hp,
            'barang_id' => $request->barang_id,
            'jumlah' => $request->jumlah,
            'tanggal_pinjam' => Carbon::today(),
            'tanggal_kembali_rencana' => $request->tanggal_kembali_rencana,
            'status' => 'Dipinjam',
            'keperluan' => $request->keperluan,
            'petugas_id' => null,
        ]);

        $barang->decrement('stok_tersedia', $request->jumlah);

        return redirect()->route('home')->with('success_kode', $pinjaman->kode_pinjam)
            ->with('success_nama', $pinjaman->nama_peminjam)
            ->with('success_barang', $barang->nama_barang);
    }

    public function cekStatus(Request $request): View
    {
        $pinjaman = null;
        if ($request->filled('kode_pinjam')) {
            $pinjaman = Pinjaman::with(['barang.ruangan', 'barang.kategori'])
                ->where('kode_pinjam', strtoupper(trim($request->kode_pinjam)))
                ->first();
        }

        return view('cek-status', compact('pinjaman'));
    }
}
