@extends('layouts.app')
@section('title', 'Kategori Barang')
@section('page-title', 'Kategori Barang')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <p class="text-muted mb-0">Kelola kategori barang inventaris</p>
    <a href="{{ route('admin.kategori.create') }}" class="btn btn-primary btn-sm">
        <i class="bi bi-plus-lg me-1"></i> Tambah Kategori
    </a>
</div>

<div class="card shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr><th>#</th><th>Nama Kategori</th><th>Jumlah Barang</th><th>Keterangan</th><th>Aksi</th></tr>
            </thead>
            <tbody>
                @forelse($kategoris as $k)
                <tr>
                    <td>{{ $loop->iteration + ($kategoris->currentPage()-1)*$kategoris->perPage() }}</td>
                    <td class="fw-semibold">{{ $k->nama_kategori }}</td>
                    <td><span class="badge bg-primary">{{ $k->barangs_count }} barang</span></td>
                    <td>{{ Str::limit($k->keterangan, 50) ?? '-' }}</td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="{{ route('admin.kategori.edit', $k) }}" class="btn btn-sm btn-outline-warning">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.kategori.destroy', $k) }}" method="POST"
                                onsubmit="return confirm('Hapus kategori ini?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center text-muted py-4">Belum ada kategori</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($kategoris->hasPages())
    <div class="card-footer bg-white">{{ $kategoris->links() }}</div>
    @endif
</div>
@endsection
