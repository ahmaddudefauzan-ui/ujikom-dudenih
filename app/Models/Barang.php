<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'kategori_id',
        'ruangan_id',
        'stok_total',
        'stok_tersedia',
        'kondisi',
        'merk',
        'tahun_pengadaan',
        'keterangan',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class);
    }

    public function units()
    {
        return $this->hasMany(BarangUnit::class);
    }

    public function pinjamans()
    {
        return $this->hasMany(Pinjaman::class);
    }

    public function getKondisiBadgeAttribute(): string
    {
        return match ($this->kondisi) {
            'Baik' => 'success',
            'Rusak Ringan' => 'warning',
            'Rusak Berat' => 'danger',
            default => 'secondary',
        };
    }

    // Sinkronkan stok dari tabel units jika ada, atau pastikan konsistensi stok
    public function syncStok(): void
    {
        if ($this->units()->exists()) {
            $this->stok_total = $this->units()->count();
            $this->stok_tersedia = min($this->stok_total, $this->units()->where('status', 'Tersedia')->count());
        } else {
            if ($this->stok_tersedia > $this->stok_total) {
                $this->stok_tersedia = $this->stok_total;
            }
        }
        $this->saveQuietly();
    }

    // Generate units otomatis saat stok ditambah
    public function generateUnits(int $jumlah): void
    {
        $existing = $this->units()->max('nomor_unit') ?? 0;
        for ($i = 1; $i <= $jumlah; $i++) {
            $no = $existing + $i;
            BarangUnit::create([
                'barang_id' => $this->id,
                'kode_unit' => BarangUnit::generateKode($this->kode_barang, $no),
                'nomor_unit' => $no,
                'kondisi' => 'Baik',
                'status' => 'Tersedia',
            ]);
        }
        $this->syncStok();
    }
}
