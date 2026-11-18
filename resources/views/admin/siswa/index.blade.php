@extends('layouts.app')
@section('title', 'Data Siswa')
@section('page-title', 'Data Siswa')

@section('content')

{{-- Header Banner & Tombol Tambah --}}
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div>
        <h4 class="fw-bold mb-1 text-dark">
            <i class="bi bi-mortarboard-fill text-primary me-2"></i>Data Siswa
        </h4>
        <p class="text-muted small mb-0">
            Kelola data induk siswa SMK Bakti Nusantara 666 (Kelas X, XI, dan XII).
        </p>
    </div>
    <div class="d-flex align-items-center gap-2">
        <a href="{{ route('admin.siswa.create') }}" class="btn btn-primary btn-sm px-3 shadow-sm">
            <i class="bi bi-plus-lg me-1"></i> Tambah Siswa
        </a>
    </div>
</div>

{{-- Statistik Ringkasan --}}
<div class="row g-3 mb-4">
    <div class="col-6 col-md-4 col-xl-2">
        <div class="card border-0 shadow-sm h-100 rounded-3">
            <div class="card-body p-3 d-flex align-items-center">
                <div class="rounded-3 p-2 bg-primary bg-opacity-10 text-primary me-3 d-flex align-items-center justify-content-center" style="width:44px;height:44px;">
                    <i class="bi bi-people-fill fs-5"></i>
                </div>
                <div>
                    <div class="fs-4 fw-bold text-dark lh-1 mb-1">{{ number_format($stats['total']) }}</div>
                    <small class="text-muted text-uppercase fw-semibold" style="font-size: 0.68rem; letter-spacing: 0.5px;">Total Siswa</small>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-4 col-xl-2">
        <div class="card border-0 shadow-sm h-100 rounded-3">
            <div class="card-body p-3 d-flex align-items-center">
                <div class="rounded-3 p-2 bg-info bg-opacity-10 text-info me-3 d-flex align-items-center justify-content-center" style="width:44px;height:44px;">
                    <i class="bi bi-gender-male fs-5"></i>
                </div>
                <div>
                    <div class="fs-4 fw-bold text-info lh-1 mb-1">{{ number_format($stats['laki']) }}</div>
                    <small class="text-muted text-uppercase fw-semibold" style="font-size: 0.68rem; letter-spacing: 0.5px;">Laki-laki</small>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-4 col-xl-2">
        <div class="card border-0 shadow-sm h-100 rounded-3">
            <div class="card-body p-3 d-flex align-items-center">
                <div class="rounded-3 p-2 bg-warning bg-opacity-10 text-warning me-3 d-flex align-items-center justify-content-center" style="width:44px;height:44px;">
                    <i class="bi bi-gender-female fs-5"></i>
                </div>
                <div>
                    <div class="fs-4 fw-bold text-warning lh-1 mb-1">{{ number_format($stats['perempuan']) }}</div>
                    <small class="text-muted text-uppercase fw-semibold" style="font-size: 0.68rem; letter-spacing: 0.5px;">Perempuan</small>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-4 col-xl-2">
        <div class="card border-0 shadow-sm h-100 rounded-3 border-start border-primary border-3">
            <div class="card-body p-3">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <span class="badge bg-primary bg-opacity-10 text-primary fw-bold">Kelas X</span>
                    <i class="bi bi-mortarboard text-muted"></i>
                </div>
                <div class="fs-4 fw-bold text-primary lh-1">{{ number_format($stats['kelas_x']) }}</div>
                <small class="text-muted" style="font-size: 0.72rem;">siswa terdaftar</small>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-4 col-xl-2">
        <div class="card border-0 shadow-sm h-100 rounded-3 border-start border-success border-3">
            <div class="card-body p-3">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <span class="badge bg-success bg-opacity-10 text-success fw-bold">Kelas XI</span>
                    <i class="bi bi-mortarboard text-muted"></i>
                </div>
                <div class="fs-4 fw-bold text-success lh-1">{{ number_format($stats['kelas_xi']) }}</div>
                <small class="text-muted" style="font-size: 0.72rem;">siswa terdaftar</small>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-4 col-xl-2">
        <div class="card border-0 shadow-sm h-100 rounded-3 border-start border-warning border-3">
            <div class="card-body p-3">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <span class="badge bg-warning bg-opacity-10 text-warning fw-bold">Kelas XII</span>
                    <i class="bi bi-mortarboard text-muted"></i>
                </div>
                <div class="fs-4 fw-bold text-warning lh-1">{{ number_format($stats['kelas_xii']) }}</div>
                <small class="text-muted" style="font-size: 0.72rem;">siswa terdaftar</small>
            </div>
        </div>
    </div>
