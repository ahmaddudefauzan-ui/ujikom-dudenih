<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('barangs')
            ->whereRaw('stok_tersedia > stok_total')
            ->update(['stok_tersedia' => DB::raw('stok_total')]);
    }

    public function down(): void {}
};
