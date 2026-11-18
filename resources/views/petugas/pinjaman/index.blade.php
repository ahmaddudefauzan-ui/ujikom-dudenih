@extends('layouts.app')

@php
    $modePengembalian = request('status') === 'Dipinjam';
@endphp

@section('title', $modePengembalian ? 'Pengembalian Barang' : 'Daftar Peminjaman')
@section('page-title', $modePengembalian ? 'Pengembalian Barang' : 'Daftar Peminjaman')

@section('content')

{{-- Banner info mode pengembalian --}}
@if($modePengembalian)
<div class="d-flex align-items-center gap-3 mb-3 p-3 rounded-3"
     style="background:#fffbeb;border:1.5px solid #fcd34d">
    <i class="bi bi-box-arrow-in-down-right fs-4" style="color:#d97706"></i>
    <div>
        <div class="fw-semibold" style="color:#92400e;font-size:.9rem">Mode Pengembalian Barang</div>
        <div style="color:#a16207;font-size:.78rem">
            Menampilkan semua barang yang sedang dipinjam &amp; terlambat.
            Klik tombol <strong>Proses Kembali</strong> untuk mencatat pengembalian.
        </div>
    </div>
    <a href="{{ route('petugas.pinjaman.index') }}" class="btn btn-sm ms-auto"
       style="background:#fff;border:1px solid #fcd34d;color:#92400e">
        <i class="bi bi-x me-1"></i>Lihat Semua
    </a>
</div>
@endif

{{-- Filter --}}
<div class="card mb-3">
    <div class="card-body py-3">
        <form method="GET" class="row g-2 align-items-end">
            <div class="col-sm-5">
                <input type="text" name="search" class="form-control form-control-sm"
                    placeholder="Cari kode pinjaman atau nama peminjam..."
                    value="{{ request('search') }}">
            </div>
            <div class="col-sm-3">
                <select name="status" class="form-select form-select-sm">
                    <option value="">Semua Status</option>
                    <option value="Dipinjam"     {{ request('status') === 'Dipinjam'     ? 'selected' : '' }}>Belum Dikembalikan</option>
                    <option value="Dikembalikan" {{ request('status') === 'Dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
                    <option value="Terlambat"    {{ request('status') === 'Terlambat'    ? 'selected' : '' }}>Terlambat</option>
                </select>
            </div>
            <div class="col-sm-2">
                <button type="submit" class="btn btn-primary btn-sm w-100">
                    <i class="bi bi-search me-1"></i> Filter
                </button>
            </div>
            <div class="col-sm-2">
                <a href="{{ route('petugas.pinjaman.create') }}"
                   class="btn btn-success btn-sm w-100 fw-semibold">
                    <i class="bi bi-plus-lg me-1"></i> Tambah
                </a>
            </div>
        </form>
    </div>
</div>

{{-- Tabel --}}
<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <span>
            <i class="bi bi-{{ $modePengembalian ? 'box-arrow-in-down-right' : 'list-ul' }} me-2 text-primary"></i>
            {{ $modePengembalian ? 'Barang Belum Dikembalikan' : 'Semua Data Peminjaman' }}
        </span>
        <span class="badge bg-secondary">{{ $pinjamans->total() }} record</span>
    </div>
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Kode Pinjam</th>
                    <th>Peminjam</th>
                    <th>Barang</th>
                    <th>Jml</th>
                    <th>Tgl Pinjam</th>
                    <th>Deadline</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pinjamans as $p)
                @php
                    $rowClass = '';
                    if ($p->status === 'Terlambat') $rowClass = 'table-danger';
                    elseif ($p->status === 'Dikembalikan') $rowClass = 'table-success bg-opacity-25';
                @endphp
                <tr class="{{ $rowClass }}">
                    <td>{{ $loop->iteration + ($pinjamans->currentPage() - 1) * $pinjamans->perPage() }}</td>
                    <td><code>{{ $p->kode_pinjam }}</code></td>
                    <td>
                        <div class="fw-semibold" style="font-size:.85rem">{{ $p->nama_peminjam }}</div>
                        <small class="text-muted">{{ $p->jenis_peminjam }}</small>
                    </td>
                    <td style="font-size:.85rem">{{ Str::limit($p->barang->nama_barang, 28) }}</td>
                    <td class="text-center fw-semibold">{{ $p->jumlah }}</td>
                    <td style="font-size:.82rem">{{ $p->tanggal_pinjam->format('d/m/Y') }}</td>
                    <td style="font-size:.82rem"
                        class="{{ $p->status === 'Terlambat' ? 'fw-bold text-danger' : '' }}">
                        {{ $p->tanggal_kembali_rencana->format('d/m/Y') }}
                        @if($p->status === 'Terlambat')
                            <br><small>{{ $p->tanggal_kembali_rencana->diffForHumans() }}</small>
                        @endif
                    </td>
                    <td>
                        <span class="badge bg-{{ $p->status_badge }}">{{ $p->status }}</span>
                    </td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="{{ route('petugas.pinjaman.show', $p) }}"
                               class="btn btn-sm btn-outline-primary"
                               title="Detail">
                                <i class="bi bi-eye"></i>
                            </a>
                            @if($p->status !== 'Dikembalikan')
                            <a href="{{ route('petugas.pinjaman.kembali', $p) }}"
                               class="btn btn-sm {{ $p->status === 'Terlambat' ? 'btn-danger' : 'btn-success' }} fw-semibold"
                               title="Proses Pengembalian">
                                <i class="bi bi-box-arrow-in-down me-1"></i>
                                Kembali
                            </a>
                            @else
                            <span class="btn btn-sm btn-outline-secondary disabled">
                                <i class="bi bi-check2-circle me-1"></i>Selesai
                            </span>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="text-center py-5 text-muted">
                        <i class="bi bi-inbox fs-2 d-block mb-2 opacity-50"></i>
                        {{ $modePengembalian ? 'Tidak ada barang yang perlu dikembalikan.' : 'Belum ada data peminjaman.' }}
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($pinjamans->hasPages())
    <div class="card-footer">
        {{ $pinjamans->appends(request()->query())->links() }}
    </div>
    @endif
</div>
@endsection
