<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Laporan Peminjaman</title>
<style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body { font-family: Arial, sans-serif; font-size: 9px; color: #222; }
    .header { text-align: center; padding: 12px 0 8px; border-bottom: 2px solid #1a3a6e; margin-bottom: 10px; }
    .header h2 { font-size: 14px; color: #1a3a6e; }
    .header p  { font-size: 9px; color: #555; margin-top: 2px; }
    .meta { margin-bottom: 8px; font-size: 9px; color: #555; }
    .summary { display: flex; gap: 8px; margin-bottom: 10px; }
    .summary-box { flex: 1; border: 1px solid #ddd; border-radius: 4px; padding: 6px; text-align: center; }
    .summary-box .num { font-size: 16px; font-weight: bold; }
    .summary-box .lbl { font-size: 8px; color: #666; }
    table { width: 100%; border-collapse: collapse; }
    th { background: #1a3a6e; color: #fff; padding: 5px 4px; font-size: 8px; }
    td { padding: 4px; border-bottom: 1px solid #e5e7eb; font-size: 8px; }
    tr:nth-child(even) td { background: #f9fafb; }
    .badge-dipinjam   { background: #fef3c7; color: #ca8a04; padding: 1px 5px; border-radius: 3px; }
    .badge-kembali    { background: #dcfce7; color: #16a34a; padding: 1px 5px; border-radius: 3px; }
    .badge-terlambat  { background: #fee2e2; color: #dc2626; padding: 1px 5px; border-radius: 3px; }
    .footer { margin-top: 15px; border-top: 1px solid #ddd; padding-top: 6px; font-size: 8px; color: #888; display: flex; justify-content: space-between; }
</style>
</head>
<body>
<div class="header">
    <h2>LAPORAN PEMINJAMAN BARANG INVENTARIS</h2>
    <p>SMK Bakti Nusantara 666</p>
</div>

<div class="meta">
    <strong>Filter:</strong> {{ $filterLabel }} &nbsp;&nbsp;|&nbsp;&nbsp;
    <strong>Tanggal Cetak:</strong> {{ now()->isoFormat('D MMMM Y, HH:mm') }} WIB
</div>

<div class="summary">
    <div class="summary-box"><div class="num">{{ $summary['total'] }}</div><div class="lbl">TOTAL</div></div>
    <div class="summary-box"><div class="num" style="color:#ca8a04">{{ $summary['dipinjam'] }}</div><div class="lbl">DIPINJAM</div></div>
    <div class="summary-box"><div class="num" style="color:#16a34a">{{ $summary['dikembalikan'] }}</div><div class="lbl">DIKEMBALIKAN</div></div>
    <div class="summary-box"><div class="num" style="color:#dc2626">{{ $summary['terlambat'] }}</div><div class="lbl">TERLAMBAT</div></div>
</div>

<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Kode</th>
            <th>Nama Peminjam</th>
            <th>Jenis</th>
            <th>Barang</th>
            <th>Jml</th>
            <th>Tgl Pinjam</th>
            <th>Deadline</th>
            <th>Tgl Kembali</th>
            <th>Status</th>
            <th>Petugas</th>
        </tr>
    </thead>
    <tbody>
        @foreach($pinjamans as $i => $p)
        <tr>
            <td>{{ $i + 1 }}</td>
            <td>{{ $p->kode_pinjam }}</td>
            <td>{{ $p->nama_peminjam }}</td>
            <td>{{ $p->jenis_peminjam }}</td>
            <td>{{ Str::limit($p->barang->nama_barang, 25) }}</td>
            <td style="text-align:center">{{ $p->jumlah }}</td>
            <td>{{ $p->tanggal_pinjam->format('d/m/Y') }}</td>
            <td>{{ $p->tanggal_kembali_rencana->format('d/m/Y') }}</td>
            <td>{{ $p->tanggal_kembali_aktual ? $p->tanggal_kembali_aktual->format('d/m/Y') : '-' }}</td>
            <td>
                @if($p->status === 'Dipinjam')
                    <span class="badge-dipinjam">Dipinjam</span>
                @elseif($p->status === 'Dikembalikan')
                    <span class="badge-kembali">Dikembalikan</span>
                @else
                    <span class="badge-terlambat">Terlambat</span>
                @endif
            </td>
            <td>{{ $p->petugas?->name ?? 'Mandiri' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="footer">
    <span>Laporan ini digenerate otomatis oleh Sistem Inventaris SMK Bakti Nusantara 666</span>
    <span>Total: {{ $pinjamans->count() }} record</span>
</div>
</body>
</html>
