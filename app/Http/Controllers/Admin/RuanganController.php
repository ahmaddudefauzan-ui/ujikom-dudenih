<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ruangan;
use Illuminate\Http\Request;

class RuanganController extends Controller
{
    public function index(Request $request)
    {
        $query = Ruangan::withCount('barangs');

        if ($request->filled('search')) {
            $search = trim($request->search);
            $query->where(function ($q) use ($search) {
                $q->where('nama_ruangan', 'like', "%{$search}%")
                    ->orWhere('kode_ruangan', 'like', "%{$search}%")
                    ->orWhere('lokasi', 'like', "%{$search}%");
            });
        }

        $ruangans = $query->orderBy('kode_ruangan')->paginate(20)->withQueryString();

        return view('admin.ruangan.index', compact('ruangans'));
    }

    public function create()
    {
        return view('admin.ruangan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_ruangan' => 'required|string|max:20|unique:ruangans',
            'nama_ruangan' => 'required|string|max:100',
            'lokasi' => 'nullable|string|max:100',
            'keterangan' => 'nullable|string',
        ]);

        Ruangan::create($request->all());

        return redirect()->route('admin.ruangan.index')->with('success', 'Ruangan berhasil ditambahkan.');
    }

    public function edit(Ruangan $ruangan)
    {
        return view('admin.ruangan.edit', compact('ruangan'));
    }

    public function update(Request $request, Ruangan $ruangan)
    {
        $request->validate([
            'kode_ruangan' => 'required|string|max:20|unique:ruangans,kode_ruangan,'.$ruangan->id,
            'nama_ruangan' => 'required|string|max:100',
            'lokasi' => 'nullable|string|max:100',
            'keterangan' => 'nullable|string',
        ]);

        $ruangan->update($request->all());

        return redirect()->route('admin.ruangan.index')->with('success', 'Ruangan berhasil diperbarui.');
    }

    public function destroy(Ruangan $ruangan)
    {
        if ($ruangan->barangs()->count() > 0) {
            return back()->with('error', 'Ruangan tidak dapat dihapus karena masih memiliki barang.');
        }
        $ruangan->delete();

        return redirect()->route('admin.ruangan.index')->with('success', 'Ruangan berhasil dihapus.');
    }
}
