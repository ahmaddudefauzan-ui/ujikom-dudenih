@extends('layouts.app')
@section('title', 'Data Barang')
@section('page-title', 'Data Barang')

@section('content')

{{-- Header Banner & Tombol Tambah --}}
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div>
        <h4 class="fw-bold mb-1 text-dark">
            <i class="bi bi-box-seam-fill text-primary me-2"></i>Data Inventaris Barang
        </h4>
        <p class="text-muted small mb-0">
            Daftar master inventaris barang SMK Bakti Nusantara 666 (Perabotan, Elektronik, dan Alat Praktik / Lab).
        </p>
    </div>
    <div class="d-flex align-items-center gap-2">
        <a href="{{ route('admin.barang.create') }}" class="btn btn-primary btn-sm px-3 shadow-sm">
            <i class="bi bi-plus-lg me-1"></i> Tambah Barang
        </a>
    </div>
</div>

{{-- Statistik Ringkasan --}}
@if(isset($stats))
<div class="row g-3 mb-4">
    <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-body p-3 d-flex align-items-center">
                <div class="rounded-3 p-2 bg-primary bg-opacity-10 text-primary me-3 d-flex align-items-center justify-content-center" style="width:44px;height:44px;">
                    <i class="bi bi-boxes fs-5"></i>
                </div>
                <div>
                    <div class="fs-4 fw-bold text-dark lh-1 mb-1">{{ number_format($stats['total_items']) }}</div>
                    <small class="text-muted text-uppercase fw-semibold" style="font-size: 0.68rem; letter-spacing: 0.5px;">Jenis Barang</small>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-body p-3 d-flex align-items-center">
                <div class="rounded-3 p-2 bg-info bg-opacity-10 text-info me-3 d-flex align-items-center justify-content-center" style="width:44px;height:44px;">
                    <i class="bi bi-box-seam fs-5"></i>
                </div>
                <div>
                    <div class="fs-4 fw-bold text-info lh-1 mb-1">{{ number_format($stats['stok_total']) }}</div>
                    <small class="text-muted text-uppercase fw-semibold" style="font-size: 0.68rem; letter-spacing: 0.5px;">Total Unit</small>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-body p-3 d-flex align-items-center">
                <div class="rounded-3 p-2 bg-success bg-opacity-10 text-success me-3 d-flex align-items-center justify-content-center" style="width:44px;height:44px;">
                    <i class="bi bi-check2-circle fs-5"></i>
                </div>
                <div>
                    <div class="fs-4 fw-bold text-success lh-1 mb-1">{{ number_format($stats['stok_tersedia']) }}</div>
                    <small class="text-muted text-uppercase fw-semibold" style="font-size: 0.68rem; letter-spacing: 0.5px;">Unit Tersedia</small>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-body p-3 d-flex align-items-center">
                <div class="rounded-3 p-2 bg-warning bg-opacity-10 text-warning me-3 d-flex align-items-center justify-content-center" style="width:44px;height:44px;">
                    <i class="bi bi-exclamation-triangle fs-5"></i>
                </div>
                <div>
                    <div class="fs-4 fw-bold text-warning lh-1 mb-1">{{ number_format($stats['rusak']) }}</div>
                    <small class="text-muted text-uppercase fw-semibold" style="font-size: 0.68rem; letter-spacing: 0.5px;">Perlu Perbaikan</small>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

