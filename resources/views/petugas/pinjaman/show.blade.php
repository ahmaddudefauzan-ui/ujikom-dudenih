@extends('layouts.app')
@section('title', 'Detail Peminjaman')
@section('page-title', 'Detail Peminjaman')

@section('content')
<div class="row justify-content-center">
<div class="col-lg-7">
<div class="card shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <span class="fw-semibold"><i class="bi bi-info-circle me-2 text-primary"></i>Detail Peminjaman</span>
        <span class="badge bg-{{ $pinjaman->status_badge }} fs-6 px-3">{{ $pinjaman->status }}</span>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-sm-6">
                <h6 class="text-muted text-uppercase small mb-3">Informasi Peminjam</h6>
                <table class="table table-sm table-borderless">
                    <tr><td class="text-muted" width="45%">Kode</td><td><code>{{ $pinjaman->kode_pinjam }}</code></td></tr>
                    <tr><td class="text-muted">Nama</td><td class="fw-semibold">{{ $pinjaman->nama_peminjam }}</td></tr>
                    <tr><td class="text-muted">Jenis</td><td>{{ $pinjaman->jenis_peminjam }}</td></tr>
                    <tr><td class="text-muted">NIS/NIP</td><td>{{ $pinjaman->no_identitas ?? '-' }}</td></tr>
                    <tr><td class="text-muted">No. HP</td><td>{{ $pinjaman->no_hp ?? '-' }}</td></tr>
                    <tr><td class="text-muted">Keperluan</td><td>{{ $pinjaman->keperluan ?? '-' }}</td></tr>
                </table>
            </div>
            <div class="col-sm-6">
                <h6 class="text-muted text-uppercase small mb-3">Informasi Barang</h6>
                <table class="table table-sm table-borderless">
                    <tr><td class="text-muted" width="45%">Barang</td><td class="fw-semibold">{{ $pinjaman->barang->nama_barang }}</td></tr>
                    <tr><td class="text-muted">Jumlah</td><td>{{ $pinjaman->jumlah }} unit</td></tr>
                    <tr><td class="text-muted">Tgl Pinjam</td><td>{{ $pinjaman->tanggal_pinjam->isoFormat('D MMM Y') }}</td></tr>
                    <tr><td class="text-muted">Rencana Kembali</td><td>{{ $pinjaman->tanggal_kembali_rencana->isoFormat('D MMM Y') }}</td></tr>
                    @if($pinjaman->tanggal_kembali_aktual)
                    <tr><td class="text-muted">Tgl Kembali</td>
                        <td class="text-success fw-semibold">{{ $pinjaman->tanggal_kembali_aktual->isoFormat('D MMM Y') }}</td>
                    </tr>
                    @endif
                    <tr><td class="text-muted">Petugas</td><td>{{ $pinjaman->petugas?->name ?? 'Mandiri' }}</td></tr>
                    @if($pinjaman->catatan)
                    <tr><td class="text-muted">Catatan</td><td>{{ $pinjaman->catatan }}</td></tr>
                    @endif
                </table>
            </div>
        </div>

        <div class="d-flex gap-2 border-top pt-3 mt-2">
            @if($pinjaman->status !== 'Dikembalikan')
            <a href="{{ route('petugas.pinjaman.kembali', $pinjaman) }}" class="btn btn-success">
                <i class="bi bi-box-arrow-in-down me-1"></i>Proses Pengembalian
            </a>
            @endif
            <a href="{{ route('petugas.pinjaman.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left me-1"></i>Kembali
            </a>
        </div>
    </div>
</div>
</div>
</div>
@endsection
