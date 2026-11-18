@extends('layouts.app')
@section('title', 'Laporan Kondisi Barang')
@section('page-title', 'Laporan Kondisi Barang')

@section('content')
<!-- Filter -->
<div class="card shadow-sm mb-3">
    <div class="card-body py-3">
        <form method="GET" class="row g-2 align-items-end">
            <div class="col-sm-3">
                <label class="form-label small fw-semibold">Kondisi</label>
                <select name="kondisi" class="form-select form-select-sm">
                    <option value="">Semua Kondisi</option>
                    @foreach(['Baik','Rusak Ringan','Rusak Berat'] as $k)
                        <option value="{{ $k }}" {{ request('kondisi') == $k ? 'selected' : '' }}>{{ $k }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-3">
                <label class="form-label small fw-semibold">Ruangan</label>
                <select name="ruangan_id" class="form-select form-select-sm">
                    <option value="">Semua Ruangan</option>
                    @foreach($ruangans as $r)
                        <option value="{{ $r->id }}" {{ request('ruangan_id') == $r->id ? 'selected' : '' }}>
                            {{ $r->nama_ruangan }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-3">
                <label class="form-label small fw-semibold">Kategori</label>
                <select name="kategori_id" class="form-select form-select-sm">
                    <option value="">Semua Kategori</option>
                    @foreach($kategoris as $k)
                        <option value="{{ $k->id }}" {{ request('kategori_id') == $k->id ? 'selected' : '' }}>
                            {{ $k->nama_kategori }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-3 d-flex gap-2">
                <button type="submit" class="btn btn-primary btn-sm flex-fill">
                    <i class="bi bi-search me-1"></i>Filter
                </button>
                <a href="{{ route('admin.laporan.kondisi-barang.pdf', request()->all()) }}"
                    class="btn btn-danger btn-sm flex-fill" target="_blank">
                    <i class="bi bi-file-pdf me-1"></i>PDF
                </a>
            </div>
        </form>
    </div>
</div>

<!-- Summary -->
<div class="row g-3 mb-3">
    @foreach([['Total','secondary',$summary['total']],['Baik','success',$summary['baik']],['Rusak Ringan','warning',$summary['rusak_ringan']],['Rusak Berat','danger',$summary['rusak_berat']]] as [$label,$color,$val])
    <div class="col-sm-3">
        <div class="card border-{{ $color }} shadow-sm text-center py-3">
            <div class="fs-2 fw-bold text-{{ $color }}">{{ $val }}</div>
            <small class="text-muted">{{ $label }}</small>
        </div>
    </div>
    @endforeach
</div>

<!-- Table -->
<div class="card shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <span class="fw-semibold"><i class="bi bi-table me-2 text-primary"></i>Data Kondisi Barang</span>
        <small class="text-muted">{{ $barangs->count() }} barang ditemukan</small>
    </div>
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Kode</th>
                    <th>Nama Barang</th>
                    <th>Kategori</th>
                    <th>Ruangan</th>
                    <th>Stok Total</th>
                    <th>Stok Tersedia</th>
                    <th>Kondisi</th>
                    <th>Merk</th>
                    <th>Tahun</th>
                </tr>
            </thead>
            <tbody>
                @forelse($barangs as $i => $b)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td><code class="small">{{ $b->kode_barang }}</code></td>
                    <td class="fw-semibold">{{ $b->nama_barang }}</td>
                    <td>{{ $b->kategori->nama_kategori }}</td>
                    <td>{{ $b->ruangan->nama_ruangan }}</td>
                    <td>{{ $b->stok_total }}</td>
                    <td><span class="fw-semibold text-primary">{{ $b->stok_tersedia }}</span></td>
                    <td><span class="badge bg-{{ $b->kondisi_badge }}">{{ $b->kondisi }}</span></td>
                    <td>{{ $b->merk ?? '-' }}</td>
                    <td>{{ $b->tahun_pengadaan ?? '-' }}</td>
                </tr>
                @empty
                <tr><td colspan="10" class="text-center text-muted py-4">Tidak ada data</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
