@extends('layouts.app')
@section('title', 'Unit Barang – ' . $barang->nama_barang)
@section('page-title', 'Manajemen Unit Barang')

@section('content')

{{-- Info barang --}}
<div class="card mb-4">
    <div class="card-body">
        <div class="row align-items-center g-3">
            <div class="col-md-6">
                <div class="d-flex align-items-center gap-3">
                    <div class="stat-icon bg-primary bg-opacity-10">
                        <i class="bi bi-box-seam-fill text-primary"></i>
                    </div>
                    <div>
                        <div class="fw-bold fs-6">{{ $barang->nama_barang }}</div>
                        <code class="small">{{ $barang->kode_barang }}</code>
                        <span class="badge bg-{{ $barang->kondisi_badge }} ms-1">{{ $barang->kondisi }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row g-2 text-center">
                    <div class="col-4">
                        <div class="p-2 rounded-3 bg-secondary bg-opacity-10">
                            <div class="fw-bold fs-5">{{ $units->total() }}</div>
                            <small class="text-muted">Total Unit</small>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="p-2 rounded-3 bg-success bg-opacity-10">
                            <div class="fw-bold fs-5 text-success">
                                {{ $barang->units()->where('status','Tersedia')->count() }}
                            </div>
                            <small class="text-muted">Tersedia</small>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="p-2 rounded-3 bg-warning bg-opacity-10">
                            <div class="fw-bold fs-5 text-warning">
                                {{ $barang->units()->where('status','Dipinjam')->count() }}
                            </div>
                            <small class="text-muted">Dipinjam</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-3">
    {{-- Tambah unit baru --}}
    <div class="col-md-4">
        <div class="card h-100">
            <div class="card-header">
                <i class="bi bi-plus-circle-fill me-2 text-success"></i>Tambah Unit Baru
            </div>
            <div class="card-body">
                <form action="{{ route('admin.barang.units.store', $barang) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Jumlah Unit Ditambahkan</label>
                        <input type="number" name="jumlah_tambah" class="form-control"
                            value="1" min="1" max="500" required>
                        <div class="form-text">
                            Unit baru akan dikodekan mulai dari
                            <code>{{ $barang->kode_barang }}-{{ str_pad($units->total() + 1, 2, '0', STR_PAD_LEFT) }}</code>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success w-100">
                        <i class="bi bi-plus-lg me-1"></i> Tambah Unit
                    </button>
                </form>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-body">
                <a href="{{ route('admin.barang.show', $barang) }}" class="btn btn-secondary w-100 mb-2">
                    <i class="bi bi-arrow-left me-1"></i> Kembali ke Detail Barang
                </a>
                <a href="{{ route('admin.barang.index') }}" class="btn btn-outline-secondary w-100">
                    <i class="bi bi-list me-1"></i> Semua Barang
                </a>
            </div>
        </div>
    </div>

    {{-- Daftar unit --}}
    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="bi bi-grid-3x3-gap-fill me-2 text-primary"></i>Daftar Unit</span>
                <small class="text-muted">{{ $units->total() }} unit total</small>
            </div>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Kode Unit</th>
                            <th>No.</th>
                            <th>Kondisi</th>
                            <th>Status</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($units as $unit)
                        <tr>
                            <td>
                                <code class="fw-semibold">{{ $unit->kode_unit }}</code>
                            </td>
                            <td class="text-muted">{{ $unit->nomor_unit }}</td>
                            <td>
                                <span class="badge bg-{{ $unit->kondisi_badge }}">{{ $unit->kondisi }}</span>
                            </td>
                            <td>
                                <span class="badge bg-{{ $unit->status_badge }}">{{ $unit->status }}</span>
                            </td>
                            <td style="font-size:.8rem">{{ $unit->keterangan ?? '—' }}</td>
                            <td>
                                <div class="d-flex gap-1">
                                    {{-- Edit inline --}}
                                    <button type="button" class="btn btn-sm btn-outline-warning"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editModal{{ $unit->id }}">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    @if($unit->status !== 'Dipinjam')
                                    <form action="{{ route('admin.barang.units.destroy', [$barang, $unit]) }}"
                                          method="POST"
                                          onsubmit="return confirm('Hapus unit {{ $unit->kode_unit }}?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>

                        {{-- Modal Edit Unit --}}
                        <div class="modal fade" id="editModal{{ $unit->id }}" tabindex="-1">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                    <div class="modal-header py-2">
                                        <h6 class="modal-title fw-bold">Edit Unit <code>{{ $unit->kode_unit }}</code></h6>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <form action="{{ route('admin.barang.units.update', [$barang, $unit]) }}" method="POST">
                                        @csrf @method('PATCH')
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="form-label">Kondisi</label>
                                                <select name="kondisi" class="form-select form-select-sm">
                                                    @foreach(['Baik','Rusak Ringan','Rusak Berat'] as $k)
                                                        <option value="{{ $k }}" {{ $unit->kondisi === $k ? 'selected' : '' }}>{{ $k }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Status</label>
                                                <select name="status" class="form-select form-select-sm">
                                                    @foreach(['Tersedia','Dipinjam','Rusak'] as $s)
                                                        <option value="{{ $s }}" {{ $unit->status === $s ? 'selected' : '' }}>{{ $s }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-2">
                                                <label class="form-label">Keterangan</label>
                                                <input type="text" name="keterangan" class="form-control form-control-sm"
                                                    value="{{ $unit->keterangan }}" placeholder="Opsional">
                                            </div>
                                        </div>
                                        <div class="modal-footer py-2 gap-2">
                                            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-sm btn-warning">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                <i class="bi bi-inbox d-block fs-2 mb-2 opacity-50"></i>
                                Belum ada unit untuk barang ini.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($units->hasPages())
            <div class="card-footer">{{ $units->links() }}</div>
            @endif
        </div>
    </div>
</div>
@endsection