</div>

{{-- Filter & Pencarian Card --}}
<div class="card border-0 shadow-sm mb-4 rounded-3">
    <div class="card-body p-3 p-md-4">
        <form method="GET" action="{{ route('admin.siswa.index') }}" id="filterForm">
            <div class="row g-2 align-items-end">
                {{-- Search --}}
                <div class="col-md-3">
                    <label class="form-label small fw-semibold text-muted mb-1">Cari Data</label>
                    <div class="input-group input-group-sm">
                        <span class="input-group-text bg-light border-end-0 text-muted">
                            <i class="bi bi-search"></i>
                        </span>
                        <input type="text" name="search" class="form-control border-start-0 ps-0"
                            placeholder="Nama / NIS / Wali Kelas..." value="{{ request('search') }}">
                    </div>
                </div>

                {{-- Tingkat --}}
                <div class="col-6 col-md-2">
                    <label class="form-label small fw-semibold text-muted mb-1">Tingkat</label>
                    <select name="tingkat" class="form-select form-select-sm" onchange="this.form.submit()">
                        <option value="">Semua Tingkat</option>
                        @foreach(['X','XI','XII'] as $t)
                            <option value="{{ $t }}" {{ request('tingkat') == $t ? 'selected' : '' }}>Kelas {{ $t }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Jurusan --}}
                <div class="col-6 col-md-3">
                    <label class="form-label small fw-semibold text-muted mb-1">Jurusan</label>
                    <select name="jurusan" class="form-select form-select-sm" onchange="this.form.submit()">
                        <option value="">Semua Jurusan</option>
                        @foreach($jurusanList as $j)
                            <option value="{{ $j }}" {{ request('jurusan') == $j ? 'selected' : '' }}>{{ $j }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Kelas --}}
                <div class="col-6 col-md-2">
                    <label class="form-label small fw-semibold text-muted mb-1">Kelas</label>
                    <select name="kelas" class="form-select form-select-sm" onchange="this.form.submit()">
                        <option value="">Semua Kelas</option>
                        @foreach($kelasList as $k)
                            <option value="{{ $k }}" {{ request('kelas') == $k ? 'selected' : '' }}>{{ $k }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Jenis Kelamin --}}
                <div class="col-6 col-md-2">
                    <label class="form-label small fw-semibold text-muted mb-1">Gender</label>
                    <select name="jenis_kelamin" class="form-select form-select-sm" onchange="this.form.submit()">
                        <option value="">Semua</option>
                        <option value="L" {{ request('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ request('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>

                {{-- Filter Action Buttons & Per Page --}}
                <div class="col-12 d-flex flex-wrap justify-content-between align-items-center gap-2 pt-2 border-top mt-2">
                    <div class="d-flex align-items-center gap-2">
                        <button type="submit" class="btn btn-primary btn-sm px-3">
                            <i class="bi bi-funnel me-1"></i> Terapkan Filter
                        </button>
                        @if(request()->hasAny(['search', 'tingkat', 'jurusan', 'kelas', 'jenis_kelamin', 'sort']))
                            <a href="{{ route('admin.siswa.index') }}" class="btn btn-outline-secondary btn-sm">
                                <i class="bi bi-arrow-counterclockwise me-1"></i> Reset
                            </a>
                        @endif
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <small class="text-muted">Tampilkan:</small>
                        <select name="per_page" class="form-select form-select-sm w-auto" onchange="this.form.submit()">
                            @foreach([10, 20, 50, 100] as $size)
                                <option value="{{ $size }}" {{ request('per_page', 20) == $size ? 'selected' : '' }}>{{ $size }} per hal</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            {{-- Hidden sort parameters to maintain on filter submit --}}
            <input type="hidden" name="sort" value="{{ request('sort', 'kelas') }}">
            <input type="hidden" name="direction" value="{{ request('direction', 'asc') }}">
        </form>
    </div>
</div>

{{-- Tabel Data Siswa --}}
<div class="card border-0 shadow-sm rounded-3 overflow-hidden">
    <div class="card-header bg-white py-3 d-flex flex-wrap justify-content-between align-items-center gap-2 border-bottom">
        <div class="d-flex align-items-center gap-2">
            <span class="fw-bold text-dark"><i class="bi bi-table me-2 text-primary"></i>Daftar Siswa Terdaftar</span>
            <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-2 py-1">
                {{ number_format($siswas->total()) }} Siswa
            </span>
        </div>
        <small class="text-muted">
            Menampilkan data <strong>{{ $siswas->firstItem() ?? 0 }}</strong> - <strong>{{ $siswas->lastItem() ?? 0 }}</strong> dari total <strong>{{ number_format($siswas->total()) }}</strong> siswa
        </small>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light text-muted small text-uppercase" style="font-size: 0.72rem; letter-spacing: 0.5px;">
                <tr>
                    <th class="ps-3" style="width: 50px;">#</th>
                    <th style="min-width: 140px;">
                        <a href="{{ request()->fullUrlWithQuery(['sort' => 'nis', 'direction' => request('sort') == 'nis' && request('direction') == 'asc' ? 'desc' : 'asc']) }}" class="text-decoration-none text-muted d-inline-flex align-items-center gap-1">
                            NIS
                            @if(request('sort') == 'nis')
                                <i class="bi bi-sort-{{ request('direction') == 'desc' ? 'down' : 'up' }}-alt text-primary"></i>
                            @else
                                <i class="bi bi-arrow-down-up text-muted opacity-50"></i>
                            @endif
                        </a>
                    </th>
                    <th style="min-width: 240px;">
                        <a href="{{ request()->fullUrlWithQuery(['sort' => 'nama_lengkap', 'direction' => request('sort') == 'nama_lengkap' && request('direction') == 'asc' ? 'desc' : 'asc']) }}" class="text-decoration-none text-muted d-inline-flex align-items-center gap-1">
                            Nama Lengkap
                            @if(request('sort') == 'nama_lengkap')
                                <i class="bi bi-sort-{{ request('direction') == 'desc' ? 'alpha-down-alt' : 'alpha-down' }} text-primary"></i>
                            @else
                                <i class="bi bi-arrow-down-up text-muted opacity-50"></i>
                            @endif
                        </a>
                    </th>
                    <th style="width: 110px;">JK</th>
                    <th style="min-width: 120px;">
                        <a href="{{ request()->fullUrlWithQuery(['sort' => 'kelas', 'direction' => request('sort') == 'kelas' && request('direction') == 'asc' ? 'desc' : 'asc']) }}" class="text-decoration-none text-muted d-inline-flex align-items-center gap-1">
                            Kelas
                            @if(request('sort') == 'kelas' || !request('sort'))
                                <i class="bi bi-sort-{{ request('direction') == 'desc' ? 'down' : 'up' }}-alt text-primary"></i>
                            @else
                                <i class="bi bi-arrow-down-up text-muted opacity-50"></i>
                            @endif
                        </a>
                    </th>
                    <th style="min-width: 200px;">Jurusan</th>
                    <th style="min-width: 200px;">Wali Kelas</th>
                    <th class="text-end pe-3" style="width: 100px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($siswas as $s)
                <tr>
                    <td class="ps-3 text-muted small">
                        {{ $loop->iteration + ($siswas->currentPage() - 1) * $siswas->perPage() }}
                    </td>
                    <td>
                        <span class="badge bg-light text-dark border font-monospace px-2 py-1" style="font-size: 0.8rem; letter-spacing: 0.5px;">
                            {{ $s->nis }}
                        </span>
                    </td>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <div class="rounded-circle d-flex align-items-center justify-content-center text-white fw-semibold flex-shrink-0"
                                style="width: 32px; height: 32px; font-size: 0.72rem; background: {{ $s->jenis_kelamin === 'L' ? '#1e3a5f' : '#f59e0b' }};">
                                {{ $s->initials }}
                            </div>
                            <div>
                                <span class="fw-semibold text-dark d-block">{{ $s->nama_lengkap }}</span>
                            </div>
                        </div>
                    </td>
                    <td>
                        @if($s->jenis_kelamin === 'L')
                            <span class="badge bg-info bg-opacity-10 text-info border border-info border-opacity-25 px-2 py-1">
                                <i class="bi bi-gender-male me-1"></i>L
                            </span>
                        @else
                            <span class="badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25 px-2 py-1">
                                <i class="bi bi-gender-female me-1"></i>P
                            </span>
                        @endif
                    </td>
                    <td>
                        @php
                            $badgeClass = match($s->tingkat) {
                                'X' => 'bg-primary text-primary',
                                'XI' => 'bg-success text-success',
                                'XII' => 'bg-warning text-warning',
                                default => 'bg-secondary text-secondary',
                            };
                        @endphp
                        <span class="badge {{ $badgeClass }} bg-opacity-10 border border-opacity-25 px-2 py-1 fw-bold">
                            {{ $s->kelas }}
                        </span>
                    </td>
                    <td>
                        <span class="text-muted small d-block">{{ $s->jurusan }}</span>
                    </td>
                    <td>
                        @if($s->wali_kelas)
                            <div class="d-flex align-items-center text-muted small">
                                <i class="bi bi-person-badge me-1 text-primary"></i>
                                <span>{{ $s->wali_kelas }}</span>
                            </div>
                        @else
                            <span class="text-muted small">-</span>
                        @endif
                    </td>
                    <td class="text-end pe-3">
                        <div class="d-inline-flex gap-1">
                            <a href="{{ route('admin.siswa.edit', $s) }}" class="btn btn-sm btn-outline-warning" title="Edit Data Siswa">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.siswa.destroy', $s) }}" method="POST"
                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus data siswa {{ addslashes($s->nama_lengkap) }}?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus Siswa">
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
                            <i class="bi bi-person-x fs-1 d-block mb-2 text-secondary opacity-50"></i>
                            <h6 class="fw-semibold">Tidak Ada Data Siswa</h6>
                            <p class="small mb-3">Tidak ditemukan data siswa yang cocok dengan filter atau kata kunci yang dipilih.</p>
                            @if(request()->hasAny(['search', 'tingkat', 'jurusan', 'kelas', 'jenis_kelamin']))
                                <a href="{{ route('admin.siswa.index') }}" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-arrow-counterclockwise me-1"></i> Reset Filter
                                </a>
                            @else
                                <a href="{{ route('admin.siswa.create') }}" class="btn btn-sm btn-primary">
                                    <i class="bi bi-plus-lg me-1"></i> Tambah Siswa Pertama
                                </a>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($siswas->hasPages())
    <div class="card-footer bg-white py-3 border-top d-flex flex-column flex-md-row justify-content-between align-items-center gap-2">
        <small class="text-muted">
            Menampilkan data <strong>{{ $siswas->firstItem() }}</strong> sampai <strong>{{ $siswas->lastItem() }}</strong> dari total <strong>{{ number_format($siswas->total()) }}</strong> data
        </small>
        <div>
            {{ $siswas->links() }}
        </div>
    </div>
    @endif
</div>
@endsection
