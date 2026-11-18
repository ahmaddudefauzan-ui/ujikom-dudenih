<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda Peminjaman Barang – SMK Bakti Nusantara 666</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        :root {
            --primary: #1e3a5f;
            --primary-dark: #112237;
            --primary-light: #2563eb;
            --accent: #f59e0b;
            --accent-hover: #d97706;
            --surface: #ffffff;
            --bg: #f8fafc;
            --text-main: #0f172a;
            --text-muted: #64748b;
            --border: #e2e8f0;
            --radius-lg: 16px;
            --radius-md: 12px;
        }

        * { box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg);
            color: var(--text-main);
            margin: 0;
            line-height: 1.6;
        }

        /* ── Navbar ── */
        .navbar-main {
            background: rgba(30, 58, 95, 0.95);
            backdrop-filter: blur(10px);
            padding: 0.85rem 0;
            position: sticky;
            top: 0;
            z-index: 1000;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }
        .navbar-brand-custom {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            text-decoration: none;
        }
        .brand-icon {
            width: 42px;
            height: 42px;
            border-radius: 10px;
            background: var(--accent);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-dark);
            font-size: 1.25rem;
            font-weight: bold;
            box-shadow: 0 4px 12px rgba(245, 158, 11, 0.35);
        }
        .brand-title {
            color: #ffffff;
            font-size: 0.95rem;
            font-weight: 800;
            line-height: 1.2;
            letter-spacing: -0.2px;
        }
        .brand-subtitle {
            color: rgba(255, 255, 255, 0.65);
            font-size: 0.72rem;
            display: block;
        }
        .nav-link-custom {
            color: rgba(255, 255, 255, 0.82);
            font-size: 0.85rem;
            font-weight: 600;
            padding: 0.45rem 0.9rem;
            border-radius: 8px;
            text-decoration: none;
            transition: all 0.2s ease;
        }
        .nav-link-custom:hover {
            color: #ffffff;
            background: rgba(255, 255, 255, 0.1);
        }

        /* ── Hero Section ── */
        .hero-section {
            background: radial-gradient(circle at 80% 20%, rgba(37, 99, 235, 0.35) 0%, transparent 50%),
                        linear-gradient(135deg, var(--primary) 0%, #152b47 100%);
            padding: 4.5rem 0 5.5rem;
            color: #ffffff;
            position: relative;
            overflow: hidden;
        }
        .hero-section::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image: radial-gradient(rgba(255, 255, 255, 0.08) 1px, transparent 1px);
            background-size: 24px 24px;
            opacity: 0.6;
        }
        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(255, 255, 255, 0.12);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 50px;
            padding: 0.35rem 1rem;
            font-size: 0.78rem;
            font-weight: 600;
            color: var(--accent);
            margin-bottom: 1.25rem;
        }
        .hero-title {
            font-size: 2.6rem;
            font-weight: 800;
            line-height: 1.2;
            letter-spacing: -0.5px;
            margin-bottom: 1.25rem;
        }
        .hero-title span {
            background: linear-gradient(120deg, #fcd34d, #f59e0b);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .hero-desc {
            font-size: 1.05rem;
            color: rgba(255, 255, 255, 0.85);
            max-width: 620px;
            margin-bottom: 2rem;
            font-weight: 400;
        }
        .btn-cta-primary {
            background: var(--accent);
            color: var(--primary-dark);
            font-weight: 700;
            font-size: 0.92rem;
            padding: 0.75rem 1.6rem;
            border-radius: 10px;
            border: none;
            box-shadow: 0 4px 15px rgba(245, 158, 11, 0.35);
            transition: all 0.2s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        .btn-cta-primary:hover {
            background: var(--accent-hover);
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(245, 158, 11, 0.45);
        }
        .btn-cta-outline {
            background: rgba(255, 255, 255, 0.1);
            color: #ffffff;
            font-weight: 600;
            font-size: 0.92rem;
            padding: 0.75rem 1.4rem;
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.25);
            transition: all 0.2s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        .btn-cta-outline:hover {
            background: rgba(255, 255, 255, 0.2);
            color: #ffffff;
            border-color: rgba(255, 255, 255, 0.4);
            transform: translateY(-2px);
        }

        /* ── Metric Cards in Hero ── */
        .stat-card-hero {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: var(--radius-md);
            padding: 1rem 1.25rem;
            text-align: center;
            transition: all 0.2s ease;
        }
        .stat-card-hero:hover {
            background: rgba(255, 255, 255, 0.14);
            transform: translateY(-3px);
        }
        .stat-number {
            font-size: 1.75rem;
            font-weight: 800;
            color: #ffffff;
            line-height: 1;
            margin-bottom: 0.3rem;
        }
        .stat-label {
            font-size: 0.72rem;
            color: rgba(255, 255, 255, 0.7);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* ── Tracker Box ── */
        .tracker-wrapper {
            margin-top: -2.5rem;
            position: relative;
            z-index: 20;
        }
        .tracker-card {
            background: #ffffff;
            border-radius: var(--radius-lg);
            box-shadow: 0 10px 40px rgba(30, 58, 95, 0.12);
            border: 1px solid var(--border);
            padding: 1.5rem 1.75rem;
        }

        /* ── Step Cards ── */
        .step-box {
            background: #ffffff;
            border: 1px solid var(--border);
            border-radius: var(--radius-md);
            padding: 1.5rem;
            height: 100%;
            transition: all 0.2s ease;
            position: relative;
        }
        .step-box:hover {
            border-color: var(--primary-light);
            box-shadow: 0 8px 25px rgba(37, 99, 235, 0.08);
            transform: translateY(-3px);
        }
        .step-number-badge {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: rgba(30, 58, 95, 0.08);
            color: var(--primary);
            font-weight: 800;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            margin-bottom: 1rem;
        }

        /* ── Catalog Item Card ── */
        .catalog-card {
            background: #ffffff;
            border: 1px solid var(--border);
            border-radius: var(--radius-md);
            transition: all 0.25s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }
        .catalog-card:hover {
            border-color: var(--primary-light);
            box-shadow: 0 10px 30px rgba(30, 58, 95, 0.1);
            transform: translateY(-4px);
        }
        .catalog-header {
            padding: 1.1rem 1.25rem 0.6rem;
        }
        .catalog-body {
            padding: 0 1.25rem 1.1rem;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .catalog-pill-kategori {
            font-size: 0.68rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 0.25rem 0.6rem;
            border-radius: 6px;
        }
        .badge-kat-perabotan {
            background: #fef3c7;
            color: #92400e;
        }
        .badge-kat-elektronik {
            background: #e0f2fe;
            color: #0369a1;
        }
        .badge-kat-alatpraktik {
            background: #dcfce7;
            color: #15803d;
        }

        /* ── Form Card ── */
        .form-section-card {
            background: #ffffff;
            border-radius: var(--radius-lg);
            border: 1px solid var(--border);
            box-shadow: 0 12px 40px rgba(30, 58, 95, 0.1);
            overflow: hidden;
        }
        .form-header-bar {
            background: var(--primary);
            color: #ffffff;
            padding: 1.25rem 1.75rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        /* ── Siswa Result Box ── */
        .siswa-picker-container {
            background: #f8fafc;
            border: 1.5px solid #e2e8f0;
            border-radius: 12px;
            padding: 1.25rem;
        }
        .siswa-item-click {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 0.5rem 0.85rem;
            margin-bottom: 0.4rem;
            cursor: pointer;
            transition: all 0.15s ease;
        }
        .siswa-item-click:hover {
            border-color: var(--primary-light);
            background: #f0f7ff;
            transform: translateX(3px);
        }

        /* ── Footer ── */
        .footer-main {
            background: var(--primary-dark);
            color: rgba(255, 255, 255, 0.75);
            padding: 3.5rem 0 1.75rem;
            margin-top: 5rem;
            font-size: 0.85rem;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
        }
        .footer-title {
            color: #ffffff;
            font-weight: 700;
            font-size: 0.95rem;
            margin-bottom: 1rem;
        }
        .footer-link {
            color: rgba(255, 255, 255, 0.65);
            text-decoration: none;
            display: block;
            margin-bottom: 0.5rem;
            transition: color 0.2s;
        }
        .footer-link:hover {
            color: #ffffff;
        }
    </style>
</head>
<body>

{{-- Navbar --}}
<nav class="navbar-main">
    <div class="container">
        <div class="d-flex align-items-center justify-content-between w-100">
            <a href="{{ route('home') }}" class="navbar-brand-custom">
                <div class="brand-icon">
                    <i class="bi bi-box-seam-fill"></i>
                </div>
                <div>
                    <span class="brand-title">SMK Bakti Nusantara 666</span>
                    <span class="brand-subtitle">Portal Peminjaman Inventaris & Alat Lab</span>
                </div>
            </a>

            <div class="d-none d-lg-flex align-items-center gap-2">
                <a href="#katalog" class="nav-link-custom">Katalog Barang</a>
                <a href="#alur" class="nav-link-custom">Alur Peminjaman</a>
                <a href="#lacak" class="nav-link-custom">Cek Status Tiket</a>
                <a href="#formulir" class="nav-link-custom">Form Pengajuan</a>
                <a href="#ketentuan" class="nav-link-custom">Ketentuan</a>
            </div>

            <div class="d-flex align-items-center gap-2">
                <a href="#formulir" class="btn btn-sm btn-cta-primary d-none d-sm-inline-flex">
                    <i class="bi bi-plus-circle-fill"></i> Pinjam Barang
                </a>
                <a href="{{ route('login') }}" class="btn btn-sm btn-cta-outline" title="Masuk sebagai Administrator atau Petugas">
                    <i class="bi bi-person-lock"></i> Login Staff
                </a>
            </div>
        </div>
    </div>
</nav>

{{-- Hero Section --}}
<section class="hero-section">
    <div class="container position-relative">
        <div class="row align-items-center g-4">
            <div class="col-lg-7">
                <div class="hero-badge">
                    <i class="bi bi-shield-check"></i> Layanan Mandiri Peminjaman Online Tanpa Login
                </div>
                <h1 class="hero-title">
                    Pinjam Peralatan Sekolah & Lab Jadi <span>Mudah, Cepat, dan Rapi</span>
                </h1>
                <p class="hero-desc">
                    Fasilitas peminjaman perlengkapan praktikum, perangkat elektronik, audio video, studio foto, hingga alat olahraga untuk seluruh siswa dan guru SMK Bakti Nusantara 666.
                </p>
                <div class="d-flex flex-wrap gap-2 pt-1 mb-4">
                    <a href="#formulir" class="btn-cta-primary">
                        <i class="bi bi-clipboard2-plus-fill"></i> Ajukan Peminjaman Sekarang
                    </a>
                    <a href="#katalog" class="btn-cta-outline">
                        <i class="bi bi-grid-3x3-gap-fill"></i> Lihat Katalog ({{ count($barangs) }} Barang)
                    </a>
                </div>
            </div>

            {{-- Stat Hero Cards --}}
            <div class="col-lg-5">
                <div class="row g-3">
                    <div class="col-6">
                        <div class="stat-card-hero">
                            <div class="stat-number">{{ number_format($stats['total_barang']) }}</div>
                            <div class="stat-label">Jenis Barang</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="stat-card-hero">
                            <div class="stat-number text-warning">{{ number_format($stats['stok_tersedia']) }}</div>
                            <div class="stat-label">Unit Tersedia</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="stat-card-hero">
                            <div class="stat-number text-info">{{ number_format($stats['total_ruangan']) }}</div>
                            <div class="stat-label">Ruangan & Lab</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="stat-card-hero">
                            <div class="stat-number text-success">3</div>
                            <div class="stat-label">Kategori Utama</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Lacak Tiket / Quick Tracker --}}
<div class="container tracker-wrapper" id="lacak">
    <div class="tracker-card">
        <div class="row align-items-center g-3">
            <div class="col-lg-4">
                <div class="d-flex align-items-center gap-3">
                    <div class="rounded-3 p-3 bg-primary bg-opacity-10 text-primary fs-3 d-flex align-items-center justify-content-center" style="width:52px;height:52px;">
                        <i class="bi bi-search"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-0 text-dark">Lacak Status Peminjaman</h6>
                        <small class="text-muted">Masukkan kode unik tiket (misal: PJM-00001)</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <form action="{{ route('home') }}#lacak" method="GET" class="row g-2">
                    <div class="col-sm-8">
                        <div class="input-group">
                            <span class="input-group-text bg-light text-muted border-end-0">
                                <i class="bi bi-ticket-perforated"></i>
                            </span>
                            <input type="text" name="kode_pinjam" class="form-control border-start-0 text-uppercase fw-semibold"
                                placeholder="Contoh: PJM-00001" value="{{ request('kode_pinjam') }}" required>
                        </div>
                    </div>
                    <div class="col-sm-4 d-flex gap-2">
                        <button type="submit" class="btn btn-primary fw-semibold flex-fill">
                            <i class="bi bi-search me-1"></i> Periksa Status
                        </button>
                        @if(request('kode_pinjam'))
                            <a href="{{ route('home') }}#lacak" class="btn btn-outline-secondary" title="Reset">
                                <i class="bi bi-x-lg"></i>
                            </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>

        {{-- Hasil Pelacakan Tiket --}}
        @if($searchPerformed)
            <div class="mt-4 pt-3 border-top">
                @if($cekPinjaman)
                    <div class="alert alert-success border-0 shadow-sm d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 p-3 rounded-3" style="background:#ecfdf5;color:#065f46;">
                        <div class="d-flex align-items-center gap-3">
                            <i class="bi bi-check-circle-fill fs-2 text-success"></i>
                            <div>
                                <div class="d-flex align-items-center gap-2 mb-1">
                                    <strong class="fs-5 text-dark font-monospace">{{ $cekPinjaman->kode_pinjam }}</strong>
                                    <span class="badge bg-{{ $cekPinjaman->status_badge }} px-2 py-1">
                                        {{ $cekPinjaman->status }}
                                    </span>
                                </div>
                                <div class="small">
                                    Peminjam: <strong>{{ $cekPinjaman->nama_peminjam }}</strong> ({{ $cekPinjaman->jenis_peminjam }}) &nbsp;•&nbsp;
                                    Barang: <strong>{{ $cekPinjaman->barang->nama_barang }}</strong> ({{ $cekPinjaman->jumlah }} unit) &nbsp;•&nbsp;
                                    Lokasi: <strong>{{ $cekPinjaman->barang->ruangan->nama_ruangan }}</strong>
                                </div>
                            </div>
                        </div>
                        <div class="text-md-end border-top border-md-top-0 pt-2 pt-md-0">
                            <small class="d-block text-muted">Batas Pengembalian:</small>
                            <span class="fw-bold fs-6 {{ $cekPinjaman->status === 'Terlambat' ? 'text-danger' : 'text-primary' }}">
                                {{ $cekPinjaman->tanggal_kembali_rencana->isoFormat('D MMMM Y') }}
                            </span>
                        </div>
                    </div>
                @else
                    <div class="alert alert-warning border-0 p-3 rounded-3 d-flex align-items-center gap-2 mb-0" style="background:#fffbeb;color:#92400e;">
                        <i class="bi bi-exclamation-triangle-fill fs-5"></i>
                        <div>
                            Tiket peminjaman dengan kode <strong>"{{ request('kode_pinjam') }}"</strong> tidak ditemukan dalam sistem. Harap pastikan format kode sudah sesuai.
                        </div>
                    </div>
                @endif
            </div>
        @endif
    </div>
</div>

{{-- Section Alur Peminjaman --}}
<section class="py-5" id="alur">
    <div class="container py-4">
        <div class="text-center max-w-700 mx-auto mb-5">
            <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 fw-bold text-uppercase mb-2">Panduan Penggunaan</span>
            <h3 class="fw-bold text-dark">Alur Peminjaman Barang yang Tertib</h3>
            <p class="text-muted small">Ikuti 4 tahapan praktis untuk mengajukan dan mengembalikan peralatan sekolah.</p>
        </div>

        <div class="row g-4">
            <div class="col-md-6 col-lg-3">
                <div class="step-box">
                    <div class="step-number-badge">1</div>
                    <h6 class="fw-bold mb-2">Pilih Barang</h6>
                    <p class="text-muted small mb-0">Cari peralatan yang dibutuhkan dari katalog inventaris (pastikan stok unit tersedia).</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="step-box">
                    <div class="step-number-badge">2</div>
                    <h6 class="fw-bold mb-2">Isi Data Peminjam</h6>
                    <p class="text-muted small mb-0">Lengkapi formulir peminjaman dengan nama, kelas/jabatan, serta tanggal rencana kembali.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="step-box">
                    <div class="step-number-badge">3</div>
                    <h6 class="fw-bold mb-2">Simpan Kode Tiket</h6>
                    <p class="text-muted small mb-0">Setelah submit, simpan kode unik <code>PJM-XXXXX</code> yang muncul di layar untuk verifikasi.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="step-box">
                    <div class="step-number-badge">4</div>
                    <h6 class="fw-bold mb-2">Ambil & Kembalikan</h6>
                    <p class="text-muted small mb-0">Tunjukkan kode tiket kepada petugas di ruangan/lab, dan kembalikan sesuai batas waktu.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Section Katalog Barang Siap Pinjam --}}
<section class="py-5 bg-white border-top border-bottom" id="katalog">
    <div class="container py-4">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end gap-3 mb-4">
            <div>
                <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 fw-bold text-uppercase mb-2">Inventaris Tersedia</span>
                <h3 class="fw-bold text-dark mb-1">Katalog Peralatan Siap Dipinjam</h3>
                <p class="text-muted small mb-0">Pilih barang langsung dari katalog untuk mengisi formulir peminjaman secara otomatis.</p>
            </div>
            <div class="w-100" style="max-width:320px;">
                <div class="input-group input-group-sm">
                    <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-funnel"></i></span>
                    <input type="text" id="liveFilterInput" class="form-control border-start-0" placeholder="Ketik nama barang / ruangan...">
                </div>
            </div>
        </div>

        {{-- Kategori Filter Tabs --}}
        <div class="d-flex flex-wrap gap-2 mb-4 pb-2">
            <button type="button" class="btn btn-sm btn-primary filter-tab active px-3" data-category="all">
                Semua Kategori ({{ count($barangs) }})
            </button>
            @foreach($kategoris as $kat)
                <button type="button" class="btn btn-sm btn-outline-secondary filter-tab px-3" data-category="{{ $kat->nama_kategori }}">
                    {{ $kat->nama_kategori }} ({{ $kat->barangs_count }})
                </button>
            @endforeach
        </div>

        {{-- Catalog Grid --}}
        <div class="row g-3" id="catalogGrid">
            @forelse($barangs as $b)
                @php
                    $katClass = match($b->kategori->nama_kategori) {
                        'Perabotan' => 'badge-kat-perabotan',
                        'Elektronik' => 'badge-kat-elektronik',
                        default => 'badge-kat-alatpraktik',
                    };
                @endphp
                <div class="col-md-6 col-lg-4 col-xl-3 catalog-item"
                    data-name="{{ strtolower($b->nama_barang . ' ' . $b->merk . ' ' . $b->ruangan->nama_ruangan) }}"
                    data-cat="{{ $b->kategori->nama_kategori }}">
                    <div class="catalog-card">
                        <div class="catalog-header">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="catalog-pill-kategori {{ $katClass }}">
                                    {{ $b->kategori->nama_kategori }}
                                </span>
                                <span class="badge bg-light text-muted border font-monospace" style="font-size:0.7rem;">
                                    {{ $b->kode_barang }}
                                </span>
                            </div>
                            <h6 class="fw-bold text-dark mb-1 text-truncate" title="{{ $b->nama_barang }}">
                                {{ $b->nama_barang }}
                            </h6>
                            <div class="text-muted small d-flex align-items-center gap-1 mb-2">
                                <i class="bi bi-geo-alt-fill text-danger" style="font-size:0.75rem;"></i>
                                <span class="text-truncate" title="{{ $b->ruangan->nama_ruangan }}">{{ $b->ruangan->nama_ruangan }}</span>
                            </div>
                        </div>

                        <div class="catalog-body">
                            <div class="d-flex justify-content-between align-items-center py-2 border-top border-bottom my-2 small">
                                <span class="text-muted">Ketersediaan:</span>
                                <div>
                                    <span class="badge bg-success bg-opacity-10 text-success fw-bold px-2 py-1">
                                        {{ $b->stok_tersedia }} Unit Siap
                                    </span>
                                </div>
                            </div>
                            <button type="button" class="btn btn-sm btn-outline-primary w-100 fw-semibold btn-select-barang"
                                data-id="{{ $b->id }}"
                                data-nama="{{ $b->nama_barang }}"
                                data-stok="{{ $b->stok_tersedia }}">
                                <i class="bi bi-hand-index-thumb me-1"></i> Pinjam Barang Ini
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <p class="text-muted">Belum ada barang yang tersedia untuk dipinjam.</p>
                </div>
            @endforelse
        </div>
        <div id="noCatalogFound" class="text-center py-5 d-none">
            <i class="bi bi-search fs-1 text-muted opacity-50 d-block mb-2"></i>
            <h6 class="fw-bold">Tidak ditemukan barang yang sesuai</h6>
            <p class="text-muted small">Coba ubah kata kunci pencarian atau pilih kategori lain.</p>
        </div>
    </div>
</section>

{{-- Section Formulir Peminjaman Terintegrasi --}}
<section class="py-5" id="formulir">
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-9">

                {{-- Alert Sukses Setelah Submit --}}
                @if(session('success_kode'))
                <div class="card border-0 shadow-lg rounded-4 mb-4 overflow-hidden" style="background: linear-gradient(135deg, #065f46 0%, #047857 100%); color:#ffffff;">
                    <div class="card-body p-4 p-md-5 text-center position-relative">
                        <div class="rounded-circle bg-white text-success mx-auto d-flex align-items-center justify-content-center mb-3 shadow" style="width:68px;height:68px;font-size:2rem;">
                            <i class="bi bi-check-lg"></i>
                        </div>
                        <h4 class="fw-bold mb-1">Pengajuan Peminjaman Berhasil!</h4>
                        <p class="text-white-50 small mb-4">Harap catat atau simpan kode peminjaman berikut untuk ditunjukkan kepada petugas saat pengambilan barang.</p>

                        <div class="bg-white text-dark p-3 rounded-3 d-inline-block shadow-sm mb-4 px-4 border">
                            <span class="text-muted small d-block text-uppercase fw-semibold" style="letter-spacing:1px;">Kode Peminjaman Anda</span>
                            <span class="fs-2 fw-bold text-primary font-monospace tracking-wide" id="tiketKode">{{ session('success_kode') }}</span>
                            <button type="button" class="btn btn-sm btn-outline-secondary ms-2" onclick="navigator.clipboard.writeText('{{ session('success_kode') }}'); alert('Kode peminjaman berhasil disalin!');">
                                <i class="bi bi-copy"></i> Salin
                            </button>
                        </div>

                        <div class="small text-white-50">
                            Peminjam: <strong class="text-white">{{ session('success_nama') }}</strong> &nbsp;•&nbsp;
                            Barang: <strong class="text-white">{{ session('success_barang') }}</strong>
                        </div>
                    </div>
                </div>
                @endif

                {{-- Error Alert --}}
                @if($errors->any())
                <div class="alert alert-danger d-flex align-items-start gap-2 mb-4 rounded-3 border-0 shadow-sm" style="background:#fee2e2;color:#991b1b;">
                    <i class="bi bi-exclamation-triangle-fill fs-5 mt-1 flex-shrink-0"></i>
                    <div>
                        <strong class="d-block mb-1">Pengajuan tidak dapat diproses:</strong>
                        <ul class="mb-0 ps-3 small">
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif

                {{-- Card Formulir --}}
                <div class="form-section-card">
                    <div class="form-header-bar">
                        <div>
                            <h5 class="fw-bold mb-0 text-white">
                                <i class="bi bi-pencil-square me-2 text-warning"></i>Formulir Peminjaman Barang
                            </h5>
                            <small class="text-white-50">Isi data identitas diri dan rincian barang yang hendak dipinjam</small>
                        </div>
                        <span class="badge bg-white text-primary fw-bold px-3 py-2 d-none d-sm-inline-block">
                            Tanpa Perlu Login
                        </span>
                    </div>

                    <div class="p-4 p-md-5">
                        <form action="{{ route('home.pinjam') }}" method="POST" id="mainPinjamForm">
                            @csrf
                            <div class="row g-4">

                                {{-- Identitas Peminjam --}}
                                <div class="col-12">
                                    <div class="d-flex align-items-center gap-2 mb-2 pb-1 border-bottom">
                                        <i class="bi bi-person-badge text-primary fs-5"></i>
                                        <h6 class="fw-bold mb-0 text-dark">Data Diri Peminjam</h6>
                                    </div>
                                    <div class="row g-3">
                                        <div class="col-sm-4">
                                            <label class="form-label small fw-semibold">Status Peminjam <span class="text-danger">*</span></label>
                                            <select name="jenis_peminjam" id="jenisPeminjam" class="form-select form-select-sm" required>
                                                @foreach(['Siswa','Guru','Staff','Tamu'] as $j)
                                                    <option value="{{ $j }}" {{ old('jenis_peminjam', 'Siswa') == $j ? 'selected' : '' }}>{{ $j }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-8">
                                            <label class="form-label small fw-semibold">Nama Lengkap <span class="text-danger">*</span></label>
                                            <input type="text" name="nama_peminjam" id="nama_peminjam"
                                                class="form-control form-control-sm @error('nama_peminjam') is-invalid @enderror"
                                                value="{{ old('nama_peminjam') }}" placeholder="Ketik nama lengkap peminjam" required>
                                            @error('nama_peminjam')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        {{-- Autocomplete Siswa Picker (Tampil Jika Status = Siswa) --}}
                                        <div class="col-12" id="siswaPicker">
                                            <div class="siswa-picker-container">
                                                <div class="d-flex justify-content-between align-items-center mb-2">
                                                    <span class="small fw-bold text-primary">
                                                        <i class="bi bi-search me-1"></i>Pencarian Cepat Data Siswa (Opsional)
                                                    </span>
                                                    <small class="text-muted">Pilih kelas atau ketik nama untuk mengisi otomatis</small>
                                                </div>
                                                <div class="row g-2 mb-2">
                                                    <div class="col-sm-4">
                                                        <select id="filterKelas" class="form-select form-select-sm">
                                                            <option value="">— Semua Kelas —</option>
                                                            @foreach($kelasList as $k)
                                                                <option value="{{ $k }}">{{ $k }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <input type="text" id="cariSiswa" class="form-control form-control-sm"
                                                            placeholder="Ketik nama siswa atau NIS...">
                                                    </div>
                                                </div>
                                                <div id="hasilSiswa" style="max-height: 180px; overflow-y: auto;"></div>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <label class="form-label small fw-semibold">NIS / NIP</label>
                                            <input type="text" name="no_identitas" id="no_identitas" class="form-control form-control-sm"
                                                value="{{ old('no_identitas') }}" placeholder="Nomor Induk Siswa / Pegawai (opsional)">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label small fw-semibold">Nomor WhatsApp / HP</label>
                                            <input type="text" name="no_hp" class="form-control form-control-sm"
                                                value="{{ old('no_hp') }}" placeholder="Contoh: 0812-xxxx-xxxx">
                                        </div>
                                    </div>
                                </div>

                                {{-- Rincian Peminjaman Barang --}}
                                <div class="col-12">
                                    <div class="d-flex align-items-center gap-2 mb-2 pb-1 border-bottom">
                                        <i class="bi bi-box-seam text-primary fs-5"></i>
                                        <h6 class="fw-bold mb-0 text-dark">Rincian Barang & Waktu Pinjam</h6>
                                    </div>
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <label class="form-label small fw-semibold">Pilih Barang yang Dipinjam <span class="text-danger">*</span></label>
                                            <select name="barang_id" id="barangSelect" class="form-select @error('barang_id') is-invalid @enderror" required>
                                                <option value="">— Pilih Barang dari Daftar —</option>
                                                @foreach($barangs as $b)
                                                    <option value="{{ $b->id }}"
                                                        data-stok="{{ $b->stok_tersedia }}"
                                                        {{ old('barang_id') == $b->id ? 'selected' : '' }}>
                                                        {{ $b->nama_barang }} [{{ $b->kategori->nama_kategori }}] — Lokasi: {{ $b->ruangan->nama_ruangan }} (Stok Siap: {{ $b->stok_tersedia }})
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div id="stokHint" class="form-text text-success fw-semibold mt-1" style="display:none;">
                                                <i class="bi bi-info-circle me-1"></i><span id="stokText"></span>
                                            </div>
                                            @error('barang_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-sm-4">
                                            <label class="form-label small fw-semibold">Jumlah Unit <span class="text-danger">*</span></label>
                                            <input type="number" name="jumlah" id="jumlahInput"
                                                class="form-control form-control-sm @error('jumlah') is-invalid @enderror"
                                                value="{{ old('jumlah', 1) }}" min="1" required>
                                            @error('jumlah')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-sm-8">
                                            <label class="form-label small fw-semibold">Rencana Tanggal Pengembalian <span class="text-danger">*</span></label>
                                            <input type="date" name="tanggal_kembali_rencana"
                                                class="form-control form-control-sm @error('tanggal_kembali_rencana') is-invalid @enderror"
                                                value="{{ old('tanggal_kembali_rencana', date('Y-m-d', strtotime('+1 day'))) }}"
                                                min="{{ date('Y-m-d') }}" required>
                                            @error('tanggal_kembali_rencana')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label small fw-semibold">Keperluan Peminjaman</label>
                                            <textarea name="keperluan" class="form-control" rows="2"
                                                placeholder="Contoh: Praktikum tugas Ujikom PPLG / Sesi foto portofolio / Kegiatan ekskul">{{ old('keperluan') }}</textarea>
                                        </div>

                                        <div class="col-12">
                                            <div class="p-3 rounded-3 border bg-light d-flex align-items-start gap-2">
                                                <i class="bi bi-info-circle-fill text-primary mt-1"></i>
                                                <small class="text-muted">
                                                    Dengan mengklik tombol ajukan, peminjam bersedia mematuhi tata tertib sarana prasarana sekolah dan bertanggung jawab penuh atas keutuhan peralatan selama masa peminjaman.
                                                </small>
                                            </div>
                                        </div>

                                        <div class="col-12 pt-2">
                                            <button type="submit" class="btn btn-primary w-100 py-3 fw-bold fs-6 shadow-sm">
                                                <i class="bi bi-send-check me-2"></i> Ajukan Permohonan Peminjaman
                                            </button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

{{-- Section Syarat & Ketentuan --}}
<section class="py-5 bg-white border-top" id="ketentuan">
    <div class="container py-4">
        <div class="text-center max-w-700 mx-auto mb-4">
            <span class="badge bg-secondary bg-opacity-10 text-secondary px-3 py-2 fw-bold text-uppercase mb-2">Informasi Penting</span>
            <h4 class="fw-bold text-dark">Ketentuan Penggunaan Inventaris Sekolah</h4>
        </div>

        <div class="row g-4 justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 bg-light p-3 rounded-3">
                    <div class="d-flex align-items-center gap-2 mb-2 text-primary fw-bold">
                        <i class="bi bi-clock-history fs-5"></i> Waktu Pengembalian
                    </div>
                    <p class="small text-muted mb-0">
                        Barang wajib dikembalikan tepat waktu sesuai tanggal rencana kembali. Keterlambatan akan tercatat pada sistem log inventaris sekolah.
                    </p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 bg-light p-3 rounded-3">
                    <div class="d-flex align-items-center gap-2 mb-2 text-success fw-bold">
                        <i class="bi bi-shield-check fs-5"></i> Kondisi & Tanggung Jawab
                    </div>
                    <p class="small text-muted mb-0">
                        Peminjam wajib memeriksa kelengkapan barang saat pengambilan. Kerusakan atau kehilangan akibat kelalaian menjadi tanggung jawab peminjam.
                    </p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 bg-light p-3 rounded-3">
                    <div class="d-flex align-items-center gap-2 mb-2 text-warning fw-bold">
                        <i class="bi bi-ticket-perforated fs-5"></i> Kode Tiket Peminjaman
                    </div>
                    <p class="small text-muted mb-0">
                        Harap simpan kode peminjaman yang Anda peroleh. Kode tersebut digunakan petugas untuk validasi penyerahan maupun pengembalian barang.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Footer --}}
<footer class="footer-main">
    <div class="container">
        <div class="row g-4 mb-4">
            <div class="col-lg-5">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <div class="brand-icon" style="width:36px;height:36px;font-size:1rem;">
                        <i class="bi bi-box-seam-fill"></i>
                    </div>
                    <span class="text-white fw-bold fs-6">SMK Bakti Nusantara 666</span>
                </div>
                <p class="small text-white-50 mb-3" style="max-width:380px;">
                    Sistem Manajemen Sarana Prasarana dan Inventarisasi Terpadu. Mendukung kelancaran proses belajar mengajar dan praktikum kejuruan.
                </p>
                <div class="small text-white-50">
                    <i class="bi bi-geo-alt me-1 text-warning"></i> Jl. Percobaan No. 65, Cileunyi, Kab. Bandung, Jawa Barat
                </div>
            </div>

            <div class="col-6 col-lg-3">
                <div class="footer-title">Tautan Cepat</div>
                <a href="#katalog" class="footer-link">Katalog Inventaris</a>
                <a href="#alur" class="footer-link">Alur Peminjaman</a>
                <a href="#lacak" class="footer-link">Cek Status Tiket</a>
                <a href="#formulir" class="footer-link">Formulir Mandiri</a>
            </div>

            <div class="col-6 col-lg-4">
                <div class="footer-title">Layanan Sarpras</div>
                <p class="small text-white-50 mb-2">
                    <i class="bi bi-clock me-1 text-warning"></i> Jam Operasional Lab & Gudang:<br>
                    Senin – Jumat : 07.00 – 16.00 WIB
                </p>
                <p class="small text-white-50 mb-0">
                    <i class="bi bi-person-badge me-1 text-warning"></i> Petugas Inventaris: Ruang Sarpras & Gudang (Gedung A, Lt. 2)
                </p>
            </div>
        </div>

        <div class="pt-3 border-top border-secondary border-opacity-25 d-flex flex-column flex-md-row justify-content-between align-items-center gap-2 small text-white-50">
            <div>
                © {{ date('Y') }} SMK Bakti Nusantara 666. Hak Cipta Dilindungi Undang-Undang.
            </div>
            <div>
                <a href="{{ route('login') }}" class="text-white-50 text-decoration-none">
                    <i class="bi bi-lock me-1"></i> Area Staff & Petugas
                </a>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // ── 1. Live Filter Catalog ────────────────────────────────────
    const filterInput = document.getElementById('liveFilterInput');
    const catalogItems = document.querySelectorAll('.catalog-item');
    const filterTabs = document.querySelectorAll('.filter-tab');
    const noCatalogFound = document.getElementById('noCatalogFound');

    let currentCategory = 'all';

    function applyCatalogFilter() {
        const query = filterInput.value.toLowerCase().trim();
        let visibleCount = 0;

        catalogItems.forEach(item => {
            const name = item.dataset.name;
            const cat = item.dataset.cat;
            const matchesCategory = currentCategory === 'all' || cat === currentCategory;
            const matchesSearch = query === '' || name.includes(query);

            if (matchesCategory && matchesSearch) {
                item.style.display = '';
                visibleCount++;
            } else {
                item.style.display = 'none';
            }
        });

        if (visibleCount === 0) {
            noCatalogFound.classList.remove('d-none');
        } else {
            noCatalogFound.classList.add('d-none');
        }
    }

    if (filterInput) {
        filterInput.addEventListener('input', applyCatalogFilter);
    }

    filterTabs.forEach(tab => {
        tab.addEventListener('click', function () {
            filterTabs.forEach(t => {
                t.classList.remove('active', 'btn-primary');
                t.classList.add('btn-outline-secondary');
            });
            this.classList.add('active', 'btn-primary');
            this.classList.remove('btn-outline-secondary');

            currentCategory = this.dataset.category;
            applyCatalogFilter();
        });
    });

    // ── 2. Click "Pinjam Barang Ini" dari Katalog ───────────────
    const barangSelect = document.getElementById('barangSelect');
    const jumlahInput = document.getElementById('jumlahInput');
    const stokHint = document.getElementById('stokHint');
    const stokText = document.getElementById('stokText');

    document.querySelectorAll('.btn-select-barang').forEach(btn => {
        btn.addEventListener('click', function () {
            const barangId = this.dataset.id;
            const stok = this.dataset.stok;

            if (barangSelect) {
                barangSelect.value = barangId;
                barangSelect.dispatchEvent(new Event('change'));
            }

            // Smooth scroll to form
            const formSection = document.getElementById('formulir');
            if (formSection) {
                formSection.scrollIntoView({ behavior: 'smooth' });
            }
        });
    });

    // Update stok hint saat barang diubah
    if (barangSelect) {
        barangSelect.addEventListener('change', function () {
            const opt = this.options[this.selectedIndex];
            const stok = opt ? opt.dataset.stok : null;
            if (stok !== undefined && stok !== null && this.value) {
                stokText.textContent = 'Maksimal yang dapat dipinjam: ' + stok + ' unit tersedia';
                stokHint.style.display = 'block';
                jumlahInput.max = stok;
            } else {
                stokHint.style.display = 'none';
                jumlahInput.removeAttribute('max');
            }
        });
        if (barangSelect.value) {
            barangSelect.dispatchEvent(new Event('change'));
        }
    }

    // ── 3. Siswa Autocomplete Picker ─────────────────────────────
    const jenisSel = document.getElementById('jenisPeminjam');
    const siswaPicker = document.getElementById('siswaPicker');
    const filterKelas = document.getElementById('filterKelas');
    const cariSiswa = document.getElementById('cariSiswa');
    const hasilSiswa = document.getElementById('hasilSiswa');
    const namaPeminjam = document.getElementById('nama_peminjam');
    const noIdentitas = document.getElementById('no_identitas');

    function toggleSiswaPicker() {
        if (jenisSel) {
            siswaPicker.style.display = jenisSel.value === 'Siswa' ? 'block' : 'none';
        }
    }
    if (jenisSel) {
        jenisSel.addEventListener('change', toggleSiswaPicker);
        toggleSiswaPicker();
    }

    let debounceTimer;
    function fetchSiswaList() {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(() => {
            const q = cariSiswa.value.trim();
            const k = filterKelas.value;
            if (q.length < 2 && !k) {
                hasilSiswa.innerHTML = '';
                return;
            }

            fetch(`/api/siswa?q=${encodeURIComponent(q)}&kelas=${encodeURIComponent(k)}`)
                .then(r => r.json())
                .then(data => {
                    if (!data.length) {
                        hasilSiswa.innerHTML = '<p class="small text-muted mb-0 mt-2">Tidak ditemukan data siswa.</p>';
                        return;
                    }

                    hasilSiswa.innerHTML = data.map(s => `
                        <div class="siswa-item-click d-flex justify-content-between align-items-center"
                            data-nama="${s.nama_lengkap}" data-nis="${s.nis}">
                            <div>
                                <strong class="small text-dark d-block">${s.nama_lengkap}</strong>
                                <small class="text-muted">${s.nis}</small>
                            </div>
                            <span class="badge bg-primary bg-opacity-10 text-primary">${s.kelas}</span>
                        </div>
                    `).join('');

                    document.querySelectorAll('.siswa-item-click').forEach(el => {
                        el.addEventListener('click', function () {
                            namaPeminjam.value = this.dataset.nama;
                            noIdentitas.value = this.dataset.nis;
                            hasilSiswa.innerHTML = `
                                <div class="alert alert-success py-2 px-3 small mb-0 mt-2 d-flex align-items-center gap-2">
                                    <i class="bi bi-check-circle-fill"></i>
                                    <span>Siswa <strong>${this.dataset.nama}</strong> terpilih.</span>
                                </div>
                            `;
                            cariSiswa.value = '';
                        });
                    });
                });
        }, 280);
    }

    if (cariSiswa) cariSiswa.addEventListener('input', fetchSiswaList);
    if (filterKelas) filterKelas.addEventListener('change', fetchSiswaList);
</script>
</body>
</html>
