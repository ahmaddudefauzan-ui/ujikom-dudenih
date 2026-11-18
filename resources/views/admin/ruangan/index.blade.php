@extends('layouts.app')
@section('title', 'Data Ruangan')
@section('page-title', 'Data Ruangan')

@section('content')
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-3">
    <div>
        <p class="text-muted mb-0">Kelola master 59 data ruangan sekolah (Laboratorium, Kantor, Kelas, Studio, dan Gudang).</p>
    </div>
    <div class="d-flex align-items-center gap-2">
        <form method="GET" action="{{ route('admin.ruangan.index') }}" class="d-flex gap-1">
            <div class="input-group input-group-sm">
                <input type="text" name="search" class="form-control" placeholder="Cari ruangan / lokasi..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-outline-primary"><i class="bi bi-search"></i></button>
            </div>
            @if(request('search'))
                <a href="{{ route('admin.ruangan.index') }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-x-lg"></i></a>
            @endif
        </form>
        <a href="{{ route('admin.ruangan.create') }}" class="btn btn-primary btn-sm text-nowrap">
            <i class="bi bi-plus-lg me-1"></i> Tambah Ruangan
        </a>
    </div>
</div>

<div class="card shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Kode</th>
                    <th>Nama Ruangan</th>
                    <th>Lokasi</th>
                    <th>Jumlah Barang</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($ruangans as $r)
                <tr>
                    <td>{{ $loop->iteration + ($ruangans->currentPage()-1)*$ruangans->perPage() }}</td>
                    <td><code>{{ $r->kode_ruangan }}</code></td>
                    <td class="fw-semibold">{{ $r->nama_ruangan }}</td>
                    <td>{{ $r->lokasi ?? '-' }}</td>
                    <td><span class="badge bg-primary">{{ $r->barangs_count }} barang</span></td>
                    <td>{{ Str::limit($r->keterangan, 40) ?? '-' }}</td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="{{ route('admin.ruangan.edit', $r) }}" class="btn btn-sm btn-outline-warning">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.ruangan.destroy', $r) }}" method="POST"
                                onsubmit="return confirm('Hapus ruangan ini?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center text-muted py-4">Belum ada data ruangan</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($ruangans->hasPages())
    <div class="card-footer bg-white">{{ $ruangans->links() }}</div>
    @endif
</div>
@endsection
