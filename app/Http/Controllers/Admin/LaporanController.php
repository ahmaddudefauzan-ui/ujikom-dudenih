<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Pinjaman;
use App\Models\Ruangan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LaporanController extends Controller
{
    public function kondisiBarang(Request $request)
    {
        $query = Barang::with(['kategori', 'ruangan']);

        if ($request->kondisi) {
            $query->where('kondisi', $request->kondisi);
        }
        if ($request->ruangan_id) {
            $query->where('ruangan_id', $request->ruangan_id);
        }
        if ($request->kategori_id) {
            $query->where('kategori_id', $request->kategori_id);
        }

        $barangs = $query->orderBy('kode_barang')->get();
        $ruangans = Ruangan::orderBy('nama_ruangan')->get();
        $kategoris = Kategori::orderBy('nama_kategori')->get();

        $summary = [
            'total' => $barangs->count(),
            'baik' => $barangs->where('kondisi', 'Baik')->count(),
            'rusak_ringan' => $barangs->where('kondisi', 'Rusak Ringan')->count(),
            'rusak_berat' => $barangs->where('kondisi', 'Rusak Berat')->count(),
        ];

        return view('admin.laporan.kondisi-barang', compact('barangs', 'ruangans', 'kategoris', 'summary'));
    }

    public function kondisiBarangPdf(Request $request)
    {
        $query = Barang::with(['kategori', 'ruangan']);
        if ($request->kondisi) {
            $query->where('kondisi', $request->kondisi);
        }
        if ($request->ruangan_id) {
            $query->where('ruangan_id', $request->ruangan_id);
        }
        if ($request->kategori_id) {
            $query->where('kategori_id', $request->kategori_id);
        }

        $barangs = $query->orderBy('kode_barang')->get();
        $summary = [
            'total' => $barangs->count(),
            'baik' => $barangs->where('kondisi', 'Baik')->count(),
            'rusak_ringan' => $barangs->where('kondisi', 'Rusak Ringan')->count(),
            'rusak_berat' => $barangs->where('kondisi', 'Rusak Berat')->count(),
        ];

        $filterLabel = $this->buildFilterLabel($request);
        $html = view('admin.laporan.pdf.kondisi-barang', compact('barangs', 'summary', 'filterLabel'))->render();

        return $this->streamPdf($html, 'laporan-kondisi-barang-'.date('Ymd'));
    }

    public function pinjaman(Request $request)
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

        return view('admin.laporan.pinjaman', compact('pinjamans', 'summary'));
    }

    public function pinjamanPdf(Request $request)
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

        $filterLabel = $this->buildFilterLabelPinjaman($request);
        $html = view('admin.laporan.pdf.pinjaman', compact('pinjamans', 'summary', 'filterLabel'))->render();

        return $this->streamPdf($html, 'laporan-pinjaman-'.date('Ymd'));
    }

    private function buildFilterLabel($request): string
    {
        $parts = [];
        if ($request->kondisi) {
            $parts[] = 'Kondisi: '.$request->kondisi;
        }
        if ($request->ruangan_id) {
            $parts[] = 'Ruangan: '.optional(Ruangan::find($request->ruangan_id))->nama_ruangan;
        }
        if ($request->kategori_id) {
            $parts[] = 'Kategori: '.optional(Kategori::find($request->kategori_id))->nama_kategori;
        }

        return $parts ? implode(' | ', $parts) : 'Semua Data';
    }

    private function buildFilterLabelPinjaman($request): string
    {
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

        return $parts ? implode(' | ', $parts) : 'Semua Data';
    }

    private function streamPdf(string $html, string $filename): Response
    {
        // Try DomPDF if available
        if (class_exists(Pdf::class)) {
            $pdf = Pdf::loadHTML($html)->setPaper('a4', 'landscape');

            return $pdf->stream($filename.'.pdf');
        }

        // Fallback: return HTML for printing
        return response($html)->header('Content-Type', 'text/html');
    }
}
