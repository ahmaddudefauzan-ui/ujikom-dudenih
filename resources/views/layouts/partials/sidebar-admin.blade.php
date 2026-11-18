<div class="nav-section-label">Menu Utama</div>
<a href="{{ route('admin.dashboard') }}"
   class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
    <i class="bi bi-grid-1x2-fill"></i> Dashboard
</a>

<div class="nav-section-label">Data Master</div>
<a href="{{ route('admin.barang.index') }}"
   class="sidebar-link {{ request()->routeIs('admin.barang.*') ? 'active' : '' }}">
    <i class="bi bi-box-seam-fill"></i> Data Barang
</a>
<a href="{{ route('admin.ruangan.index') }}"
   class="sidebar-link {{ request()->routeIs('admin.ruangan.*') ? 'active' : '' }}">
    <i class="bi bi-building-fill"></i> Data Ruangan
</a>
<a href="{{ route('admin.kategori.index') }}"
   class="sidebar-link {{ request()->routeIs('admin.kategori.*') ? 'active' : '' }}">
    <i class="bi bi-tags-fill"></i> Kategori Barang
</a>
<a href="{{ route('admin.siswa.index') }}"
   class="sidebar-link {{ request()->routeIs('admin.siswa.*') ? 'active' : '' }}">
    <i class="bi bi-mortarboard-fill"></i> Data Siswa
</a>

<div class="nav-section-label">Transaksi</div>
<a href="{{ route('petugas.pinjaman.create') }}"
   class="sidebar-link {{ request()->routeIs('petugas.pinjaman.create') ? 'active' : '' }}">
    <i class="bi bi-plus-circle-fill"></i> Tambah Peminjaman
</a>
<a href="{{ route('petugas.pinjaman.index') }}?status=Dipinjam"
   class="sidebar-link {{ request()->routeIs('petugas.pinjaman.index') && request('status') == 'Dipinjam' ? 'active' : '' }}">
    <i class="bi bi-box-arrow-in-down-right"></i> Pengembalian Barang
    @php
        $aktif = \App\Models\Pinjaman::whereIn('status', ['Dipinjam','Terlambat'])->count();
    @endphp
    @if($aktif > 0)
        <span class="ms-auto badge" style="background:var(--accent);color:#1e3a5f;font-size:.62rem;">{{ $aktif }}</span>
    @endif
</a>
<a href="{{ route('petugas.pinjaman.index') }}"
   class="sidebar-link {{ request()->routeIs('petugas.pinjaman.index') && !request('status') ? 'active' : '' }}">
    <i class="bi bi-list-ul"></i> Semua Pinjaman
</a>

<div class="nav-section-label">Laporan</div>
<a href="{{ route('admin.laporan.kondisi-barang') }}"
   class="sidebar-link {{ request()->routeIs('admin.laporan.kondisi-barang*') ? 'active' : '' }}">
    <i class="bi bi-clipboard2-data-fill"></i> Laporan Kondisi
</a>
<a href="{{ route('admin.laporan.pinjaman') }}"
   class="sidebar-link {{ request()->routeIs('admin.laporan.pinjaman*') ? 'active' : '' }}">
    <i class="bi bi-file-earmark-bar-graph-fill"></i> Laporan Pinjaman
</a>

<div class="nav-section-label">Manajemen</div>
<a href="{{ route('admin.petugas.index') }}"
   class="sidebar-link {{ request()->routeIs('admin.petugas.*') ? 'active' : '' }}">
    <i class="bi bi-people-fill"></i> Data Petugas
</a>
