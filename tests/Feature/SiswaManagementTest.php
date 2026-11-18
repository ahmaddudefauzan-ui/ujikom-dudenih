<?php

namespace Tests\Feature;

use App\Models\Siswa;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SiswaManagementTest extends TestCase
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

    public function test_admin_can_view_siswa_index(): void
    {
        Siswa::create([
            'nis' => '2627020070001',
            'nama_lengkap' => 'Abdilah Malik Al-Jabbar',
            'jenis_kelamin' => 'L',
            'kelas' => 'X PPLG 1',
            'jurusan' => 'Rekayasa Perangkat Lunak',
            'tingkat' => 'X',
            'wali_kelas' => 'Rima Permata Ellya, S.Pd.',
        ]);

        $response = $this->actingAs($this->admin)->get(route('admin.siswa.index'));

        $response->assertStatus(200);
        $response->assertSee('Abdilah Malik Al-Jabbar');
        $response->assertSee('2627020070001');
    }

    public function test_admin_can_filter_and_search_siswa(): void
    {
        Siswa::create([
            'nis' => '2627020070001',
            'nama_lengkap' => 'Abdilah Malik Al-Jabbar',
            'jenis_kelamin' => 'L',
            'kelas' => 'X PPLG 1',
            'jurusan' => 'Rekayasa Perangkat Lunak',
            'tingkat' => 'X',
            'wali_kelas' => 'Rima Permata Ellya, S.Pd.',
        ]);

        Siswa::create([
            'nis' => '242510119001',
            'nama_lengkap' => 'Alfi Laila Kamil',
            'jenis_kelamin' => 'P',
            'kelas' => 'XII AKT',
            'jurusan' => 'Akuntansi dan Keuangan Lembaga',
            'tingkat' => 'XII',
            'wali_kelas' => 'Kania Rachmawati, S.Ag.',
        ]);

        // Search by name
        $response = $this->actingAs($this->admin)->get(route('admin.siswa.index', ['search' => 'Abdilah']));
        $response->assertSee('Abdilah Malik Al-Jabbar');
        $response->assertDontSee('Alfi Laila Kamil');

        // Filter by tingkat
        $responseTingkat = $this->actingAs($this->admin)->get(route('admin.siswa.index', ['tingkat' => 'XII']));
        $responseTingkat->assertSee('Alfi Laila Kamil');
        $responseTingkat->assertDontSee('Abdilah Malik Al-Jabbar');
    }

    public function test_creating_siswa_automatically_sanitizes_and_formats_name_and_nis(): void
    {
        $response = $this->actingAs($this->admin)->post(route('admin.siswa.store'), [
            'nis' => '  2627020070999  ',
            'nama_lengkap' => 'MUHAMMAD  NUFA  AL- QALAMI',
            'jenis_kelamin' => 'L',
            'kelas' => 'XI RPL 2',
            'jurusan' => 'Rekayasa Perangkat Lunak',
            'tingkat' => 'XI',
            'wali_kelas' => 'Ridwan Setiawan, S.Kom.I., M.Kom.',
        ]);

        $response->assertRedirect(route('admin.siswa.index'));

        $siswa = Siswa::where('nis', '2627020070999')->first();
        $this->assertNotNull($siswa);
        $this->assertEquals('2627020070999', $siswa->nis);
        $this->assertEquals('Muhammad Nufa Al-Qalami', $siswa->nama_lengkap);
    }

    public function test_updating_siswa_sanitizes_name_properly(): void
    {
        $siswa = Siswa::create([
            'nis' => '2627017084037',
            'nama_lengkap' => 'Saskia Nurul Baeti',
            'jenis_kelamin' => 'P',
            'kelas' => 'X DKV 1',
            'jurusan' => 'Desain Komunikasi Visual',
            'tingkat' => 'X',
            'wali_kelas' => 'Sony Syaupala, S.T.',
        ]);

        $response = $this->actingAs($this->admin)->put(route('admin.siswa.update', $siswa), [
            'nis' => '2627017084037',
            'nama_lengkap' => 'SASKIA  NUR\'AINI  AN-NAZWA',
            'jenis_kelamin' => 'P',
            'kelas' => 'XII ANIMASI',
            'jurusan' => 'Animasi',
            'tingkat' => 'XII',
            'wali_kelas' => 'Syifa Alfi Syahr, S.Kom.',
        ]);

        $response->assertRedirect(route('admin.siswa.index'));

        $siswa->refresh();
        $this->assertEquals("Saskia Nur'aini An-Nazwa", $siswa->nama_lengkap);
        $this->assertEquals('XII ANIMASI', $siswa->kelas);
    }

    public function test_admin_can_delete_siswa(): void
    {
        $siswa = Siswa::create([
            'nis' => '2627020070001',
            'nama_lengkap' => 'Abdilah Malik Al-Jabbar',
            'jenis_kelamin' => 'L',
            'kelas' => 'X PPLG 1',
            'jurusan' => 'Rekayasa Perangkat Lunak',
            'tingkat' => 'X',
            'wali_kelas' => 'Rima Permata Ellya, S.Pd.',
        ]);

        $response = $this->actingAs($this->admin)->delete(route('admin.siswa.destroy', $siswa));

        $response->assertRedirect(route('admin.siswa.index'));
        $this->assertDatabaseMissing('siswas', ['id' => $siswa->id]);
    }

    public function test_autocomplete_api_returns_neat_siswa_data(): void
    {
        Siswa::create([
            'nis' => '2627020070001',
            'nama_lengkap' => 'Abdilah Malik Al-Jabbar',
            'jenis_kelamin' => 'L',
            'kelas' => 'X PPLG 1',
            'jurusan' => 'Rekayasa Perangkat Lunak',
            'tingkat' => 'X',
            'wali_kelas' => 'Rima Permata Ellya, S.Pd.',
        ]);

        $response = $this->getJson(route('api.siswa', ['q' => 'Abdilah']));

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'nis' => '2627020070001',
            'nama_lengkap' => 'Abdilah Malik Al-Jabbar',
            'kelas' => 'X PPLG 1',
        ]);
    }
}
