@extends('layouts.app')
@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard Admin')

@section('content')
<!-- Stat Cards -->
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="card stat-card shadow-sm h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="icon-box bg-primary bg-opacity-10">
                    <i class="bi bi-box-seam text-primary"></i>
                </div>
                <div>
                    <div class="fs-4 fw-bold">{{ $stats['total_barang'] }}</div>
                    <div class="text-muted small">Total Barang</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card stat-card shadow-sm h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="icon-box bg-warning bg-opacity-10">
                    <i class="bi bi-arrow-left-right text-warning"></i>
                </div>
                <div>
                    <div class="fs-4 fw-bold">{{ $stats['pinjaman_aktif'] }}</div>
                    <div class="text-muted small">Sedang Dipinjam</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card stat-card shadow-sm h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="icon-box bg-danger bg-opacity-10">
                    <i class="bi bi-clock-history text-danger"></i>
                </div>
                <div>
                    <div class="fs-4 fw-bold">{{ $stats['terlambat'] }}</div>
                    <div class="text-muted small">Terlambat</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card stat-card shadow-sm h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="icon-box bg-success bg-opacity-10">
                    <i class="bi bi-building text-success"></i>
                </div>
                <div>
                    <div class="fs-4 fw-bold">{{ $stats['total_ruangan'] }}</div>
                    <div class="text-muted small">Total Ruangan</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Kondisi Barang & Petugas -->
<div class="row g-3 mb-4">
    <div class="col-md-7">
        <div class="card shadow-sm h-100">
            <div class="card-header bg-white fw-semibold">
                <i class="bi bi-clipboard-data me-2 text-primary"></i>Kondisi Barang
            </div>
            <div class="card-body">
                <div class="row g-3 text-center">
                    <div class="col-4">
                        <div class="p-3 rounded-3 bg-success bg-opacity-10">
                            <div class="fs-3 fw-bold text-success">{{ $stats['barang_baik'] }}</div>
                            <small class="text-muted">Baik</small>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="p-3 rounded-3 bg-warning bg-opacity-10">
                            <div class="fs-3 fw-bold text-warning">{{ $stats['barang_rusak_ringan'] }}</div>
                            <small class="text-muted">Rusak Ringan</small>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="p-3 rounded-3 bg-danger bg-opacity-10">
                            <div class="fs-3 fw-bold text-danger">{{ $stats['barang_rusak_berat'] }}</div>
                            <small class="text-muted">Rusak Berat</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-5">
        <div class="card shadow-sm h-100">
            <div class="card-header bg-white fw-semibold">
                <i class="bi bi-people me-2 text-primary"></i>Statistik Lain
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom">
                    <span class="text-muted small">Total Petugas</span>
                    <strong>{{ $stats['total_petugas'] }}</strong>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom">
                    <span class="text-muted small">Total Pinjaman</span>
                    <strong>{{ $stats['total_pinjaman'] }}</strong>
                </div>
                <div class="d-flex gap-2 mt-3">
                    <a href="{{ route('admin.laporan.kondisi-barang') }}" class="btn btn-sm btn-outline-primary flex-fill">
                        <i class="bi bi-file-earmark-text me-1"></i>Lap. Kondisi
                    </a>
                    <a href="{{ route('admin.laporan.pinjaman') }}" class="btn btn-sm btn-outline-secondary flex-fill">
                        <i class="bi bi-file-earmark-bar-graph me-1"></i>Lap. Pinjaman
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tables -->
<div class="row g-3">
    <div class="col-md-7">
        <div class="card shadow-sm">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <span class="fw-semibold"><i class="bi bi-clock me-2 text-primary"></i>Pinjaman Terbaru</span>
                <a href="{{ route('petugas.pinjaman.index') }}" class="btn btn-xs btn-outline-primary btn-sm">Lihat Semua</a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Kode</th><th>Peminjam</th><th>Barang</th><th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pinjaman_terbaru as $p)
                        <tr>
                            <td><code class="small">{{ $p->kode_pinjam }}</code></td>
                            <td>{{ Str::limit($p->nama_peminjam, 20) }}</td>
                            <td>{{ Str::limit($p->barang->nama_barang, 20) }}</td>
                            <td>
                                <span class="badge bg-{{ $p->status_badge }}">{{ $p->status }}</span>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="4" class="text-center text-muted py-3">Belum ada data</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-5">
        <div class="card shadow-sm">
            <div class="card-header bg-white fw-semibold">
                <i class="bi bi-exclamation-triangle me-2 text-warning"></i>Stok Kritis
            </div>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr><th>Barang</th><th>Stok</th></tr>
                    </thead>
                    <tbody>
                        @forelse($barang_kritis as $b)
                        <tr>
                            <td>{{ Str::limit($b->nama_barang, 25) }}</td>
                            <td>
                                <span class="badge bg-{{ $b->stok_tersedia == 0 ? 'danger' : 'warning' }}">
                                    {{ $b->stok_tersedia }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="2" class="text-center text-muted py-3">Semua stok aman</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
