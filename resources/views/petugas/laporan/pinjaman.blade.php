@extends('layouts.app')
@section('title', 'Laporan Pinjaman')
@section('page-title', 'Laporan Peminjaman')

@section('content')
<div class="card shadow-sm mb-3">
    <div class="card-body py-3">
        <form method="GET" class="row g-2 align-items-end">
            <div class="col-sm-3">
                <label class="form-label small fw-semibold">Status</label>
                <select name="status" class="form-select form-select-sm">
                    <option value="">Semua Status</option>
                    @foreach(['Dipinjam','Dikembalikan','Terlambat'] as $s)
                        <option value="{{ $s }}" {{ request('status') == $s ? 'selected' : '' }}>{{ $s }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-3">
                <label class="form-label small fw-semibold">Dari Tanggal</label>
                <input type="date" name="tgl_dari" class="form-control form-control-sm" value="{{ request('tgl_dari') }}">
            </div>
            <div class="col-sm-3">
                <label class="form-label small fw-semibold">Sampai Tanggal</label>
                <input type="date" name="tgl_sampai" class="form-control form-control-sm" value="{{ request('tgl_sampai') }}">
            </div>
            <div class="col-sm-3 d-flex gap-2">
                <button type="submit" class="btn btn-primary btn-sm flex-fill">
                    <i class="bi bi-search me-1"></i>Filter
                </button>
                <a href="{{ route('petugas.laporan.pdf', request()->all()) }}"
                    class="btn btn-danger btn-sm flex-fill" target="_blank">
                    <i class="bi bi-file-pdf me-1"></i>PDF
                </a>
            </div>
        </form>
    </div>
</div>

<div class="row g-3 mb-3">
    @foreach([['Total','secondary',$summary['total']],['Dipinjam','warning',$summary['dipinjam']],['Dikembalikan','success',$summary['dikembalikan']],['Terlambat','danger',$summary['terlambat']]] as [$label,$color,$val])
    <div class="col-sm-3">
        <div class="card border-{{ $color }} shadow-sm text-center py-3">
            <div class="fs-2 fw-bold text-{{ $color }}">{{ $val }}</div>
            <small class="text-muted">{{ $label }}</small>
        </div>
    </div>
    @endforeach
</div>

<div class="card shadow-sm">
    <div class="card-header bg-white fw-semibold">
        <i class="bi bi-table me-2 text-primary"></i>Data Peminjaman ({{ $pinjamans->count() }} record)
    </div>
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>#</th><th>Kode</th><th>Peminjam</th><th>Jenis</th>
                    <th>Barang</th><th>Jml</th><th>Tgl Pinjam</th>
                    <th>Deadline</th><th>Tgl Kembali</th><th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pinjamans as $i => $p)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td><code class="small">{{ $p->kode_pinjam }}</code></td>
                    <td>{{ $p->nama_peminjam }}</td>
                    <td>{{ $p->jenis_peminjam }}</td>
                    <td>{{ Str::limit($p->barang->nama_barang, 25) }}</td>
                    <td>{{ $p->jumlah }}</td>
                    <td>{{ $p->tanggal_pinjam->format('d/m/Y') }}</td>
                    <td>{{ $p->tanggal_kembali_rencana->format('d/m/Y') }}</td>
                    <td>{{ $p->tanggal_kembali_aktual ? $p->tanggal_kembali_aktual->format('d/m/Y') : '-' }}</td>
                    <td><span class="badge bg-{{ $p->status_badge }}">{{ $p->status }}</span></td>
                </tr>
                @empty
                <tr><td colspan="10" class="text-center text-muted py-4">Tidak ada data</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
