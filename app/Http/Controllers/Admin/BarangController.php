<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Ruangan;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index(Request $request)
    {
        $query = Barang::with(['kategori', 'ruangan']);

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('nama_barang', 'like', '%'.$request->search.'%')
                    ->orWhere('kode_barang', 'like', '%'.$request->search.'%')
                    ->orWhere('merk', 'like', '%'.$request->search.'%');
            });
        }

        if ($request->kondisi) {
            $query->where('kondisi', $request->kondisi);
        }

        if ($request->ruangan_id) {
            $query->where('ruangan_id', $request->ruangan_id);
        }

        if ($request->kategori_id) {
            $query->where('kategori_id', $request->kategori_id);
        }

        $perPage = in_array((int) $request->get('per_page', 20), [10, 20, 50, 100], true)
            ? (int) $request->get('per_page', 20)
            : 20;

        $barangs = $query->orderBy('kode_barang')->paginate($perPage)->withQueryString();
        $ruangans = Ruangan::orderBy('nama_ruangan')->get();
        $kategoris = Kategori::orderBy('nama_kategori')->get();

        $stats = [
            'total_items' => Barang::count(),
            'stok_total' => Barang::sum('stok_total'),
            'stok_tersedia' => Barang::sum('stok_tersedia'),
            'rusak' => Barang::where('kondisi', '!=', 'Baik')->count(),
        ];

        return view('admin.barang.index', compact('barangs', 'ruangans', 'kategoris', 'stats', 'perPage'));
    }

    public function create()
    {
        $kategoris = Kategori::orderBy('nama_kategori')->get();
        $ruangans = Ruangan::orderBy('nama_ruangan')->get();

        return view('admin.barang.create', compact('kategoris', 'ruangans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_barang' => 'required|string|max:20|unique:barangs',
            'nama_barang' => 'required|string|max:150',
            'kategori_id' => 'required|exists:kategoris,id',
            'ruangan_id' => 'required|exists:ruangans,id',
            'stok_total' => 'required|integer|min:0',
            'stok_tersedia' => 'required|integer|min:0|lte:stok_total',
            'kondisi' => 'required|in:Baik,Rusak Ringan,Rusak Berat',
            'merk' => 'nullable|string|max:100',
            'tahun_pengadaan' => 'nullable|integer|min:2000|max:'.date('Y'),
            'keterangan' => 'nullable|string',
        ]);

        $barang = Barang::create($request->all());
        $barang->syncStok();

        return redirect()->route('admin.barang.index')->with('success', 'Barang berhasil ditambahkan.');
    }

    public function show(Barang $barang)
    {
        $barang->load(['kategori', 'ruangan', 'pinjamans' => fn ($q) => $q->latest()->limit(10)]);

        return view('admin.barang.show', compact('barang'));
    }

    public function edit(Barang $barang)
    {
        $kategoris = Kategori::orderBy('nama_kategori')->get();
        $ruangans = Ruangan::orderBy('nama_ruangan')->get();

        return view('admin.barang.edit', compact('barang', 'kategoris', 'ruangans'));
    }

    public function update(Request $request, Barang $barang)
    {
        $request->validate([
            'kode_barang' => 'required|string|max:20|unique:barangs,kode_barang,'.$barang->id,
            'nama_barang' => 'required|string|max:150',
            'kategori_id' => 'required|exists:kategoris,id',
            'ruangan_id' => 'required|exists:ruangans,id',
            'stok_total' => 'required|integer|min:0',
            'stok_tersedia' => 'required|integer|min:0|lte:stok_total',
            'kondisi' => 'required|in:Baik,Rusak Ringan,Rusak Berat',
            'merk' => 'nullable|string|max:100',
            'tahun_pengadaan' => 'nullable|integer|min:2000|max:'.date('Y'),
            'keterangan' => 'nullable|string',
        ]);

        $barang->update($request->all());
        $barang->syncStok();

        return redirect()->route('admin.barang.index')->with('success', 'Barang berhasil diperbarui.');
    }

    public function destroy(Barang $barang)
    {
        if ($barang->pinjamans()->whereIn('pinjamans.status', ['Dipinjam', 'Terlambat'])->count() > 0) {
            return back()->with('error', 'Barang tidak dapat dihapus karena masih ada yang dipinjam.');
        }
        $barang->delete();

        return redirect()->route('admin.barang.index')->with('success', 'Barang berhasil dihapus.');
    }
}
