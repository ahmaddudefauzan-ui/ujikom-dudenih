<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SiswaController extends Controller
{
    public function index(Request $request): View
    {
        $query = Siswa::query();

        if ($request->filled('search')) {
            $search = trim($request->search);
            $query->where(function ($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%")
                    ->orWhere('nis', 'like', "%{$search}%")
                    ->orWhere('wali_kelas', 'like', "%{$search}%")
                    ->orWhere('kelas', 'like', "%{$search}%");
            });
        }

        if ($request->filled('tingkat')) {
            $query->where('tingkat', $request->tingkat);
        }

        if ($request->filled('jurusan')) {
            $query->where('jurusan', $request->jurusan);
        }

        if ($request->filled('kelas')) {
            $query->where('kelas', $request->kelas);
        }

        if ($request->filled('jenis_kelamin')) {
            $query->where('jenis_kelamin', $request->jenis_kelamin);
        }

        // Sorting
        $allowedSorts = ['nis', 'nama_lengkap', 'kelas', 'jurusan', 'tingkat', 'jenis_kelamin', 'wali_kelas'];
        $sort = in_array($request->sort, $allowedSorts, true) ? $request->sort : 'kelas';
        $direction = strtolower($request->direction) === 'desc' ? 'desc' : 'asc';

        if ($sort === 'kelas') {
            $query->orderBy('kelas', $direction)->orderBy('nama_lengkap', 'asc');
        } else {
            $query->orderBy($sort, $direction);
        }

        $perPage = in_array((int) $request->get('per_page', 20), [10, 20, 50, 100], true)
            ? (int) $request->get('per_page', 20)
            : 20;

        $siswas = $query->paginate($perPage)->withQueryString();

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

        $jurusanList = Siswa::select('jurusan')
            ->distinct()
            ->orderBy('jurusan')
            ->pluck('jurusan');

        $stats = [
            'total' => Siswa::count(),
            'laki' => Siswa::where('jenis_kelamin', 'L')->count(),
            'perempuan' => Siswa::where('jenis_kelamin', 'P')->count(),
            'kelas_x' => Siswa::where('tingkat', 'X')->count(),
            'kelas_xi' => Siswa::where('tingkat', 'XI')->count(),
            'kelas_xii' => Siswa::where('tingkat', 'XII')->count(),
            'total_kelas' => $kelasList->count(),
            'total_jurusan' => $jurusanList->count(),
        ];

        return view('admin.siswa.index', compact('siswas', 'kelasList', 'jurusanList', 'stats', 'sort', 'direction', 'perPage'));
    }

    public function create(): View
    {
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

        $jurusanList = Siswa::select('jurusan')->distinct()->orderBy('jurusan')->pluck('jurusan');

        // Map class to its default jurusan and wali_kelas for easy autofill
        $classMetadata = Siswa::select('kelas', 'jurusan', 'tingkat', 'wali_kelas')
            ->distinct()
            ->get()
            ->keyBy('kelas');

        return view('admin.siswa.create', compact('kelasList', 'jurusanList', 'classMetadata'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nis' => 'required|string|max:20|unique:siswas,nis',
            'nama_lengkap' => 'required|string|max:150',
            'jenis_kelamin' => 'required|in:L,P',
            'kelas' => 'required|string|max:30',
            'jurusan' => 'required|string|max:100',
            'tingkat' => 'required|in:X,XI,XII',
            'wali_kelas' => 'nullable|string|max:100',
        ], [
            'nis.unique' => 'NIS sudah terdaftar untuk siswa lain.',
        ]);

        Siswa::create($validated);

        return redirect()->route('admin.siswa.index')->with('success', 'Data siswa berhasil ditambahkan.');
    }

    public function edit(Siswa $siswa): View
    {
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

        $jurusanList = Siswa::select('jurusan')->distinct()->orderBy('jurusan')->pluck('jurusan');

        $classMetadata = Siswa::select('kelas', 'jurusan', 'tingkat', 'wali_kelas')
            ->distinct()
            ->get()
            ->keyBy('kelas');

        return view('admin.siswa.edit', compact('siswa', 'kelasList', 'jurusanList', 'classMetadata'));
    }

    public function update(Request $request, Siswa $siswa): RedirectResponse
    {
        $validated = $request->validate([
            'nis' => 'required|string|max:20|unique:siswas,nis,'.$siswa->id,
            'nama_lengkap' => 'required|string|max:150',
            'jenis_kelamin' => 'required|in:L,P',
            'kelas' => 'required|string|max:30',
            'jurusan' => 'required|string|max:100',
            'tingkat' => 'required|in:X,XI,XII',
            'wali_kelas' => 'nullable|string|max:100',
        ], [
            'nis.unique' => 'NIS sudah terdaftar untuk siswa lain.',
        ]);

        $siswa->update($validated);

        return redirect()->route('admin.siswa.index')->with('success', 'Data siswa berhasil diperbarui.');
    }

    public function destroy(Siswa $siswa): RedirectResponse
    {
        $nama = $siswa->nama_lengkap;
        $siswa->delete();

        return redirect()->route('admin.siswa.index')->with('success', "Data siswa {$nama} berhasil dihapus.");
    }
}
