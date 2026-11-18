<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Status Peminjaman – SMK Bakti Nusantara 666</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        :root {
            --primary: #1e3a5f;
            --primary-dark: #112237;
            --accent: #f59e0b;
            --bg: #f8fafc;
        }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--bg);
            color: #0f172a;
        }
        .top-nav {
            background: var(--primary);
            padding: 0.85rem 2rem;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        }
        .brand-icon {
            width: 38px;
            height: 38px;
            border-radius: 9px;
            background: var(--accent);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-dark);
            font-size: 1.1rem;
            font-weight: bold;
        }
    </style>
</head>
<body>
<nav class="top-nav d-flex align-items-center justify-content-between">
    <a href="{{ route('home') }}" class="d-flex align-items-center gap-2 text-decoration-none">
        <div class="brand-icon">
            <i class="bi bi-box-seam-fill"></i>
        </div>
        <div>
            <div class="text-white fw-bold fs-6">SMK Bakti Nusantara 666</div>
            <div class="text-white-50 small" style="font-size:0.7rem;">Sistem Peminjaman Inventaris</div>
        </div>
    </a>
    <a href="{{ route('home') }}" class="btn btn-sm btn-outline-light">
        <i class="bi bi-arrow-left me-1"></i> Kembali ke Beranda
    </a>
</nav>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-1 text-dark">
                        <i class="bi bi-search me-2 text-primary"></i>Lacak Status Peminjaman
                    </h5>
                    <p class="text-muted small mb-3">Masukkan kode tiket peminjaman unik yang Anda peroleh saat pengajuan.</p>

                    <form action="{{ route('cek-status') }}" method="GET">
                        <div class="input-group">
                            <span class="input-group-text bg-light text-muted border-end-0">
                                <i class="bi bi-ticket-perforated"></i>
                            </span>
                            <input type="text" name="kode_pinjam" class="form-control border-start-0 text-uppercase fw-semibold @error('kode_pinjam') is-invalid @enderror"
                                placeholder="Contoh: PJM-00001"
                                value="{{ request('kode_pinjam') }}"
                                required>
                            <button class="btn btn-primary px-4 fw-semibold" type="submit">Cari Tiket</button>
                        </div>
                        @error('kode_pinjam') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </form>
                </div>
            </div>

            @if(request()->filled('kode_pinjam'))
                @if($pinjaman)
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
                        <div>
                            <span class="text-muted small d-block">Kode Tiket</span>
                            <strong class="fs-5 font-monospace text-primary">{{ $pinjaman->kode_pinjam }}</strong>
                        </div>
                        <span class="badge bg-{{ $pinjaman->status_badge }} fs-6 px-3 py-2">
                            {{ $pinjaman->status }}
                        </span>
                    </div>
                    <div class="card-body p-4">
                        <table class="table table-sm table-borderless mb-0">
                            <tr>
                                <td class="text-muted" style="width:40%">Nama Peminjam</td>
                                <td><strong>{{ $pinjaman->nama_peminjam }}</strong> ({{ $pinjaman->jenis_peminjam }})</td>
                            </tr>
                            <tr>
                                <td class="text-muted">NIS / NIP</td>
                                <td>{{ $pinjaman->no_identitas ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Barang</td>
                                <td><strong>{{ $pinjaman->barang->nama_barang }}</strong></td>
                            </tr>
                            <tr>
                                <td class="text-muted">Lokasi Ruangan</td>
                                <td>{{ $pinjaman->barang->ruangan->nama_ruangan }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Jumlah Dipinjam</td>
                                <td><span class="badge bg-light text-dark border">{{ $pinjaman->jumlah }} unit</span></td>
                            </tr>
                            <tr>
                                <td class="text-muted">Tanggal Pinjam</td>
                                <td>{{ $pinjaman->tanggal_pinjam->isoFormat('D MMMM Y') }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Batas Pengembalian</td>
                                <td class="fw-bold {{ $pinjaman->status === 'Terlambat' ? 'text-danger' : 'text-primary' }}">
                                    {{ $pinjaman->tanggal_kembali_rencana->isoFormat('D MMMM Y') }}
                                </td>
                            </tr>
                            @if($pinjaman->tanggal_kembali_aktual)
                            <tr>
                                <td class="text-muted">Tanggal Dikembalikan</td>
                                <td class="text-success fw-semibold">{{ $pinjaman->tanggal_kembali_aktual->isoFormat('D MMMM Y') }}</td>
                            </tr>
                            @endif
                            @if($pinjaman->keperluan)
                            <tr>
                                <td class="text-muted">Keperluan</td>
                                <td>{{ $pinjaman->keperluan }}</td>
                            </tr>
                            @endif
                        </table>

                        @if($pinjaman->status === 'Terlambat')
                        <div class="alert alert-danger mt-3 mb-0 py-2 d-flex align-items-center gap-2 rounded-3">
                            <i class="bi bi-exclamation-triangle-fill fs-5"></i>
                            <div>Peminjaman ini telah <strong>melewati batas waktu</strong>! Segera serahkan barang ke petugas inventaris.</div>
                        </div>
                        @endif
                    </div>
                </div>
                @else
                <div class="alert alert-warning border-0 shadow-sm p-4 rounded-4 d-flex align-items-center gap-3" style="background:#fffbeb;color:#92400e;">
                    <i class="bi bi-search fs-2"></i>
                    <div>
                        <h6 class="fw-bold mb-1">Tiket Tidak Ditemukan</h6>
                        <p class="small mb-0">Kode peminjaman <strong>"{{ request('kode_pinjam') }}"</strong> tidak terdaftar dalam basis data sistem inventaris sekolah.</p>
                    </div>
                </div>
                @endif
            @endif
        </div>
    </div>
</div>
</body>
</html>
