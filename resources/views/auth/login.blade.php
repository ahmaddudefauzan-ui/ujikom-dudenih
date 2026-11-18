<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login – Inventaris SMK Bakti Nusantara 666</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        :root { --primary: #1e3a5f; --accent: #f59e0b; }
        * { box-sizing: border-box; }
        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            display: flex;
            background: #f1f5f9;
        }
        /* Left panel */
        .login-left {
            flex: 1;
            background: linear-gradient(145deg, var(--primary) 0%, #2d5fc4 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 3rem;
            position: relative;
            overflow: hidden;
        }
        .login-left::before {
            content: '';
            position: absolute;
            width: 350px; height: 350px;
            border-radius: 50%;
            background: rgba(255,255,255,.04);
            top: -80px; right: -80px;
        }
        .login-left::after {
            content: '';
            position: absolute;
            width: 250px; height: 250px;
            border-radius: 50%;
            background: rgba(255,255,255,.04);
            bottom: -60px; left: -60px;
        }
        .login-left .hero-icon {
            width: 80px; height: 80px;
            background: var(--accent);
            border-radius: 20px;
            display: flex; align-items: center; justify-content: center;
            font-size: 2.2rem;
            color: var(--primary);
            margin-bottom: 1.5rem;
            position: relative; z-index: 1;
        }
        .login-left h1 {
            color: #fff;
            font-size: 1.5rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: .5rem;
            position: relative; z-index: 1;
        }
        .login-left p {
            color: rgba(255,255,255,.65);
            font-size: .88rem;
            text-align: center;
            max-width: 280px;
            position: relative; z-index: 1;
        }
        .login-left .info-pills {
            display: flex;
            gap: .6rem;
            flex-wrap: wrap;
            justify-content: center;
            margin-top: 2rem;
            position: relative; z-index: 1;
        }
        .login-left .info-pill {
            background: rgba(255,255,255,.12);
            color: rgba(255,255,255,.8);
            font-size: .72rem;
            padding: .3rem .75rem;
            border-radius: 20px;
            border: 1px solid rgba(255,255,255,.15);
        }
        /* Right panel (form) */
        .login-right {
            width: 420px;
            background: #fff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 3rem 2.5rem;
            box-shadow: -8px 0 40px rgba(0,0,0,.06);
        }
        .login-right .login-logo {
            width: 44px; height: 44px;
            background: var(--primary);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            color: #fff;
            font-size: 1.1rem;
            margin-bottom: 1.5rem;
        }
        .login-right h2 { font-size: 1.3rem; font-weight: 700; color: #1e293b; margin-bottom: .3rem; }
        .login-right .sub { font-size: .83rem; color: #64748b; margin-bottom: 2rem; }
        .form-label { font-size: .78rem; font-weight: 600; color: #374151; margin-bottom: .35rem; }
        .form-control {
            font-size: .88rem;
            border: 1.5px solid #e2e8f0;
            border-radius: 9px;
            padding: .6rem .85rem;
            transition: border-color .2s, box-shadow .2s;
        }
        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(30,58,95,.1);
        }
        .input-group-text {
            background: #f8fafc;
            border: 1.5px solid #e2e8f0;
            border-radius: 9px 0 0 9px;
            color: #94a3b8;
        }
        .input-group .form-control { border-radius: 0 9px 9px 0; border-left: 0; }
        .btn-login {
            background: var(--primary);
            color: #fff;
            border: none;
            border-radius: 9px;
            padding: .65rem 1rem;
            font-size: .9rem;
            font-weight: 600;
            width: 100%;
            transition: background .2s, transform .1s;
        }
        .btn-login:hover { background: #152b47; transform: translateY(-1px); }
        .btn-login:active { transform: translateY(0); }
        .divider { border-top: 1px solid #e2e8f0; margin: 1.5rem 0; }
        .back-link { font-size: .8rem; color: #64748b; text-decoration: none; display: inline-flex; align-items: center; gap: .3rem; }
        .back-link:hover { color: var(--primary); }
        /* Responsive */
        @media (max-width: 768px) {
            .login-left { display: none; }
            .login-right { width: 100%; padding: 2rem 1.5rem; box-shadow: none; }
        }
    </style>
</head>
<body>
    <!-- Left decorative panel -->
    <div class="login-left d-none d-md-flex">
        <div class="hero-icon"><i class="bi bi-clipboard2-check-fill"></i></div>
        <h1>Sistem Inventaris</h1>
        <p>Kelola aset sekolah dengan mudah, cepat, dan terpusat dalam satu platform.</p>
        <div class="info-pills">
            <span class="info-pill"><i class="bi bi-box-seam me-1"></i>Kelola Barang</span>
            <span class="info-pill"><i class="bi bi-arrow-left-right me-1"></i>Peminjaman</span>
            <span class="info-pill"><i class="bi bi-file-earmark-bar-graph me-1"></i>Laporan PDF</span>
            <span class="info-pill"><i class="bi bi-mortarboard me-1"></i>Data Siswa</span>
        </div>
    </div>

    <!-- Right form panel -->
    <div class="login-right">
        <div class="login-logo"><i class="bi bi-clipboard2-check-fill"></i></div>
        <h2>Selamat Datang</h2>
        <p class="sub">Masuk ke akun Anda untuk melanjutkan</p>

        @if($errors->any())
            <div class="alert alert-danger d-flex align-items-center gap-2 py-2 mb-3"
                 style="background:#fee2e2;color:#991b1b;border:none;border-radius:9px;font-size:.83rem">
                <i class="bi bi-exclamation-circle-fill flex-shrink-0"></i>
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Alamat Email</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                    <input type="email" name="email"
                        class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email') }}"
                        placeholder="email@sekolah.ac.id"
                        required autofocus>
                </div>
            </div>
            <div class="mb-4">
                <label class="form-label">Password</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                    <input type="password" name="password"
                        class="form-control"
                        placeholder="Masukkan password"
                        required>
                </div>
            </div>
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="form-check mb-0">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                    <label class="form-check-label" for="remember" style="font-size:.8rem">Ingat saya</label>
                </div>
            </div>
            <button type="submit" class="btn-login">
                <i class="bi bi-box-arrow-in-right me-2"></i>Masuk ke Sistem
            </button>
        </form>

        <div class="divider"></div>
        <div class="text-center">
            <a href="{{ route('home') }}" class="back-link">
                <i class="bi bi-arrow-left"></i> Kembali ke Beranda Peminjaman
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
