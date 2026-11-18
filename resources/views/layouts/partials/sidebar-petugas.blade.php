<div class="nav-section-label">Menu Utama</div>
<a href="{{ route('petugas.dashboard') }}"
   class="sidebar-link {{ request()->routeIs('petugas.dashboard') ? 'active' : '' }}">
    <i class="bi bi-grid-1x2-fill"></i> Dashboard
</a>

<div class="nav-section-label">Transaksi</div>
<a href="{{ route('petugas.pinjaman.create') }}"
   class="sidebar-link {{ request()->routeIs('petugas.pinjaman.create') ? 'active' : '' }}">
    <i class="bi bi-plus-circle-fill"></i> Tambah Peminjaman
</a>
<a href="{{ route('petugas.pinjaman.index') }}?status=Dipinjam"
   class="sidebar-link {{ request()->routeIs('petugas.pinjaman.index') && request('status') == 'Dipinjam' ? 'active' : '' }}">
    <i class="bi bi-box-arrow-up-right"></i> Pengembalian Barang
    @php
        $terlambat = \App\Models\Pinjaman::whereIn('status', ['Dipinjam','Terlambat'])->count();
    @endphp
    @if($terlambat > 0)
        <span class="ms-auto badge" style="background:var(--accent);color:#1e3a5f;font-size:.62rem;">{{ $terlambat }}</span>
    @endif
</a>
<a href="{{ route('petugas.pinjaman.index') }}"
   class="sidebar-link {{ request()->routeIs('petugas.pinjaman.index') && !request('status') ? 'active' : '' }}">
    <i class="bi bi-list-ul"></i> Semua Pinjaman
</a>

<div class="nav-section-label">Laporan</div>
<a href="{{ route('petugas.laporan') }}"
   class="sidebar-link {{ request()->routeIs('petugas.laporan*') ? 'active' : '' }}">
    <i class="bi bi-file-earmark-bar-graph-fill"></i> Laporan Pinjaman
</a>
