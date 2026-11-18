@extends('layouts.app')
@section('title', 'Data Petugas')
@section('page-title', 'Data Petugas')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <p class="text-muted mb-0">Kelola akun petugas inventaris</p>
    <a href="{{ route('admin.petugas.create') }}" class="btn btn-primary btn-sm">
        <i class="bi bi-person-plus me-1"></i> Tambah Petugas
    </a>
</div>

<div class="card shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr><th>#</th><th>Nama</th><th>Email</th><th>Dibuat</th><th>Aksi</th></tr>
            </thead>
            <tbody>
                @forelse($petugasList as $p)
                <tr>
                    <td>{{ $loop->iteration + ($petugasList->currentPage()-1)*$petugasList->perPage() }}</td>
                    <td class="fw-semibold">
                        <div class="d-flex align-items-center gap-2">
                            <div class="rounded-circle bg-primary bg-opacity-10 d-flex align-items-center justify-content-center" style="width:32px;height:32px">
                                <i class="bi bi-person-fill text-primary" style="font-size:.85rem"></i>
                            </div>
                            {{ $p->name }}
                        </div>
                    </td>
                    <td>{{ $p->email }}</td>
                    <td>{{ $p->created_at->isoFormat('D MMM Y') }}</td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="{{ route('admin.petugas.edit', $p) }}" class="btn btn-sm btn-outline-warning">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.petugas.destroy', $p) }}" method="POST"
                                onsubmit="return confirm('Hapus petugas ini?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center text-muted py-4">Belum ada petugas</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($petugasList->hasPages())
    <div class="card-footer bg-white">{{ $petugasList->links() }}</div>
    @endif
</div>
@endsection
