@extends('layouts.app')
@section('title', 'Detail Barang')
@section('page-title', 'Detail Barang')

@section('content')
<div class="row g-3">
    <div class="col-md-5">
        <div class="card shadow-sm">
            <div class="card-header bg-white fw-semibold">
                <i class="bi bi-box-seam me-2 text-primary"></i>Informasi Barang
            </div>
            <div class="card-body">
                <table class="table table-sm table-borderless">
                    <tr><td class="text-muted" width="40%">Kode</td><td><code>{{ $barang->kode_barang }}</code></td></tr>
                    <tr><td class="text-muted">Nama</td><td class="fw-semibold">{{ $barang->nama_barang }}</td></tr>
                    <tr><td class="text-muted">Kategori</td><td>{{ $barang->kategori->nama_kategori }}</td></tr>
                    <tr><td class="text-muted">Ruangan</td><td>{{ $barang->ruangan->nama_ruangan }}</td></tr>
                    <tr><td class="text-muted">Stok Total</td><td>{{ $barang->stok_total }}</td></tr>
                    <tr><td class="text-muted">Stok Tersedia</td>
                        <td><span class="fw-bold text-primary">{{ $barang->stok_tersedia }}</span></td>
                    </tr>
                    <tr><td class="text-muted">Kondisi</td>
                        <td><span class="badge bg-{{ $barang->kondisi_badge }}">{{ $barang->kondisi }}</span></td>
                    </tr>
                    <tr><td class="text-muted">Merk</td><td>{{ $barang->merk ?? '-' }}</td></tr>
                    <tr><td class="text-muted">Tahun</td><td>{{ $barang->tahun_pengadaan ?? '-' }}</td></tr>
                    <tr><td class="text-muted">Keterangan</td><td>{{ $barang->keterangan ?? '-' }}</td></tr>
                </table>
                <div class="d-flex gap-2 mt-2">
                    <a href="{{ route('admin.barang.edit', $barang) }}" class="btn btn-warning btn-sm">
                        <i class="bi bi-pencil me-1"></i>Edit
                    </a>
                    <a href="{{ route('admin.barang.units', $barang) }}" class="btn btn-primary btn-sm">
                        <i class="bi bi-grid-3x3-gap me-1"></i>Kelola Unit
                    </a>
                    <a href="{{ route('admin.barang.index') }}" class="btn btn-secondary btn-sm">
                        <i class="bi bi-arrow-left me-1"></i>Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-7">
        <div class="card shadow-sm">
            <div class="card-header bg-white fw-semibold">
                <i class="bi bi-clock-history me-2 text-primary"></i>Riwayat Peminjaman
            </div>
            <div class="table-responsive">
                <table class="table table-sm table-hover mb-0">
                    <thead class="table-light">
                        <tr><th>Kode</th><th>Peminjam</th><th>Tgl Pinjam</th><th>Jumlah</th><th>Status</th></tr>
                    </thead>
                    <tbody>
                        @forelse($barang->pinjamans as $p)
                        <tr>
                            <td><code class="small">{{ $p->kode_pinjam }}</code></td>
                            <td>{{ Str::limit($p->nama_peminjam, 20) }}</td>
                            <td>{{ $p->tanggal_pinjam->format('d/m/Y') }}</td>
                            <td>{{ $p->jumlah }}</td>
                            <td><span class="badge bg-{{ $p->status_badge }}">{{ $p->status }}</span></td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="text-center text-muted py-3">Belum pernah dipinjam</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