<!-- Filter Toolbar -->
<div class="card border-0 shadow-sm mb-4 rounded-3">
    <div class="card-body p-3 p-md-4">
        <form method="GET" class="row g-2 align-items-end">
            <div class="col-md-3">
                <label class="form-label small fw-semibold text-muted mb-1">Cari Barang</label>
                <div class="input-group input-group-sm">
                    <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-search"></i></span>
                    <input type="text" name="search" class="form-control border-start-0 ps-0"
                        placeholder="Nama, kode, atau merk..." value="{{ request('search') }}">
                </div>
            </div>
            <div class="col-6 col-md-2">
                <label class="form-label small fw-semibold text-muted mb-1">Kategori</label>
                <select name="kategori_id" class="form-select form-select-sm" onchange="this.form.submit()">
                    <option value="">Semua Kategori</option>
                    @foreach($kategoris as $k)
                        <option value="{{ $k->id }}" {{ request('kategori_id') == $k->id ? 'selected' : '' }}>
                            {{ $k->nama_kategori }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-6 col-md-3">
                <label class="form-label small fw-semibold text-muted mb-1">Ruangan / Lokasi</label>
                <select name="ruangan_id" class="form-select form-select-sm" onchange="this.form.submit()">
                    <option value="">Semua Ruangan (59)</option>
                    @foreach($ruangans as $r)
                        <option value="{{ $r->id }}" {{ request('ruangan_id') == $r->id ? 'selected' : '' }}>
                            {{ $r->kode_ruangan }} - {{ $r->nama_ruangan }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-6 col-md-2">
                <label class="form-label small fw-semibold text-muted mb-1">Kondisi</label>
                <select name="kondisi" class="form-select form-select-sm" onchange="this.form.submit()">
                    <option value="">Semua Kondisi</option>
                    @foreach(['Baik','Rusak Ringan','Rusak Berat'] as $kond)
                        <option value="{{ $kond }}" {{ request('kondisi') == $kond ? 'selected' : '' }}>{{ $kond }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-6 col-md-2 d-flex gap-1">
                <button type="submit" class="btn btn-primary btn-sm flex-fill">
                    <i class="bi bi-funnel me-1"></i> Filter
                </button>
                @if(request()->hasAny(['search', 'kategori_id', 'ruangan_id', 'kondisi']))
                    <a href="{{ route('admin.barang.index') }}" class="btn btn-outline-secondary btn-sm" title="Reset Filter">
                        <i class="bi bi-arrow-counterclockwise"></i>
                    </a>
                @endif
            </div>

            <div class="col-12 d-flex justify-content-end align-items-center gap-2 pt-2 border-top mt-2">
                <small class="text-muted">Tampilkan:</small>
                <select name="per_page" class="form-select form-select-sm w-auto" onchange="this.form.submit()">
                    @foreach([10, 20, 50, 100] as $size)
                        <option value="{{ $size }}" {{ request('per_page', 20) == $size ? 'selected' : '' }}>{{ $size }} per hal</option>
                    @endforeach
                </select>
            </div>
        </form>
    </div>
</div>

<div class="card border-0 shadow-sm rounded-3 overflow-hidden">
    <div class="card-header bg-white py-3 d-flex flex-wrap justify-content-between align-items-center gap-2 border-bottom">
        <div class="d-flex align-items-center gap-2">
            <span class="fw-bold text-dark"><i class="bi bi-table me-2 text-primary"></i>Daftar Inventaris Barang</span>
            <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-2 py-1">
                {{ number_format($barangs->total()) }} Item
            </span>
        </div>
        <small class="text-muted">
            Menampilkan <strong>{{ $barangs->firstItem() ?? 0 }}</strong> - <strong>{{ $barangs->lastItem() ?? 0 }}</strong> dari total <strong>{{ number_format($barangs->total()) }}</strong> barang
        </small>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light text-muted small text-uppercase" style="font-size: 0.72rem; letter-spacing: 0.5px;">
                <tr>
                    <th class="ps-3" style="width: 50px;">#</th>
                    <th style="min-width: 110px;">Kode</th>
                    <th style="min-width: 200px;">Nama Barang</th>
                    <th style="min-width: 150px;">Kategori</th>
                    <th style="min-width: 180px;">Ruangan / Lokasi</th>
                    <th style="min-width: 100px;">Stok</th>
                    <th style="min-width: 110px;">Kondisi</th>
                    <th class="text-end pe-3" style="width: 120px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($barangs as $b)
                <tr>
                    <td class="ps-3 text-muted small">
                        {{ $loop->iteration + ($barangs->currentPage()-1)*$barangs->perPage() }}
                    </td>
                    <td>
                        <span class="badge bg-light text-dark border font-monospace px-2 py-1" style="font-size: 0.8rem;">
                            {{ $b->kode_barang }}
                        </span>
                    </td>
                    <td>
                        <span class="fw-semibold text-dark d-block">{{ $b->nama_barang }}</span>
                        @if($b->merk)
                            <small class="text-muted">{{ $b->merk }}</small>
                        @endif
                    </td>
                    <td>
                        <span class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary border-opacity-25 px-2 py-1">
                            {{ $b->kategori->nama_kategori }}
                        </span>
                    </td>
                    <td>
                        <div class="small fw-semibold text-dark">{{ $b->ruangan->nama_ruangan }}</div>
                        <small class="text-muted">{{ $b->ruangan->lokasi }}</small>
                    </td>
                    <td>
                        <span class="text-primary fw-bold">{{ $b->stok_tersedia }}</span>
                        <span class="text-muted small">/ {{ $b->stok_total }}</span>
                    </td>
                    <td>
                        <span class="badge bg-{{ $b->kondisi_badge }} bg-opacity-10 text-{{ $b->kondisi_badge }} border border-{{ $b->kondisi_badge }} border-opacity-25 px-2 py-1">
                            {{ $b->kondisi }}
                        </span>
                    </td>
                    <td class="text-end pe-3">
                        <div class="d-inline-flex gap-1">
                            <a href="{{ route('admin.barang.show', $b) }}" class="btn btn-sm btn-outline-info" title="Lihat Detail">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('admin.barang.units', $b) }}" class="btn btn-sm btn-outline-primary" title="Kelola Unit ({{ $b->stok_total }} unit)">
                                <i class="bi bi-grid-3x3-gap"></i>
                            </a>
                            <a href="{{ route('admin.barang.edit', $b) }}" class="btn btn-sm btn-outline-warning" title="Edit Barang">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.barang.destroy', $b) }}" method="POST"
                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus barang ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus Barang">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center py-5">
                        <div class="text-muted">
                            <i class="bi bi-inbox fs-1 d-block mb-2 text-secondary opacity-50"></i>
                            <h6 class="fw-semibold">Belum Ada Data Barang</h6>
                            <p class="small mb-3">Tidak ditemukan barang yang sesuai dengan filter pencarian.</p>
                            @if(request()->hasAny(['search', 'kategori_id', 'ruangan_id', 'kondisi']))
                                <a href="{{ route('admin.barang.index') }}" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-arrow-counterclockwise me-1"></i> Reset Filter
                                </a>
                            @else
                                <a href="{{ route('admin.barang.create') }}" class="btn btn-sm btn-primary">
                                    <i class="bi bi-plus-lg me-1"></i> Tambah Barang Pertama
                                </a>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($barangs->hasPages())
    <div class="card-footer bg-white py-3 border-top d-flex flex-column flex-md-row justify-content-between align-items-center gap-2">
        <small class="text-muted">
            Menampilkan data <strong>{{ $barangs->firstItem() }}</strong> sampai <strong>{{ $barangs->lastItem() }}</strong> dari total <strong>{{ number_format($barangs->total()) }}</strong> barang
        </small>
        <div>
            {{ $barangs->links() }}
        </div>
    </div>
    @endif
</div>
@endsection
