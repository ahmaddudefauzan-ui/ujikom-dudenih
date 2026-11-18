@extends('layouts.app')
@section('title', 'Dashboard Petugas')
@section('page-title', 'Dashboard Petugas')

@section('content')
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="card stat-card shadow-sm h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="icon-box bg-primary bg-opacity-10">
                    <i class="bi bi-calendar-check text-primary"></i>
                </div>
                <div>
                    <div class="fs-4 fw-bold">{{ $stats['pinjaman_hari_ini'] }}</div>
                    <div class="text-muted small">Pinjaman Hari Ini</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card stat-card shadow-sm h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="icon-box bg-warning bg-opacity-10">
                    <i class="bi bi-box-arrow-right text-warning"></i>
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
                    <i class="bi bi-box-arrow-in-left text-success"></i>
                </div>
                <div>
                    <div class="fs-4 fw-bold">{{ $stats['kembali_hari_ini'] }}</div>
                    <div class="text-muted small">Kembali Hari Ini</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-3">
    @if($pinjaman_terlambat->count() > 0)
    <div class="col-12">
        <div class="card shadow-sm border-danger">
            <div class="card-header bg-danger text-white fw-semibold">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>Peminjaman Terlambat
            </div>
            <div class="table-responsive">
                <table class="table table-sm table-hover mb-0">
                    <thead class="table-light">
                        <tr><th>Kode</th><th>Peminjam</th><th>Barang</th><th>Jml</th><th>Deadline</th><th>Aksi</th></tr>
                    </thead>
                    <tbody>
                        @foreach($pinjaman_terlambat as $p)
                        <tr class="table-danger">
                            <td><code class="small">{{ $p->kode_pinjam }}</code></td>
                            <td>{{ $p->nama_peminjam }}</td>
                            <td>{{ Str::limit($p->barang->nama_barang, 25) }}</td>
                            <td>{{ $p->jumlah }}</td>
                            <td>{{ $p->tanggal_kembali_rencana->format('d/m/Y') }}</td>
                            <td>
                                <a href="{{ route('petugas.pinjaman.kembali', $p) }}" class="btn btn-sm btn-danger">
                                    <i class="bi bi-box-arrow-in-down me-1"></i>Proses
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif

    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <span class="fw-semibold"><i class="bi bi-list-ul me-2 text-primary"></i>Pinjaman Terbaru</span>
                <a href="{{ route('petugas.pinjaman.create') }}" class="btn btn-primary btn-sm">
                    <i class="bi bi-plus me-1"></i>Input Baru
                </a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr><th>Kode</th><th>Peminjam</th><th>Barang</th><th>Tgl Pinjam</th><th>Deadline</th><th>Status</th><th>Aksi</th></tr>
                    </thead>
                    <tbody>
                        @forelse($pinjaman_terbaru as $p)
                        <tr>
                            <td><code class="small">{{ $p->kode_pinjam }}</code></td>
                            <td>{{ Str::limit($p->nama_peminjam, 20) }}</td>
                            <td>{{ Str::limit($p->barang->nama_barang, 20) }}</td>
                            <td>{{ $p->tanggal_pinjam->format('d/m/Y') }}</td>
                            <td>{{ $p->tanggal_kembali_rencana->format('d/m/Y') }}</td>
                            <td><span class="badge bg-{{ $p->status_badge }}">{{ $p->status }}</span></td>
                            <td>
                                @if($p->status !== 'Dikembalikan')
                                <a href="{{ route('petugas.pinjaman.kembali', $p) }}" class="btn btn-sm btn-outline-success">
                                    <i class="bi bi-box-arrow-in-down"></i>
                                </a>
                                @endif
                                <a href="{{ route('petugas.pinjaman.show', $p) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="7" class="text-center text-muted py-3">Belum ada data</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
