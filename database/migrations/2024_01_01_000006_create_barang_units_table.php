<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('barang_units', function (Blueprint $table) {
            $table->id();
            $table->foreignId('barang_id')->constrained('barangs')->onDelete('cascade');
            $table->string('kode_unit')->unique(); // contoh: BRG-001-01
            $table->integer('nomor_unit');          // 1, 2, 3, ...
            $table->enum('kondisi', ['Baik', 'Rusak Ringan', 'Rusak Berat'])->default('Baik');
            $table->enum('status', ['Tersedia', 'Dipinjam', 'Rusak'])->default('Tersedia');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });

        // Kolom di pinjamans: ganti barang_id -> barang_unit_id, hapus kolom jumlah
        Schema::table('pinjamans', function (Blueprint $table) {
            $table->foreignId('barang_unit_id')
                ->nullable()
                ->after('barang_id')
                ->constrained('barang_units')
                ->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::table('pinjamans', function (Blueprint $table) {
            $table->dropForeign(['barang_unit_id']);
            $table->dropColumn('barang_unit_id');
        });
        Schema::dropIfExists('barang_units');
    }
};
