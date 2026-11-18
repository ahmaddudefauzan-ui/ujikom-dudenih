<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Pinjaman;
use App\Models\Siswa;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PinjamanController extends Controller
{
    public function index(Request $request)
    {
        // Auto-update status terlambat
        Pinjaman::where('status', 'Dipinjam')
            ->where('tanggal_kembali_rencana', '<', Carbon::today())
            ->update(['status' => 'Terlambat']);

        $query = Pinjaman::with(['barang', 'petugas']);

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('kode_pinjam', 'like', '%'.$request->search.'%')
                    ->orWhere('nama_peminjam', 'like', '%'.$request->search.'%');
            });
        }

        // Filter khusus: tampilkan Dipinjam + Terlambat sekaligus (untuk menu Pengembalian)
        if ($request->status === 'Dipinjam') {
            $query->whereIn('status', ['Dipinjam', 'Terlambat']);
        } elseif ($request->status) {
            $query->where('status', $request->status);
        }

        $pinjamans = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();

        return view('petugas.pinjaman.index', compact('pinjamans'));
    }

    public function create()
    {
        $barangs = Barang::where('stok_tersedia', '>', 0)
            ->orderBy('nama_barang')
            ->get();
        $kelasList = Siswa::select('kelas')->distinct()->orderBy('kelas')->pluck('kelas');

        return view('petugas.pinjaman.create', compact('barangs', 'kelasList'));
    }

    public function store(Request $request)
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
            'catatan' => 'nullable|string',
        ]);

        $barang = Barang::findOrFail($request->barang_id);

        if ($request->jumlah > $barang->stok_tersedia) {
            return back()->withErrors(['jumlah' => 'Stok tidak mencukupi. Stok tersedia: '.$barang->stok_tersedia])->withInput();
        }

        Pinjaman::create([
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
            'catatan' => $request->catatan,
            'petugas_id' => Auth::id(),
        ]);

        $barang->decrement('stok_tersedia', $request->jumlah);

        return redirect()->route('petugas.pinjaman.index')->with('success', 'Data peminjaman berhasil ditambahkan.');
    }

    public function show(Pinjaman $pinjaman)
    {
        $pinjaman->load(['barang', 'petugas']);

        return view('petugas.pinjaman.show', compact('pinjaman'));
    }

    public function pengembalian(Pinjaman $pinjaman)
    {
        if ($pinjaman->status === 'Dikembalikan') {
            return back()->with('error', 'Barang sudah dikembalikan sebelumnya.');
        }

        return view('petugas.pinjaman.pengembalian', compact('pinjaman'));
    }

    public function prosesKembali(Request $request, Pinjaman $pinjaman)
    {
        $request->validate([
            'tanggal_kembali_aktual' => 'required|date',
            'catatan' => 'nullable|string',
        ]);

        if ($pinjaman->status === 'Dikembalikan') {
            return back()->with('error', 'Barang sudah dikembalikan.');
        }

        $pinjaman->update([
            'tanggal_kembali_aktual' => $request->tanggal_kembali_aktual,
            'status' => 'Dikembalikan',
            'catatan' => $request->catatan,
            'petugas_id' => Auth::id(),
        ]);

        if ($pinjaman->barang_unit_id && $pinjaman->barangUnit) {
            $pinjaman->barangUnit->update(['status' => 'Tersedia']);
        }

        $barang = $pinjaman->barang;
        $barang->stok_tersedia = min($barang->stok_total, $barang->stok_tersedia + $pinjaman->jumlah);
        $barang->save();

        return redirect()->route('petugas.pinjaman.index')->with('success', 'Pengembalian barang berhasil dicatat.');
    }

    public function laporan(Request $request)
    {
        $query = Pinjaman::with(['barang', 'petugas']);

        if ($request->status) {
            $query->where('status', $request->status);
        }
        if ($request->tgl_dari) {
            $query->where('tanggal_pinjam', '>=', $request->tgl_dari);
        }
        if ($request->tgl_sampai) {
            $query->where('tanggal_pinjam', '<=', $request->tgl_sampai);
        }

        $pinjamans = $query->orderBy('tanggal_pinjam', 'desc')->get();

        $summary = [
            'total' => $pinjamans->count(),
            'dipinjam' => $pinjamans->where('status', 'Dipinjam')->count(),
            'dikembalikan' => $pinjamans->where('status', 'Dikembalikan')->count(),
            'terlambat' => $pinjamans->where('status', 'Terlambat')->count(),
        ];

        return view('petugas.laporan.pinjaman', compact('pinjamans', 'summary'));
    }

    public function laporanPdf(Request $request)
    {
        $query = Pinjaman::with(['barang', 'petugas']);
        if ($request->status) {
            $query->where('status', $request->status);
        }
        if ($request->tgl_dari) {
            $query->where('tanggal_pinjam', '>=', $request->tgl_dari);
        }
        if ($request->tgl_sampai) {
            $query->where('tanggal_pinjam', '<=', $request->tgl_sampai);
        }

        $pinjamans = $query->orderBy('tanggal_pinjam', 'desc')->get();
        $summary = [
            'total' => $pinjamans->count(),
            'dipinjam' => $pinjamans->where('status', 'Dipinjam')->count(),
            'dikembalikan' => $pinjamans->where('status', 'Dikembalikan')->count(),
            'terlambat' => $pinjamans->where('status', 'Terlambat')->count(),
        ];

        $parts = [];
        if ($request->status) {
            $parts[] = 'Status: '.$request->status;
        }
        if ($request->tgl_dari) {
            $parts[] = 'Dari: '.$request->tgl_dari;
        }
        if ($request->tgl_sampai) {
            $parts[] = 'Sampai: '.$request->tgl_sampai;
        }
        $filterLabel = $parts ? implode(' | ', $parts) : 'Semua Data';

        $html = view('admin.laporan.pdf.pinjaman', compact('pinjamans', 'summary', 'filterLabel'))->render();

        if (class_exists(Pdf::class)) {
            $pdf = Pdf::loadHTML($html)->setPaper('a4', 'landscape');

            return $pdf->stream('laporan-pinjaman-'.date('Ymd').'.pdf');
        }

        return response($html)->header('Content-Type', 'text/html');
    }
}
