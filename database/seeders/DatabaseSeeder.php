<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ── 1. Users ─────────────────────────────────────────────────
        User::firstOrCreate(
            ['email' => 'admin@smkbaktinusantara.sch.id'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]
        );

        User::firstOrCreate(
            ['email' => 'budi@smkbaktinusantara.sch.id'],
            [
                'name' => 'Budi Santoso',
                'password' => Hash::make('petugas123'),
                'role' => 'petugas',
            ]
        );

        User::firstOrCreate(
            ['email' => 'sari@smkbaktinusantara.sch.id'],
            [
                'name' => 'Sari Dewi',
                'password' => Hash::make('petugas123'),
                'role' => 'petugas',
            ]
        );

        // ── 2. Master Siswa ──────────────────────────────────────────
        $this->call(SiswaSeeder::class);

        // ── 3. Master Inventaris (Kategori, Ruangan, Barang & Pinjaman)
        $this->call(BarangSeeder::class);

        $this->command->info('✓ Seeder database berhasil dijalankan lengkap!');
        $this->command->info('  Admin   : admin@smkbaktinusantara.sch.id / admin123');
        $this->command->info('  Petugas : budi@smkbaktinusantara.sch.id / petugas123');
    }
}
