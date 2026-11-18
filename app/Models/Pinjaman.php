<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pinjaman extends Model
{
    use HasFactory;

    protected $table = 'pinjamans';

    protected $fillable = [
        'kode_pinjam',
        'nama_peminjam',
        'no_identitas',
        'jenis_peminjam',
        'no_hp',
        'barang_id',
        'barang_unit_id',
        'jumlah',
        'tanggal_pinjam',
        'tanggal_kembali_rencana',
        'tanggal_kembali_aktual',
        'status',
        'keperluan',
        'catatan',
        'petugas_id',
    ];

    protected $casts = [
        'tanggal_pinjam' => 'date',
        'tanggal_kembali_rencana' => 'date',
        'tanggal_kembali_aktual' => 'date',
    ];

    public function barangUnit()
    {
        return $this->belongsTo(BarangUnit::class, 'barang_unit_id');
    }

    // Akses barang master via unit
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }

    public function petugas()
    {
        return $this->belongsTo(User::class, 'petugas_id');
    }

    public function getStatusBadgeAttribute(): string
    {
        return match ($this->status) {
            'Dipinjam' => 'warning',
            'Dikembalikan' => 'success',
            'Terlambat' => 'danger',
            default => 'secondary',
        };
    }

    public static function generateKode(): string
    {
        $max = self::selectRaw('MAX(CAST(SUBSTRING(kode_pinjam, 5) AS UNSIGNED)) as max_no')
            ->value('max_no');

        $next = ($max ?? 0) + 1;

        do {
            $kode = 'PJM-'.str_pad($next, 5, '0', STR_PAD_LEFT);
            $exists = self::where('kode_pinjam', $kode)->exists();
            if ($exists) {
                $next++;
            }
        } while ($exists);

        return $kode;
    }
}
