<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_ruangan',
        'nama_ruangan',
        'lokasi',
        'keterangan',
    ];

    public function barangs()
    {
        return $this->hasMany(Barang::class);
    }
}
