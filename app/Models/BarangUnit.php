<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangUnit extends Model
{
    use HasFactory;

    protected $table = 'barang_units';

    protected $fillable = [
        'barang_id',
        'kode_unit',
        'nomor_unit',
        'kondisi',
        'status',
        'keterangan',
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    public function pinjamans()
    {
        return $this->hasMany(Pinjaman::class, 'barang_unit_id');
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

    public function getStatusBadgeAttribute(): string
    {
        return match ($this->status) {
            'Tersedia' => 'success',
            'Dipinjam' => 'warning',
            'Rusak' => 'danger',
            default => 'secondary',
        };
    }

    // Generate kode unit otomatis: BRG-001 + nomor -> BRG-001-01
    public static function generateKode(string $kodeBarang, int $nomorUnit): string
    {
        return $kodeBarang.'-'.str_pad($nomorUnit, 2, '0', STR_PAD_LEFT);
    }
}
