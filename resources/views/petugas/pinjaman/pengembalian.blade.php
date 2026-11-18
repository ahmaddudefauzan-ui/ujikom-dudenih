@extends('layouts.app')
@section('title', 'Proses Pengembalian')
@section('page-title', 'Proses Pengembalian Barang')

@section('content')
<div class="row justify-content-center">
<div class="col-lg-6">

<div class="card shadow-sm mb-3">
    <div class="card-header bg-white fw-semibold">
        <i class="bi bi-info-circle me-2 text-primary"></i>Detail Pinjaman
    </div>
    <div class="card-body">
        <table class="table table-sm table-borderless mb-0">
            <tr>
                <td class="text-muted" width="40%">Kode Pinjam</td>
                <td><code>{{ $pinjaman->kode_pinjam }}</code>
                    <span class="ms-2 badge bg-{{ $pinjaman->status_badge }}">{{ $pinjaman->status }}</span>
                </td>
            </tr>
            <tr><td class="text-muted">Peminjam</td><td class="fw-semibold">{{ $pinjaman->nama_peminjam }}</td></tr>
            <tr><td class="text-muted">Barang</td><td>{{ $pinjaman->barang->nama_barang }}</td></tr>
            <tr><td class="text-muted">Jumlah</td><td>{{ $pinjaman->jumlah }} unit</td></tr>
            <tr><td class="text-muted">Rencana Kembali</td>
                <td class="{{ $pinjaman->status === 'Terlambat' ? 'text-danger fw-bold' : '' }}">
                    {{ $pinjaman->tanggal_kembali_rencana->isoFormat('D MMM Y') }}
                    @if($pinjaman->status === 'Terlambat')
                        <span class="ms-1 badge bg-danger">Terlambat</span>
                    @endif
                </td>
            </tr>
        </table>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-header bg-success text-white fw-semibold">
        <i class="bi bi-box-arrow-in-down me-2"></i>Form Pengembalian
    </div>
    <div class="card-body p-4">
        @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0 ps-3">
                @foreach($errors->all() as $e) <li>{{ $e }}</li> @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('petugas.pinjaman.proses-kembali', $pinjaman) }}" method="POST">
            @csrf @method('PATCH')
            <div class="mb-3">
                <label class="form-label fw-semibold small">Tanggal Pengembalian <span class="text-danger">*</span></label>
                <input type="date" name="tanggal_kembali_aktual"
                    class="form-control @error('tanggal_kembali_aktual') is-invalid @enderror"
                    value="{{ old('tanggal_kembali_aktual', date('Y-m-d')) }}" required>
                @error('tanggal_kembali_aktual') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold small">Catatan Pengembalian</label>
                <textarea name="catatan" class="form-control" rows="3"
                    placeholder="Kondisi barang saat dikembalikan, dll.">{{ old('catatan', $pinjaman->catatan) }}</textarea>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-check-circle me-1"></i>Konfirmasi Pengembalian
                </button>
                <a href="{{ route('petugas.pinjaman.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
</div>
</div>
@endsection
