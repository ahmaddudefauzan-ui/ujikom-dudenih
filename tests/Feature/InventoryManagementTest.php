<?php

namespace Tests\Feature;

use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Pinjaman;
use App\Models\Ruangan;
use App\Models\User;
use Database\Seeders\BarangSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InventoryManagementTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->create([
            'role' => 'admin',
        ]);
    }

    public function test_barang_seeder_populates_59_rooms_3_categories_and_129_items(): void
    {
        $this->seed(BarangSeeder::class);

        $this->assertEquals(3, Kategori::count());
        $this->assertEquals(59, Ruangan::count());
        $this->assertEquals(129, Barang::count());

        $this->assertDatabaseHas('kategoris', ['nama_kategori' => 'Perabotan']);
        $this->assertDatabaseHas('kategoris', ['nama_kategori' => 'Elektronik']);
        $this->assertDatabaseHas('kategoris', ['nama_kategori' => 'Alat Praktik / Lab']);

        $this->assertDatabaseHas('ruangans', ['kode_ruangan' => 'RG-001', 'nama_ruangan' => 'Kepala Sekolah']);
        $this->assertDatabaseHas('ruangans', ['kode_ruangan' => 'RG-014', 'nama_ruangan' => 'Lab 1 PPLG']);
        $this->assertDatabaseHas('ruangans', ['kode_ruangan' => 'RG-059', 'nama_ruangan' => 'Kelas Kosong Gd. Depan 4']);

        $this->assertDatabaseHas('barangs', ['kode_barang' => 'BRG-001', 'nama_barang' => 'Akrilik Nama']);
        $this->assertDatabaseHas('barangs', ['kode_barang' => 'BRG-052', 'nama_barang' => 'Laptop']);
        $this->assertDatabaseHas('barangs', ['kode_barang' => 'BRG-129', 'nama_barang' => 'Stik Kasti']);
    }

    public function test_admin_can_filter_barang_by_kategori_and_search(): void
    {
        $this->seed(BarangSeeder::class);

        // Filter by search
        $response = $this->actingAs($this->admin)->get(route('admin.barang.index', ['search' => 'Drone']));
        $response->assertStatus(200);
        $response->assertSee('Drone');
        $response->assertDontSee('Akrilik Nama');

        // Filter by category
        $kategoriElektronik = Kategori::where('nama_kategori', 'Elektronik')->first();
        $responseKat = $this->actingAs($this->admin)->get(route('admin.barang.index', ['kategori_id' => $kategoriElektronik->id]));
        $responseKat->assertStatus(200);
        $responseKat->assertSee('Interactive Flat Panel');
    }

    public function test_home_page_displays_available_items_for_loan(): void
    {
        $this->seed(BarangSeeder::class);

        $response = $this->get(route('home'));
        $response->assertStatus(200);
        $response->assertSee('Laptop');
        $response->assertSee('Interactive Flat Panel');
        $response->assertSee('Katalog Peralatan Siap Dipinjam');
    }

    public function test_user_can_submit_loan_request_from_beranda(): void
    {
        $this->seed(BarangSeeder::class);

        $barang = Barang::where('nama_barang', 'Laptop')->first();
        $initialStok = $barang->stok_tersedia;

        $response = $this->post(route('home.pinjam'), [
            'nama_peminjam' => 'Budi Prakoso',
            'no_identitas' => '2627020070002',
            'jenis_peminjam' => 'Siswa',
            'no_hp' => '081234567890',
            'barang_id' => $barang->id,
            'jumlah' => 1,
            'tanggal_kembali_rencana' => now()->addDays(2)->format('Y-m-d'),
            'keperluan' => 'Mengerjakan tugas kejuruan',
        ]);

        $response->assertRedirect(route('home'));
        $response->assertSessionHas('success_kode');

        $barang->refresh();
        $this->assertEquals($initialStok - 1, $barang->stok_tersedia);
    }

    public function test_user_can_track_loan_on_beranda(): void
    {
        $this->seed(BarangSeeder::class);

        $response = $this->get(route('home', ['kode_pinjam' => 'PJM-00001']));
        $response->assertStatus(200);
        $response->assertSee('PJM-00001');
        $response->assertSee('Abdilah Malik Al-Jabbar');
    }

    public function test_returning_loan_increments_stock_and_never_exceeds_stok_total(): void
    {
        $this->seed(BarangSeeder::class);

        $barang = Barang::where('nama_barang', 'Laptop')->first();
        $barang->update(['stok_total' => 10, 'stok_tersedia' => 9]);

        $petugas = User::where('role', 'petugas')->first();
        if (! $petugas) {
            $petugas = User::factory()->create(['role' => 'petugas']);
        }

        $pinjaman = Pinjaman::create([
            'kode_pinjam' => Pinjaman::generateKode(),
            'nama_peminjam' => 'Siswa Penguji',
            'no_identitas' => '12345',
            'jenis_peminjam' => 'Siswa',
            'no_hp' => '08123456789',
            'barang_id' => $barang->id,
            'jumlah' => 1,
            'tanggal_pinjam' => now(),
            'tanggal_kembali_rencana' => now()->addDays(2),
            'status' => 'Dipinjam',
            'petugas_id' => $petugas->id,
        ]);

        // Kembalikan pinjaman
        $response = $this->actingAs($petugas)->patch(route('petugas.pinjaman.proses-kembali', $pinjaman), [
            'tanggal_kembali_aktual' => now()->format('Y-m-d'),
            'catatan' => 'Kembali dalam kondisi baik',
        ]);

        $response->assertRedirect(route('petugas.pinjaman.index'));
        $response->assertSessionHas('success');

        $barang->refresh();
        $this->assertEquals(10, $barang->stok_tersedia);
        $this->assertLessThanOrEqual($barang->stok_total, $barang->stok_tersedia);

        // Uji jika jumlah pinjaman lebih besar (misal 5) dan stok awal 9 dari total 10:
        // stok_tersedia harus dibatasi maksimal 10, tidak boleh jadi 14 atau lebih
        $pinjamanBesar = Pinjaman::create([
            'kode_pinjam' => Pinjaman::generateKode(),
            'nama_peminjam' => 'Siswa Penguji 2',
            'no_identitas' => '12346',
            'jenis_peminjam' => 'Siswa',
            'no_hp' => '08123456788',
            'barang_id' => $barang->id,
            'jumlah' => 5,
            'tanggal_pinjam' => now(),
            'tanggal_kembali_rencana' => now()->addDays(2),
            'status' => 'Dipinjam',
            'petugas_id' => $petugas->id,
        ]);

        $barang->update(['stok_tersedia' => 9]);

        $this->actingAs($petugas)->patch(route('petugas.pinjaman.proses-kembali', $pinjamanBesar), [
            'tanggal_kembali_aktual' => now()->format('Y-m-d'),
        ]);

        $barang->refresh();
        $this->assertEquals(10, $barang->stok_tersedia, 'Stok tersedia tidak boleh melebihi stok total');
    }

    public function test_deleting_barang_with_active_loans_is_prevented_without_ambiguous_column_sql_error(): void
    {
        $this->seed(BarangSeeder::class);

        $barang = Barang::where('nama_barang', 'Laptop')->first();

        // Pastikan ada pinjaman aktif untuk barang ini
        $this->assertTrue($barang->pinjamans()->whereIn('pinjamans.status', ['Dipinjam', 'Terlambat'])->exists());

        // Coba hapus barang sebagai admin
        $response = $this->actingAs($this->admin)->delete(route('admin.barang.destroy', $barang));

        $response->assertSessionHas('error', 'Barang tidak dapat dihapus karena masih ada yang dipinjam.');
        $this->assertDatabaseHas('barangs', ['id' => $barang->id]);
    }

    public function test_deleting_barang_without_active_loans_succeeds(): void
    {
        $this->seed(BarangSeeder::class);

        $barang = Barang::create([
            'kode_barang' => 'BRG-999',
            'nama_barang' => 'Barang Bebas Pinjam',
            'kategori_id' => Kategori::first()->id,
            'ruangan_id' => Ruangan::first()->id,
            'stok_total' => 5,
            'stok_tersedia' => 5,
            'kondisi' => 'Baik',
        ]);

        $response = $this->actingAs($this->admin)->delete(route('admin.barang.destroy', $barang));

        $response->assertRedirect(route('admin.barang.index'));
        $response->assertSessionHas('success', 'Barang berhasil dihapus.');
        $this->assertDatabaseMissing('barangs', ['id' => $barang->id]);
    }
}
