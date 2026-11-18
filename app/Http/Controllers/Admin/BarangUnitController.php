<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\BarangUnit;
use Illuminate\Http\Request;

class BarangUnitController extends Controller
{
    public function index(Barang $barang)
    {
        $units = $barang->units()->orderBy('nomor_unit')->paginate(30);

        return view('admin.barang.units', compact('barang', 'units'));
    }

    public function store(Request $request, Barang $barang)
    {
        $request->validate([
            'jumlah_tambah' => 'required|integer|min:1|max:500',
        ]);

        $barang->generateUnits($request->jumlah_tambah);

        return back()->with('success', "{$request->jumlah_tambah} unit baru berhasil ditambahkan.");
    }

    public function update(Request $request, Barang $barang, BarangUnit $unit)
    {
        $request->validate([
            'kondisi' => 'required|in:Baik,Rusak Ringan,Rusak Berat',
            'status' => 'required|in:Tersedia,Dipinjam,Rusak',
            'keterangan' => 'nullable|string|max:255',
        ]);

        $unit->update($request->only('kondisi', 'status', 'keterangan'));
        $barang->syncStok();

        return back()->with('success', "Unit {$unit->kode_unit} berhasil diperbarui.");
    }

    public function destroy(Barang $barang, BarangUnit $unit)
    {
        if ($unit->pinjamans()->whereIn('pinjamans.status', ['Dipinjam', 'Terlambat'])->exists()) {
            return back()->with('error', "Unit {$unit->kode_unit} tidak dapat dihapus — sedang dipinjam.");
        }

        $unit->delete();
        $barang->syncStok();

        return back()->with('success', "Unit {$unit->kode_unit} berhasil dihapus.");
    }
}
