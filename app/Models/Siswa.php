<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nis',
        'nama_lengkap',
        'jenis_kelamin',
        'kelas',
        'jurusan',
        'tingkat',
        'wali_kelas',
    ];

    protected static function booted(): void
    {
        static::saving(function (Siswa $siswa) {
            if ($siswa->nis) {
                $siswa->nis = trim($siswa->nis);
            }
            if ($siswa->nama_lengkap) {
                $siswa->nama_lengkap = static::sanitizeNama($siswa->nama_lengkap);
            }
            if ($siswa->kelas) {
                $siswa->kelas = trim(preg_replace('/\s+/', ' ', $siswa->kelas));
            }
            if ($siswa->jurusan) {
                $siswa->jurusan = trim(preg_replace('/\s+/', ' ', $siswa->jurusan));
            }
            if ($siswa->wali_kelas) {
                $siswa->wali_kelas = trim(preg_replace('/\s+/', ' ', $siswa->wali_kelas));
            }
        });
    }

    /**
     * Format Indonesian names properly into Title Case and normalize hyphens & apostrophes.
     */
    public static function sanitizeNama(string $name): string
    {
        $name = preg_replace('/\s*-\s*/', '-', $name);
        $name = preg_replace('/\s+/', ' ', trim($name));

        $words = explode(' ', $name);
        $formattedWords = [];

        foreach ($words as $word) {
            if (str_contains($word, '-')) {
                $parts = explode('-', $word);
                $formattedParts = array_map(fn ($p) => ucfirst(strtolower($p)), $parts);
                $formattedWords[] = implode('-', $formattedParts);

                continue;
            }

            if (str_contains($word, "'")) {
                $parts = explode("'", $word);
                $formattedParts = [];
                foreach ($parts as $idx => $p) {
                    $formattedParts[] = $idx === 0 ? ucfirst(strtolower($p)) : strtolower($p);
                }
                $formattedWords[] = implode("'", $formattedParts);

                continue;
            }

            if (preg_match('/^[A-Za-z]\.$/', $word)) {
                $formattedWords[] = strtoupper($word);

                continue;
            }

            if (in_array(strtoupper($word), ['TS', 'A', 'H'])) {
                $formattedWords[] = strtoupper($word);

                continue;
            }

            $formattedWords[] = ucfirst(strtolower($word));
        }

        return implode(' ', $formattedWords);
    }

    public function getJenisKelaminLabelAttribute(): string
    {
        return $this->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan';
    }

    public function getJenisKelaminBadgeClassAttribute(): string
    {
        return $this->jenis_kelamin === 'L' ? 'info' : 'warning';
    }

    public function getTingkatBadgeClassAttribute(): string
    {
        return match ($this->tingkat) {
            'X' => 'primary',
            'XI' => 'success',
            'XII' => 'warning',
            default => 'secondary',
        };
    }

    public function getInitialsAttribute(): string
    {
        $parts = preg_split('/\s+/', trim($this->nama_lengkap));
        if (empty($parts[0])) {
            return 'S';
        }
        if (count($parts) === 1) {
            return strtoupper(substr($parts[0], 0, 2));
        }

        return strtoupper(substr($parts[0], 0, 1).substr(end($parts), 0, 1));
    }
}
