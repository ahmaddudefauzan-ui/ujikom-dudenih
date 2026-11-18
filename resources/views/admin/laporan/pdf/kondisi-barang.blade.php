<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Laporan Kondisi Barang</title>
<style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body { font-family: Arial, sans-serif; font-size: 10px; color: #222; }
    .header { text-align: center; padding: 12px 0 8px; border-bottom: 2px solid #1a3a6e; margin-bottom: 10px; }
    .header h2 { font-size: 14px; color: #1a3a6e; }
    .header p  { font-size: 9px; color: #555; margin-top: 2px; }
    .meta { margin-bottom: 8px; font-size: 9px; color: #555; }
    .summary { display: flex; gap: 8px; margin-bottom: 10px; }
    .summary-box {
        flex: 1; border: 1px solid #ddd; border-radius: 4px;
        padding: 6px; text-align: center;
    }
    .summary-box .num { font-size: 16px; font-weight: bold; }
    .summary-box .lbl { font-size: 8px; color: #666; }
    .c-baik    { color: #16a34a; }
    .c-ringan  { color: #ca8a04; }
    .c-berat   { color: #dc2626; }
    table { width: 100%; border-collapse: collapse; }
    th { background: #1a3a6e; color: #fff; padding: 5px 4px; font-size: 9px; }
    td { padding: 4px; border-bottom: 1px solid #e5e7eb; font-size: 9px; }
    tr:nth-child(even) td { background: #f9fafb; }
    .badge-baik    { background: #dcfce7; color: #16a34a; padding: 1px 5px; border-radius: 3px; }
    .badge-ringan  { background: #fef3c7; color: #ca8a04; padding: 1px 5px; border-radius: 3px; }
    .badge-berat   { background: #fee2e2; color: #dc2626; padding: 1px 5px; border-radius: 3px; }
    .footer { margin-top: 15px; border-top: 1px solid #ddd; padding-top: 6px; font-size: 8px; color: #888; display: flex; justify-content: space-between; }
</style>
</head>
<body>
<div class="header">
    <h2>LAPORAN KONDISI BARANG INVENTARIS</h2>
    <p>SMK Bakti Nusantara 666</p>
</div>

<div class="meta">
    <strong>Filter:</strong> {{ $filterLabel }} &nbsp;&nbsp;|&nbsp;&nbsp;
    <strong>Tanggal Cetak:</strong> {{ now()->isoFormat('D MMMM Y, HH:mm') }} WIB
</div>

<div class="summary">
    <div class="summary-box"><div class="num">{{ $summary['total'] }}</div><div class="lbl">TOTAL</div></div>
    <div class="summary-box"><div class="num c-baik">{{ $summary['baik'] }}</div><div class="lbl">BAIK</div></div>
    <div class="summary-box"><div class="num c-ringan">{{ $summary['rusak_ringan'] }}</div><div class="lbl">RUSAK RINGAN</div></div>
    <div class="summary-box"><div class="num c-berat">{{ $summary['rusak_berat'] }}</div><div class="lbl">RUSAK BERAT</div></div>
</div>

<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Kode Barang</th>
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
        @foreach($barangs as $i => $b)
        <tr>
            <td>{{ $i + 1 }}</td>
            <td>{{ $b->kode_barang }}</td>
            <td>{{ $b->nama_barang }}</td>
            <td>{{ $b->kategori->nama_kategori }}</td>
            <td>{{ $b->ruangan->nama_ruangan }}</td>
            <td style="text-align:center">{{ $b->stok_total }}</td>
            <td style="text-align:center">{{ $b->stok_tersedia }}</td>
            <td>
                @if($b->kondisi === 'Baik')
                    <span class="badge-baik">Baik</span>
                @elseif($b->kondisi === 'Rusak Ringan')
                    <span class="badge-ringan">Rusak Ringan</span>
                @else
                    <span class="badge-berat">Rusak Berat</span>
                @endif
            </td>
            <td>{{ $b->merk ?? '-' }}</td>
            <td>{{ $b->tahun_pengadaan ?? '-' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="footer">
    <span>Laporan ini digenerate otomatis oleh Sistem Inventaris SMK Bakti Nusantara 666</span>
    <span>Halaman 1</span>
</div>
</body>
</html>
