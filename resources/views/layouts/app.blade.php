<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Inventaris') – SMK Bakti Nusantara 666</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        /* ── Tokens ─────────────────────────────────────── */
        :root {
            --sidebar-w   : 265px;
            --primary     : #1e3a5f;
            --primary-dark: #152b47;
            --accent      : #f59e0b;
            --accent-light: #fef3c7;
            --bg          : #f1f5f9;
            --surface     : #ffffff;
            --border      : #e2e8f0;
            --text        : #1e293b;
            --text-muted  : #64748b;
            --radius      : 12px;
            --shadow-sm   : 0 1px 3px rgba(0,0,0,.08), 0 1px 2px rgba(0,0,0,.06);
            --shadow-md   : 0 4px 16px rgba(0,0,0,.10);
        }

        /* ── Base ───────────────────────────────────────── */
        *, *::before, *::after { box-sizing: border-box; }
        body {
            font-family: 'Inter', 'Segoe UI', sans-serif;
            background: var(--bg);
            color: var(--text);
            font-size: 14px;
            margin: 0;
        }

        /* ── Sidebar ────────────────────────────────────── */
        .sidebar {
            width: var(--sidebar-w);
            height: 100vh;
            background: var(--primary);
            position: fixed;
            top: 0; left: 0;
            z-index: 200;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            transition: transform .3s ease;
        }

        /* Brand */
        .sidebar-brand {
            padding: 1.25rem 1.1rem 1rem;
            border-bottom: 1px solid rgba(255,255,255,.1);
            display: flex;
            align-items: center;
            gap: .75rem;
            text-decoration: none;
        }
        .sidebar-brand .brand-icon {
            width: 40px; height: 40px;
            border-radius: 10px;
            background: var(--accent);
            display: flex; align-items: center; justify-content: center;
            font-size: 1.1rem;
            color: var(--primary-dark);
            flex-shrink: 0;
        }
        .sidebar-brand .brand-text { line-height: 1.25; }
        .sidebar-brand .brand-text strong {
            display: block;
            font-size: .82rem;
            font-weight: 700;
            color: #fff;
        }
        .sidebar-brand .brand-text small {
            font-size: .68rem;
            color: rgba(255,255,255,.5);
            letter-spacing: .3px;
        }

        /* Nav */
        .sidebar-nav { flex: 1; overflow-y: auto; padding: .5rem 0; }
        .sidebar-nav::-webkit-scrollbar { width: 4px; }
        .sidebar-nav::-webkit-scrollbar-thumb { background: rgba(255,255,255,.15); border-radius: 4px; }

        .nav-section-label {
            font-size: .62rem;
            font-weight: 700;
            letter-spacing: 1.2px;
            text-transform: uppercase;
            color: rgba(255,255,255,.35);
            padding: 1rem 1.1rem .3rem;
        }
        .sidebar-link {
            display: flex;
            align-items: center;
            gap: .6rem;
            padding: .5rem 1rem;
            margin: 1px .5rem;
            border-radius: 8px;
            color: rgba(255,255,255,.7);
            text-decoration: none;
            font-size: .84rem;
            font-weight: 500;
            transition: background .15s, color .15s;
        }
        .sidebar-link i {
            font-size: 1rem;
            width: 20px;
            text-align: center;
            flex-shrink: 0;
        }
        .sidebar-link:hover {
            background: rgba(255,255,255,.1);
            color: #fff;
        }
        .sidebar-link.active {
            background: rgba(255,255,255,.18);
            color: #fff;
            font-weight: 600;
        }
        .sidebar-link.active i { color: var(--accent); }

        /* User footer */
        .sidebar-user {
            padding: .85rem 1rem;
            border-top: 1px solid rgba(255,255,255,.1);
        }
        .sidebar-user .user-avatar {
            width: 34px; height: 34px;
            border-radius: 50%;
            background: var(--accent);
            display: flex; align-items: center; justify-content: center;
            font-size: .95rem;
            color: var(--primary-dark);
            font-weight: 700;
            flex-shrink: 0;
        }
        .sidebar-user .user-name {
            font-size: .82rem;
            font-weight: 600;
            color: #fff;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .sidebar-user .user-role {
            font-size: .68rem;
            color: rgba(255,255,255,.45);
            text-transform: capitalize;
        }
        .btn-logout {
            background: rgba(255,255,255,.08);
            border: 1px solid rgba(255,255,255,.12);
            color: rgba(255,255,255,.75);
            font-size: .78rem;
            border-radius: 7px;
            padding: .32rem .7rem;
            transition: background .15s, color .15s;
            white-space: nowrap;
        }
        .btn-logout:hover {
            background: rgba(255,255,255,.18);
            color: #fff;
        }

        /* ── Topbar ─────────────────────────────────────── */
        .main-wrap { margin-left: var(--sidebar-w); min-height: 100vh; }
        .topbar {
            position: sticky; top: 0; z-index: 100;
            background: var(--surface);
            border-bottom: 1px solid var(--border);
            padding: .75rem 1.6rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
        }
        .topbar-title {
            font-size: .95rem;
            font-weight: 700;
            color: var(--text);
            margin: 0;
        }
        .topbar-meta {
            font-size: .75rem;
            color: var(--text-muted);
            display: flex;
            align-items: center;
            gap: .4rem;
        }

        /* ── Page content ───────────────────────────────── */
        .page-body { padding: 1.4rem 1.6rem 2rem; }

        /* ── Alert ──────────────────────────────────────── */
        .alert {
            border: none;
            border-radius: var(--radius);
            font-size: .86rem;
            padding: .75rem 1rem;
        }
        .alert-success { background: #dcfce7; color: #166534; }
        .alert-danger  { background: #fee2e2; color: #991b1b; }

        /* ── Cards ──────────────────────────────────────── */
        .card {
            border: 1px solid var(--border);
            border-radius: var(--radius);
            box-shadow: var(--shadow-sm);
        }
        .card-header {
            padding: .85rem 1.1rem;
            font-size: .85rem;
            font-weight: 600;
            background: var(--surface);
            border-bottom: 1px solid var(--border);
            border-radius: var(--radius) var(--radius) 0 0 !important;
        }
        .card-footer {
            background: var(--surface);
            border-top: 1px solid var(--border);
            border-radius: 0 0 var(--radius) var(--radius) !important;
        }

        /* ── Stat cards ─────────────────────────────────── */
        .stat-card {
            border-radius: var(--radius);
            border: 1px solid var(--border);
            background: var(--surface);
            box-shadow: var(--shadow-sm);
            padding: 1.1rem 1.2rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        .stat-icon {
            width: 46px; height: 46px;
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.25rem;
            flex-shrink: 0;
        }
        .stat-value { font-size: 1.6rem; font-weight: 700; line-height: 1; }
        .stat-label { font-size: .75rem; color: var(--text-muted); margin-top: 2px; }

        /* ── Tables ─────────────────────────────────────── */
        .table {
            font-size: .84rem;
            margin: 0;
        }
        .table thead th {
            font-size: .72rem;
            font-weight: 700;
            letter-spacing: .6px;
            text-transform: uppercase;
            color: var(--text-muted);
            background: #f8fafc;
            padding: .65rem 1rem;
            border-bottom: 1px solid var(--border);
            white-space: nowrap;
        }
        .table tbody td {
            padding: .65rem 1rem;
            vertical-align: middle;
            border-bottom: 1px solid #f1f5f9;
        }
        .table tbody tr:last-child td { border-bottom: none; }
        .table tbody tr:hover td { background: #f8fafc; }

        /* ── Badges ─────────────────────────────────────── */
        .badge {
            font-size: .7rem;
            font-weight: 600;
            padding: .28em .65em;
            border-radius: 5px;
            letter-spacing: .2px;
        }

        /* ── Buttons ────────────────────────────────────── */
        .btn { font-size: .83rem; border-radius: 8px; font-weight: 500; }
        .btn-sm { font-size: .78rem; padding: .28rem .65rem; border-radius: 6px; }
        .btn-primary   { background: var(--primary); border-color: var(--primary); }
        .btn-primary:hover { background: var(--primary-dark); border-color: var(--primary-dark); }

        /* ── Forms ──────────────────────────────────────── */
        .form-control, .form-select {
            font-size: .84rem;
            border-radius: 8px;
            border-color: var(--border);
            padding: .45rem .75rem;
        }
        .form-control:focus, .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(30,58,95,.12);
        }
        .form-control-sm, .form-select-sm { font-size: .8rem; border-radius: 6px; }
        .form-label { font-size: .78rem; font-weight: 600; color: #374151; margin-bottom: .35rem; }
        .input-group-text { background: #f8fafc; border-color: var(--border); font-size: .84rem; border-radius: 8px 0 0 8px; }

        /* ── Pagination ─────────────────────────────────── */
        .pagination { font-size: .8rem; margin: 0; }
        .page-link { border-color: var(--border); color: var(--primary); border-radius: 6px !important; margin: 0 2px; }
        .page-link:hover { background: var(--bg); }
        .page-item.active .page-link { background: var(--primary); border-color: var(--primary); }
        nav[role="navigation"] svg,
        .pagination svg {
            width: 1rem !important;
            height: 1rem !important;
            max-width: 1rem !important;
            max-height: 1rem !important;
            display: inline-block !important;
            vertical-align: middle;
        }

        /* ── Code ───────────────────────────────────────── */
        code {
            background: #f1f5f9;
            color: #0f172a;
            padding: .15em .45em;
            border-radius: 5px;
            font-size: .82em;
        }

        /* ── Responsive ─────────────────────────────────── */
        @media (max-width: 991px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
            .main-wrap { margin-left: 0; }
        }
    </style>
    @yield('styles')
</head>
<body>

@auth
    <!-- ══ SIDEBAR ══════════════════════════════════════ -->
    <aside class="sidebar" id="sidebar">
        <a href="#" class="sidebar-brand">
            <div class="brand-icon"><i class="bi bi-clipboard2-check-fill"></i></div>
            <div class="brand-text">
                <strong>SMK Bakti Nusantara 666</strong>
                <small>Sistem Inventaris</small>
            </div>
        </a>

        <div class="sidebar-nav">
            @if(auth()->user()->isAdmin())
                @include('layouts.partials.sidebar-admin')
            @else
                @include('layouts.partials.sidebar-petugas')
            @endif
        </div>

        <div class="sidebar-user">
            <div class="d-flex align-items-center gap-2 mb-2">
                <div class="user-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                <div class="overflow-hidden flex-grow-1">
                    <div class="user-name">{{ auth()->user()->name }}</div>
                    <div class="user-role">{{ auth()->user()->role }}</div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn-logout">
                        <i class="bi bi-box-arrow-right"></i>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- ══ MAIN ═════════════════════════════════════════ -->
    <div class="main-wrap">
        <header class="topbar">
            <div class="d-flex align-items-center gap-3">
                <button class="btn btn-sm btn-light d-lg-none" id="sidebarToggle">
                    <i class="bi bi-list fs-5"></i>
                </button>
                <h1 class="topbar-title">@yield('page-title', 'Dashboard')</h1>
            </div>
            <div class="topbar-meta">
                <i class="bi bi-calendar3"></i>
                {{ now()->isoFormat('dddd, D MMMM Y') }}
            </div>
        </header>

        <main class="page-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2 mb-4" role="alert">
                    <i class="bi bi-check-circle-fill flex-shrink-0"></i>
                    <div>{!! session('success') !!}</div>
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center gap-2 mb-4" role="alert">
                    <i class="bi bi-exclamation-triangle-fill flex-shrink-0"></i>
                    <div>{{ session('error') }}</div>
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @yield('content')
        </main>
    </div>

@else
    @yield('content')
@endauth

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Mobile sidebar toggle
    const toggle  = document.getElementById('sidebarToggle');
    const sidebar = document.getElementById('sidebar');
    if (toggle && sidebar) {
        toggle.addEventListener('click', () => sidebar.classList.toggle('open'));
        document.addEventListener('click', e => {
            if (!sidebar.contains(e.target) && !toggle.contains(e.target))
                sidebar.classList.remove('open');
        });
    }
</script>
@yield('scripts')
</body>
</html>
