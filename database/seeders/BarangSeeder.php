<?php

namespace Database\Seeders;

use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Pinjaman;
use App\Models\Ruangan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class BarangSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Pinjaman::truncate();
        Barang::truncate();
        Ruangan::truncate();
        Kategori::truncate();
        Schema::enableForeignKeyConstraints();

        // ─────────────────────────────────────────────────────────────
        // 1. KATEGORI (3 Kategori sesuai data master sekolah)
        // ─────────────────────────────────────────────────────────────
        $kategorisData = [
            'Perabotan' => [
                'nama_kategori' => 'Perabotan',
                'keterangan' => 'Meja, kursi, lemari, rak, perabot kantor dan ruang kelas',
            ],
            'Elektronik' => [
                'nama_kategori' => 'Elektronik',
                'keterangan' => 'Perangkat elektronik, display visual, pendingin ruangan, audio dan kelistrikan',
            ],
            'Alat Praktik / Lab' => [
                'nama_kategori' => 'Alat Praktik / Lab',
                'keterangan' => 'Peralatan praktikum komputer, studio foto, multimedia, sablon, cetak, seni, dan olahraga',
            ],
        ];

        $kategoriMap = [];
        foreach ($kategorisData as $key => $kat) {
            $kategoriMap[$key] = Kategori::create($kat);
        }

        // ─────────────────────────────────────────────────────────────
        // 2. RUANGAN (59 Ruangan lengkap sesuai data master)
        // ─────────────────────────────────────────────────────────────
        $ruangansData = [
            ['kode_ruangan' => 'RG-001', 'nama_ruangan' => 'Kepala Sekolah', 'lokasi' => 'Gedung A, Lantai 1'],
            ['kode_ruangan' => 'RG-002', 'nama_ruangan' => 'Guru dan Wks. Kurikulum', 'lokasi' => 'Gedung A, Lantai 1'],
            ['kode_ruangan' => 'RG-003', 'nama_ruangan' => 'Wks. Kesiswaan dan BK', 'lokasi' => 'Gedung A, Lantai 1'],
            ['kode_ruangan' => 'RG-004', 'nama_ruangan' => 'Wks. Hubin dan BKK', 'lokasi' => 'Gedung A, Lantai 1'],
            ['kode_ruangan' => 'RG-005', 'nama_ruangan' => 'TU Keuangan', 'lokasi' => 'Gedung A, Lantai 1'],
            ['kode_ruangan' => 'RG-006', 'nama_ruangan' => 'TU Administrasi', 'lokasi' => 'Gedung A, Lantai 1'],
            ['kode_ruangan' => 'RG-007', 'nama_ruangan' => 'UKS', 'lokasi' => 'Gedung A, Lantai 1'],
            ['kode_ruangan' => 'RG-008', 'nama_ruangan' => 'OSIS', 'lokasi' => 'Gedung A, Lantai 1'],
            ['kode_ruangan' => 'RG-009', 'nama_ruangan' => 'Pramuka', 'lokasi' => 'Gedung A, Lantai 1'],
            ['kode_ruangan' => 'RG-010', 'nama_ruangan' => 'Paskibra', 'lokasi' => 'Gedung A, Lantai 1'],
            ['kode_ruangan' => 'RG-011', 'nama_ruangan' => 'Kantor Perusahaan DUDI', 'lokasi' => 'Gedung A, Lantai 2'],
            ['kode_ruangan' => 'RG-012', 'nama_ruangan' => 'Sarana Prasarana dan Gudang', 'lokasi' => 'Gedung A, Lantai 2'],
            ['kode_ruangan' => 'RG-013', 'nama_ruangan' => 'IT Support', 'lokasi' => 'Gedung A, Lantai 2'],
            ['kode_ruangan' => 'RG-014', 'nama_ruangan' => 'Lab 1 PPLG', 'lokasi' => 'Gedung B, Lantai 1'],
            ['kode_ruangan' => 'RG-015', 'nama_ruangan' => 'Lab 2 PPLG', 'lokasi' => 'Gedung B, Lantai 1'],
            ['kode_ruangan' => 'RG-016', 'nama_ruangan' => 'Lab 3D Animasi', 'lokasi' => 'Gedung B, Lantai 2'],
            ['kode_ruangan' => 'RG-017', 'nama_ruangan' => 'Lab Gambar', 'lokasi' => 'Gedung B, Lantai 2'],
            ['kode_ruangan' => 'RG-018', 'nama_ruangan' => 'Lab DKV', 'lokasi' => 'Gedung B, Lantai 2'],
            ['kode_ruangan' => 'RG-019', 'nama_ruangan' => 'Lab Akuntansi', 'lokasi' => 'Gedung B, Lantai 3'],
            ['kode_ruangan' => 'RG-020', 'nama_ruangan' => 'Lab Bahasa', 'lokasi' => 'Gedung B, Lantai 3'],
            ['kode_ruangan' => 'RG-021', 'nama_ruangan' => 'Lab Pemasaran', 'lokasi' => 'Gedung B, Lantai 3'],
            ['kode_ruangan' => 'RG-022', 'nama_ruangan' => 'Lab PPLG 3', 'lokasi' => 'Gedung C, Lantai 1'],
            ['kode_ruangan' => 'RG-023', 'nama_ruangan' => 'Lab PPLG 4', 'lokasi' => 'Gedung C, Lantai 1'],
            ['kode_ruangan' => 'RG-024', 'nama_ruangan' => 'Lab PPLG 5', 'lokasi' => 'Gedung C, Lantai 1'],
            ['kode_ruangan' => 'RG-025', 'nama_ruangan' => 'Lab PPLG IoT', 'lokasi' => 'Gedung C, Lantai 1'],
            ['kode_ruangan' => 'RG-026', 'nama_ruangan' => 'Lab Broadcast', 'lokasi' => 'Gedung C, Lantai 2'],
            ['kode_ruangan' => 'RG-027', 'nama_ruangan' => 'Sablon', 'lokasi' => 'Gedung C, Lantai 2'],
            ['kode_ruangan' => 'RG-028', 'nama_ruangan' => 'Lab Cetak', 'lokasi' => 'Gedung C, Lantai 2'],
            ['kode_ruangan' => 'RG-029', 'nama_ruangan' => 'Studio Foto', 'lokasi' => 'Gedung C, Lantai 2'],
            ['kode_ruangan' => 'RG-030', 'nama_ruangan' => 'Kesenian', 'lokasi' => 'Gedung D, Lantai 1'],
            ['kode_ruangan' => 'RG-031', 'nama_ruangan' => 'Perpustakaan', 'lokasi' => 'Gedung D, Lantai 2'],
            ['kode_ruangan' => 'RG-032', 'nama_ruangan' => 'XII Akuntansi 1', 'lokasi' => 'Gedung Teori, Lantai 3'],
            ['kode_ruangan' => 'RG-033', 'nama_ruangan' => 'XII Akuntansi 2', 'lokasi' => 'Gedung Teori, Lantai 3'],
            ['kode_ruangan' => 'RG-034', 'nama_ruangan' => 'XII DKV', 'lokasi' => 'Gedung Teori, Lantai 3'],
            ['kode_ruangan' => 'RG-035', 'nama_ruangan' => 'XII Animasi', 'lokasi' => 'Gedung Teori, Lantai 3'],
            ['kode_ruangan' => 'RG-036', 'nama_ruangan' => 'Gudang Kursi Belakang', 'lokasi' => 'Gedung Belakang'],
            ['kode_ruangan' => 'RG-037', 'nama_ruangan' => 'XII PPLG 1', 'lokasi' => 'Gedung Teori, Lantai 3'],
            ['kode_ruangan' => 'RG-038', 'nama_ruangan' => 'XII PPLG 2', 'lokasi' => 'Gedung Teori, Lantai 3'],
            ['kode_ruangan' => 'RG-039', 'nama_ruangan' => 'XI AKT', 'lokasi' => 'Gedung Teori, Lantai 2'],
            ['kode_ruangan' => 'RG-040', 'nama_ruangan' => 'Ruang Kosong 1', 'lokasi' => 'Gedung Teori, Lantai 2'],
            ['kode_ruangan' => 'RG-041', 'nama_ruangan' => 'XI PPLG 1', 'lokasi' => 'Gedung Teori, Lantai 2'],
            ['kode_ruangan' => 'RG-042', 'nama_ruangan' => 'XI PPLG 2', 'lokasi' => 'Gedung Teori, Lantai 2'],
            ['kode_ruangan' => 'RG-043', 'nama_ruangan' => 'X PPLG 1', 'lokasi' => 'Gedung Teori, Lantai 1'],
            ['kode_ruangan' => 'RG-044', 'nama_ruangan' => 'X PPLG 2', 'lokasi' => 'Gedung Teori, Lantai 1'],
            ['kode_ruangan' => 'RG-045', 'nama_ruangan' => 'XI DKV', 'lokasi' => 'Gedung Teori, Lantai 2'],
            ['kode_ruangan' => 'RG-046', 'nama_ruangan' => 'XI Animasi', 'lokasi' => 'Gedung Teori, Lantai 2'],
            ['kode_ruangan' => 'RG-047', 'nama_ruangan' => 'X DKV 2', 'lokasi' => 'Gedung Teori, Lantai 1'],
            ['kode_ruangan' => 'RG-048', 'nama_ruangan' => 'X DKV 1', 'lokasi' => 'Gedung Teori, Lantai 1'],
            ['kode_ruangan' => 'RG-049', 'nama_ruangan' => 'Ruang Kosong 2', 'lokasi' => 'Gedung Teori, Lantai 3'],
            ['kode_ruangan' => 'RG-050', 'nama_ruangan' => 'X Akuntansi 2', 'lokasi' => 'Gedung Teori, Lantai 1'],
            ['kode_ruangan' => 'RG-051', 'nama_ruangan' => 'Gudang Kursi Depan', 'lokasi' => 'Gedung Depan'],
            ['kode_ruangan' => 'RG-052', 'nama_ruangan' => 'X Akuntansi 1', 'lokasi' => 'Gedung Teori, Lantai 1'],
            ['kode_ruangan' => 'RG-053', 'nama_ruangan' => 'Kelas Kosong 1', 'lokasi' => 'Gedung Teori, Lantai 2'],
            ['kode_ruangan' => 'RG-054', 'nama_ruangan' => 'Kelas Kosong 2', 'lokasi' => 'Gedung Teori, Lantai 2'],
            ['kode_ruangan' => 'RG-055', 'nama_ruangan' => 'Kelas Kosong 3', 'lokasi' => 'Gedung Teori, Lantai 2'],
            ['kode_ruangan' => 'RG-056', 'nama_ruangan' => 'Kelas Kosong Gd. Depan 1', 'lokasi' => 'Gedung Depan, Lantai 1'],
            ['kode_ruangan' => 'RG-057', 'nama_ruangan' => 'Kelas Kosong Gd. Depan 2', 'lokasi' => 'Gedung Depan, Lantai 1'],
            ['kode_ruangan' => 'RG-058', 'nama_ruangan' => 'Kelas Kosong Gd. Depan 3', 'lokasi' => 'Gedung Depan, Lantai 2'],
            ['kode_ruangan' => 'RG-059', 'nama_ruangan' => 'Kelas Kosong Gd. Depan 4', 'lokasi' => 'Gedung Depan, Lantai 2'],
        ];

        $ruanganMap = [];
        foreach ($ruangansData as $r) {
            $ruanganMap[$r['kode_ruangan']] = Ruangan::create($r);
        }

        // ─────────────────────────────────────────────────────────────
        // 3. BARANG (129 Barang lengkap sesuai data master)
        // ─────────────────────────────────────────────────────────────

        // Kelompok A: Perabotan (22 Barang: BRG-001 s.d. BRG-022)
        $perabotanList = [
            ['Akrilik Nama', 'RG-001', 10, 10, 'Baik', 'Custom Akrilik', 2023, 'Papan nama meja kantor pimpinan'],
            ['Filling Cabinet', 'RG-006', 8, 8, 'Baik', 'Lion 4 Laci', 2022, 'Lemari arsip besi tahan api'],
            ['Kursi Guru', 'RG-002', 45, 42, 'Baik', 'Chitose Beroda', 2023, 'Kursi kerja putar busa tebal'],
            ['Kursi Rapat', 'RG-002', 30, 28, 'Baik', 'Chitose Lipat', 2022, 'Kursi rapat susun busa'],
            ['Kursi Siswa', 'RG-036', 150, 140, 'Baik', 'Futura F-101', 2023, 'Kursi susun besi chrome ruang kelas'],
            ['Lemari Alat Bahan', 'RG-012', 6, 6, 'Baik', 'Alba Kaca Besi', 2021, 'Penyimpanan perlengkapan dan bahan'],
            ['Lemari Arsip', 'RG-005', 10, 9, 'Baik', 'Brother B-203', 2022, 'Penyimpanan berkas keuangan dan dinas'],
            ['Loker Guru', 'RG-002', 4, 4, 'Baik', 'Kozure 12 Pintu', 2023, 'Loker pribadi dewan guru'],
            ['Meja Guru', 'RG-002', 35, 35, 'Baik', 'Olympic 1/2 Biro', 2022, 'Meja kerja kayu laci kunci'],
            ['Meja Kerja', 'RG-006', 15, 15, 'Baik', 'Modera Modern', 2023, 'Meja staff administrasi dan TU'],
            ['Meja Komputer', 'RG-014', 70, 68, 'Baik', 'Lunar LMC-80', 2023, 'Meja sekat kabel untuk laboratorium'],
            ['Meja Produksi', 'RG-028', 6, 6, 'Baik', 'Kayu Solid Custom', 2022, 'Meja kerja produksi cetak dan jilid'],
            ['Meja Rapat', 'RG-002', 4, 4, 'Baik', 'Expo Oval Modular', 2021, 'Meja konferensi ruang guru'],
            ['Meja Siswa', 'RG-036', 120, 115, 'Baik', 'Futura M-201', 2023, 'Meja rangka besi papan kayu siswa'],
            ['Papan Pengumuman', 'RG-006', 5, 5, 'Baik', 'Sakana Bludru', 2022, 'Papan info kaca geser kunci'],
            ['Papan Tulis', 'RG-043', 25, 24, 'Baik', 'Sakana Magnetik 120x240', 2023, 'Whiteboard gantung ruang kelas'],
            ['Rak Piala', 'RG-008', 3, 3, 'Baik', 'Aluminium Kaca', 2020, 'Lemari display prestasi siswa'],
            ['Sofa Tamu', 'RG-001', 3, 3, 'Baik', 'Informa 3-2-1', 2022, 'Sofa tamu kulit sintetis ruang kepala sekolah'],
            ['Tong Sampah', 'RG-012', 40, 38, 'Baik', 'Maspion 50L', 2024, 'Tempat sampah injak organik dan anorganik'],
            ['Ranjang dan Kasur', 'RG-007', 4, 4, 'Baik', 'Elite Medical Foam', 2023, 'Ranjang periksa UKS sprei putih'],
            ['Sapu', 'RG-012', 30, 28, 'Baik', 'Dragon Nilon', 2024, 'Sapu lantai nilon gagang pipa'],
            ['Lap Pel', 'RG-012', 25, 22, 'Baik', 'Scotch-Brite Cotton', 2024, 'Alat pel lantai katun jepit'],
        ];

        // Kelompok B: Elektronik (20 Barang: BRG-023 s.d. BRG-042)
        $elektronikList = [
            ['Interactive Flat Panel', 'RG-014', 2, 2, 'Baik', 'ViewSonic IFP6550 65"', 2024, 'Layar sentuh interaktif presentasi lab'],
            ['AC', 'RG-014', 18, 16, 'Baik', 'Daikin Inverter 2 PK', 2023, 'Pendingin ruangan laboratorium dan kantor'],
            ['CCTV', 'RG-013', 24, 22, 'Baik', 'Hikvision 4MP IP Cam', 2023, 'Kamera pengawas keamanan lingkungan'],
            ['Dispenser', 'RG-002', 8, 7, 'Baik', 'Miyako Galon Bawah', 2023, 'Dispenser air minum panas dan dingin'],
            ['Kipas Angin / Exhaust Fan', 'RG-027', 12, 11, 'Baik', 'Panasonic FV-25RUN', 2022, 'Ventilasi udara ruang sablon dan lab'],
            ['Layar Proyektor', 'RG-015', 8, 7, 'Baik', 'D-Light Motorized 84"', 2023, 'Screen proyektor gantung otomatis'],
            ['Mesin Fotokopi', 'RG-006', 2, 2, 'Baik', 'Canon imageRUNNER 2625i', 2022, 'Mesin pengganda dokumen perkantoran'],
            ['Microphone', 'RG-026', 10, 8, 'Baik', 'Shure SM58-LC', 2023, 'Mikrofon vokal dinamis berkabel'],
            ['Mixer Suara', 'RG-030', 3, 3, 'Baik', 'Yamaha MG12XU', 2023, 'Mixer audio konsol 12 kanal'],
            ['Printer', 'RG-005', 10, 9, 'Baik', 'Epson EcoTank L3210', 2023, 'Printer multifungsi print scan copy'],
            ['Proyektor / Infokus', 'RG-014', 12, 10, 'Baik', 'Epson EB-E500 3300 Lumens', 2023, 'Proyektor presentasi pembelajaran'],
            ['Scanner', 'RG-006', 4, 4, 'Baik', 'Canon CanoScan LiDE 300', 2022, 'Scanner flatbed resolusi tinggi'],
            ['Telepon Kantor', 'RG-006', 6, 6, 'Baik', 'Panasonic KX-TS505', 2021, 'Telepon analog PABX antar ruang'],
            ['TV', 'RG-001', 5, 5, 'Baik', 'Samsung Smart TV 43"', 2023, 'Televisi display informasi sekolah'],
            ['Sound Sistem', 'RG-030', 2, 2, 'Baik', 'Behringer Europort PPA2000BT', 2022, 'Sistem pengeras suara lapangan dan aula'],
            ['Ampli Gitar', 'RG-030', 3, 2, 'Baik', 'Marshall MG30FX 30 Watt', 2022, 'Amplifier instrumen gitar elektrik'],
            ['Speaker Portable', 'RG-012', 5, 4, 'Baik', 'Baretone MAX-15AL 15"', 2023, 'Speaker troli wireless mic aki'],
            ['Handphone', 'RG-004', 3, 3, 'Baik', 'Samsung Galaxy A15', 2023, 'Smartphone operasional humas dan BKK'],
            ['Speaker Kecil', 'RG-003', 6, 5, 'Baik', 'Simbadda CST-1100N', 2023, 'Speaker multimedia ruang BK dan UKS'],
            ['Terminal Stop Kontak', 'RG-013', 35, 32, 'Baik', 'Uticon 5 Lubang + Saklar', 2024, 'Kabel rol dan colokan ekstensi lab'],
        ];

        // Kelompok C: Alat Praktik / Lab (87 Barang: BRG-043 s.d. BRG-129)
        $alatPraktikList = [
            ['Komputer Akuntansi', 'RG-019', 36, 35, 'Baik', 'Lenovo ThinkCentre Neo 50t', 2023, 'PC praktikum MYOB dan spreadsheet'],
            ['Komputer Animasi', 'RG-016', 36, 34, 'Baik', 'Asus ROG Strix RTX 3060', 2023, 'Workstation rendering 3D Blender'],
            ['Komputer DKV', 'RG-018', 36, 35, 'Baik', 'HP Pavilion Core i7 SSD 1TB', 2023, 'PC desain grafis Adobe Illustrator & Photoshop'],
            ['Komputer Pemasaran', 'RG-021', 36, 36, 'Baik', 'Dell OptiPlex 3090', 2023, 'PC digital marketing e-commerce'],
            ['Komputer PPLG 1', 'RG-014', 36, 35, 'Baik', 'PC Rakitan Ryzen 5 5600G', 2023, 'PC lab pemrograman web dan mobile'],
            ['Komputer PPLG 2', 'RG-015', 36, 34, 'Baik', 'PC Rakitan Ryzen 5 5600G', 2023, 'PC lab basis data dan algoritma'],
            ['Komputer PPLG 3', 'RG-022', 36, 36, 'Baik', 'PC Rakitan Core i5 Gen 12', 2023, 'PC lab pengembangan game'],
            ['Komputer PPLG 4', 'RG-023', 36, 35, 'Baik', 'PC Rakitan Core i5 Gen 12', 2023, 'PC praktikum rekayasa perangkat lunak'],
            ['Komputer PPLG 5', 'RG-024', 36, 36, 'Baik', 'PC Rakitan Core i5 Gen 12', 2023, 'PC pemrograman aplikasi desktop'],
            ['Laptop', 'RG-013', 15, 12, 'Baik', 'Lenovo ThinkPad E14 Gen 4', 2023, 'Laptop dinas dan mobile programming'],
            ['Mesin Cutting', 'RG-027', 2, 2, 'Baik', 'Jinka PRO 721 LED', 2022, 'Pemotong stiker polyflex sablon'],
            ['Mesin Laminasi', 'RG-028', 2, 2, 'Baik', 'Origin OR-330 Roll', 2022, 'Mesin laminasi panas dingin ukuran A3'],
            ['Mesin Oven', 'RG-027', 2, 2, 'Baik', 'Blower Oven Curing DTF', 2023, 'Oven pengering bubuk lem sablon DTF'],
            ['Mesin Pres', 'RG-027', 3, 3, 'Baik', 'Heat Press Flat 38x38cm', 2022, 'Alat press kaos hidrolik sablon'],
            ['Printer 3D', 'RG-025', 2, 2, 'Baik', 'Creality Ender 3 S1 Pro', 2023, 'Cetak objek 3D filamen PLA lab IoT'],
            ['Printer DTF', 'RG-027', 1, 1, 'Baik', 'Epson L1800 Modifikasi DTF', 2023, 'Printer cetak film sablon direct to film'],
            ['Printer Foto', 'RG-029', 2, 2, 'Baik', 'Canon imagePROGRAF PRO-200', 2023, 'Printer foto studio profesional A3+'],
            ['Printer Sublim', 'RG-028', 1, 1, 'Baik', 'Epson SureColor SC-F130', 2023, 'Printer sublimasi cetak merchandise'],
            ['Printer UV', 'RG-028', 1, 1, 'Baik', 'Focus Fairy UV Flatbed A4', 2023, 'Printer flatbed cetak casing dan akrilik'],
            ['Stabilizer / PSU', 'RG-013', 10, 10, 'Baik', 'Matsunaga SVC-1000N', 2023, 'Penstabil tegangan listrik alat lab'],
            ['Stand Lighting', 'RG-029', 8, 8, 'Baik', 'Takara Air Cushioned Light Stand', 2023, 'Penyangga lampu pencahayaan studio'],
            ['Stand Microphone', 'RG-026', 6, 6, 'Baik', 'Hercules MS533B Boom', 2023, 'Stand mic tiang boom studio broadcast'],
            ['Tripod Camera', 'RG-029', 6, 5, 'Baik', 'Beike Q999 Pro Ballhead', 2023, 'Tripod kamera foto dan video kokoh'],
            ['Kamera MD 1000', 'RG-026', 2, 2, 'Baik', 'Panasonic MD 10000 Camcorder', 2021, 'Kamera video shoulder bahu broadcast'],
            ['Tripod Kamera', 'RG-026', 5, 5, 'Baik', 'Somita ST-3520 Fluid Head', 2022, 'Tripod video pan-tilt hidrolik'],
            ['Soft Box Standar', 'RG-029', 4, 4, 'Baik', 'Godox SB-FW 60x90cm Bowens', 2023, 'Diffuser lampu payung segi empat'],
            ['Lampu LED', 'RG-029', 6, 6, 'Baik', 'Yongnuo YN300 Air Bi-Color', 2023, 'Panel lampu LED portable on-camera'],
            ['Tripod Kecil', 'RG-029', 4, 4, 'Baik', 'Joby Gorillapod 3K Pro', 2023, 'Tripod fleksibel meja vlogging'],
            ['Tuled + Bracket', 'RG-029', 2, 2, 'Baik', 'Nanlite PavoTube II 15C RGB', 2023, 'Lampu tabung tube light lighting efek'],
            ['Background Hijau', 'RG-026', 3, 3, 'Baik', 'Kain Greenscreen 3x6 Meter', 2023, 'Latar belakang chroma key penyiaran'],
            ['Lampu Sorot', 'RG-026', 4, 4, 'Baik', 'Godox SL60W LED Video Light', 2023, 'Lampu continuous daylight studio'],
            ['Komputer Lab Broadcast', 'RG-026', 6, 6, 'Baik', 'MSI Creator Core i7 RTX 4060', 2023, 'Workstation live streaming & video editing'],
            ['Audio Mixer', 'RG-026', 2, 2, 'Baik', 'Behringer Xenyx QX1202USB', 2023, 'Audio interface konsol broadcast'],
            ['Video Mixer', 'RG-026', 2, 2, 'Baik', 'Blackmagic ATEM Mini Pro ISO', 2023, 'Switcher live streaming multi kamera'],
            ['Rekording Pack', 'RG-026', 2, 2, 'Baik', 'Focusrite Scarlett 2i2 Studio Gen 3', 2023, 'Paket soundcard mic condensor & headphone'],
            ['Speaker', 'RG-026', 4, 4, 'Baik', 'Yamaha HS5 Studio Monitor', 2023, 'Speaker flat monitoring audio rekaman'],
            ['Teleprompter', 'RG-026', 2, 2, 'Baik', 'Feelworld TP10 Portable 10"', 2023, 'Prompter pembaca teks presenter berita'],
            ['Mic Wireless', 'RG-026', 4, 3, 'Baik', 'Saramonic Blink 500 B2 Dual', 2023, 'Klip mikrofon nirkabel clip-on lapel'],
            ['Kamera Mirrorless', 'RG-026', 3, 2, 'Baik', 'Sony Alpha 6400 Kit 16-50mm', 2023, 'Kamera mirrorless 4K autofocus cepat'],
            ['Drone', 'RG-026', 2, 2, 'Baik', 'DJI Mini 3 Pro Fly More Combo', 2023, 'Wahana terbang kamera aerial videografi'],
            ['Kamera Digital', 'RG-029', 4, 3, 'Baik', 'Sony ZV-1 Vlogging Camera', 2023, 'Kamera saku pembuat konten digital'],
            ['Oculus', 'RG-016', 2, 2, 'Baik', 'Meta Quest 2 128GB VR Headset', 2023, 'Kacamata realitas virtual lab animasi'],
            ['Lampu Sorot Panggung', 'RG-030', 4, 4, 'Baik', 'Par LED RGBW 54x3W DMX', 2022, 'Lighting panggung seni pertunjukan'],
            ['Lampu Studio Redhead', 'RG-029', 3, 3, 'Baik', 'Redhead Continuous Light 800W', 2022, 'Lampu sorot tungsten studio hangat'],
            ['Kamera DSLR Canon', 'RG-029', 3, 2, 'Baik', 'Canon EOS 80D Kit 18-135mm', 2022, 'Kamera DSLR semi-pro fotografi siswa'],
            ['Kamera DSLR Nikon', 'RG-029', 2, 2, 'Baik', 'Nikon D5600 Kit 18-55mm VR', 2022, 'Kamera DSLR pemula sensor DX'],
            ['Kamera DSLR Sony', 'RG-029', 2, 2, 'Baik', 'Sony Alpha 77 II SLT', 2022, 'Kamera kamera profesional studio'],
            ['Lensa Wide', 'RG-029', 2, 2, 'Baik', 'Tokina AT-X 11-16mm f/2.8 Pro', 2023, 'Lensa sudut lebar pemandangan & ruangan'],
            ['Lensa Fix', 'RG-029', 3, 3, 'Baik', 'Canon EF 50mm f/1.8 STM Bokeh', 2023, 'Lensa potret tajam bukaan lebar'],
            ['Lensa Tele', 'RG-029', 2, 2, 'Baik', 'Tamron 70-300mm f/4-5.6 Di VC', 2022, 'Lensa telefoto zoom jarak jauh'],
            ['Lampu Studio Strobe', 'RG-029', 4, 4, 'Baik', 'Godox SK400II Flash 400Ws', 2023, 'Flash studio modeling lamp GN65'],
            ['Flash Eksternal', 'RG-029', 4, 3, 'Baik', 'Godox TT600 Speedlite Wireless', 2023, 'Flash kamera hotshoe lepas pemicu'],
            ['Background Studio', 'RG-029', 5, 5, 'Baik', 'Superior Seamless Paper Roll', 2023, 'Gulungan kertas latar belakang foto studio'],
            ['Tripod Besar', 'RG-029', 3, 3, 'Baik', 'Manfrotto MT055XPRO3 Heavy Duty', 2022, 'Tripod kokoh studio foto beban berat'],
            ['Soft Box Besar', 'RG-029', 3, 3, 'Baik', 'Godox Octagon SB-UE 120cm', 2023, 'Softbox payung oktagonal cahaya lembut'],
            ['Soft Box Sedang', 'RG-029', 4, 4, 'Baik', 'Godox Strip Softbox 35x160cm', 2023, 'Softbox strip rim light modeling'],
            ['Komputer Mac', 'RG-018', 10, 10, 'Baik', 'Apple Mac Mini M2 16GB 512GB', 2023, 'Komputer desktop macOS desain DKV'],
            ['Printer Foto Inkjet', 'RG-028', 2, 2, 'Baik', 'Epson EcoTank L8050 6 Warna', 2023, 'Printer cetak foto id card dan stiker'],
            ['Hub Switch', 'RG-013', 8, 8, 'Baik', 'TP-Link TL-SG1024D 24-Port Gigabit', 2023, 'Switch jaringan komputer antarlab'],
            ['Headphone Studio', 'RG-026', 15, 14, 'Baik', 'Audio-Technica ATH-M20x Pro', 2023, 'Headphone monitoring audio rekaman'],
            ['Pen Tablet', 'RG-017', 36, 34, 'Baik', 'Huion Inspiroy H640P Drawing Pad', 2023, 'Tablet grafis gambar ilustrasi digital'],
            ['Server', 'RG-013', 2, 2, 'Baik', 'Dell PowerEdge R440 Rack Server', 2022, 'Server basis data & CBT ujian sekolah'],
            ['Access Point', 'RG-013', 12, 12, 'Baik', 'Ruijie Reyee RG-RAP2200(E) WiFi 5', 2023, 'Pemancar internet nirkabel tiap ruangan'],
            ['Kalkulator', 'RG-019', 40, 38, 'Baik', 'Casio FX-991EX ClassWiz', 2023, 'Kalkulator saintifik lab akuntansi'],
            ['Mesin Kasir', 'RG-021', 4, 4, 'Baik', 'Sharp XE-A207 POS Cash Register', 2022, 'Mesin kasir praktikum transaksi ritel'],
            ['Meja Cetak Sablon', 'RG-027', 4, 4, 'Baik', 'Meja Sablon Rotary 4 Screen Presisi', 2022, 'Meja putar cetak sablon manual multiwarna'],
            ['Alat Cetak Pin', 'RG-027', 3, 3, 'Baik', 'Talent Pin Press Red Body', 2023, 'Mesin press pin badge bros 44mm & 58mm'],
            ['Alat Cetak Mug', 'RG-027', 3, 3, 'Baik', 'Heat Press Mug Digital Sublim', 2023, 'Mesin sablon pemanas cetak cangkir keramik'],
            ['Alat Musik Tradisional', 'RG-030', 1, 1, 'Baik', 'Kacapi Kawih Sunda Kayu Jenitri', 2021, 'Kecapi alat musik petik Sunda'],
            ['Kendang', 'RG-030', 3, 3, 'Baik', 'Kendang Jaipongan Kulit Sapi Kayu Nangka', 2021, 'Kendang gamelan indung dan anak'],
            ['Gamelan Degung Pelog Selap Salendro', 'RG-030', 1, 1, 'Baik', 'Gamelan Kuningan 1 Set Komplet', 2021, 'Ansambel gamelan Sunda panggung'],
            ['Angklung Melodi', 'RG-030', 2, 2, 'Baik', 'Saung Angklung Udjo 31 Nada', 2022, 'Set tabung bambu melodi lagu'],
            ['Angklung Bass Party', 'RG-030', 2, 2, 'Baik', 'Saung Angklung Udjo 11 Nada Bass', 2022, 'Set tabung bambu nada rendah bass'],
            ['Accompanyemen', 'RG-030', 2, 2, 'Baik', 'Angklung Akor Pengiring Mayor Minor', 2022, 'Set tabung bambu harmoni pengiring'],
            ['Cuk', 'RG-030', 2, 2, 'Baik', 'Ukulele Cuk Keroncong 3 Senar', 2022, 'Instrumen petik musik keroncong'],
            ['Bass Pukul', 'RG-030', 1, 1, 'Baik', 'Cello Bass Betot Tradisional', 2022, 'Bass senar akustik betot pengiring'],
            ['Gambang Pengiring', 'RG-030', 1, 1, 'Baik', 'Gambang Sunda Kayu Jati 18 Wilah', 2021, 'Instrumen bilah tabuh nada Sunda'],
            ['Drum', 'RG-030', 1, 1, 'Baik', 'Pearl Roadshow 5-Piece Drumkit', 2022, 'Set drum akustik drumset simbal'],
            ['Gitar Akustik', 'RG-030', 4, 4, 'Baik', 'Yamaha F310 Natural Wood', 2023, 'Gitar akustik senar kawat vokal'],
            ['Gitar Bass', 'RG-030', 2, 2, 'Baik', 'Yamaha TRBX174 4-String Bass', 2022, 'Gitar bass elektrik nada rendah'],
            ['Matras', 'RG-012', 10, 10, 'Baik', 'Kettler Busa Rebonded 15cm', 2023, 'Matras olahraga senam lantai aman'],
            ['Bola Voli', 'RG-012', 12, 10, 'Baik', 'Mikasa MVA200 Original', 2023, 'Bola voli turnamen kulit lembut'],
            ['Bola Basket', 'RG-012', 10, 8, 'Baik', 'Molten GG7X Composite Leather', 2023, 'Bola basket ukuran 7 outdoor/indoor'],
            ['Bola Futsal', 'RG-012', 12, 10, 'Baik', 'Specs Patriot FIFA Standar', 2024, 'Bola sepak futsal pantulan rendah'],
            ['Net Voli', 'RG-012', 3, 3, 'Baik', 'Mikasa VNL-1 Seling Baja', 2023, 'Jaring lapangan voli standar pertandingan'],
            ['Net Badminton', 'RG-012', 4, 4, 'Baik', 'Yonex BN-141 Tali Kawat', 2023, 'Jaring bulutangkis rajut rapat'],
            ['Stik Kasti', 'RG-012', 8, 8, 'Baik', 'Kayu Mahoni Halus 60cm', 2023, 'Pemukul bola kasti/rounders olahraga'],
        ];

        $barangCounter = 1;
        $createdBarangs = [];

        // Insert Perabotan
        foreach ($perabotanList as $item) {
            $kode = sprintf('BRG-%03d', $barangCounter++);
            $createdBarangs[$kode] = Barang::create([
                'kode_barang' => $kode,
                'nama_barang' => $item[0],
                'kategori_id' => $kategoriMap['Perabotan']->id,
                'ruangan_id' => $ruanganMap[$item[1]]->id,
                'stok_total' => $item[2],
                'stok_tersedia' => $item[3],
                'kondisi' => $item[4],
                'merk' => $item[5],
                'tahun_pengadaan' => $item[6],
                'keterangan' => $item[7],
            ]);
        }

        // Insert Elektronik
        foreach ($elektronikList as $item) {
            $kode = sprintf('BRG-%03d', $barangCounter++);
            $createdBarangs[$kode] = Barang::create([
                'kode_barang' => $kode,
                'nama_barang' => $item[0],
                'kategori_id' => $kategoriMap['Elektronik']->id,
                'ruangan_id' => $ruanganMap[$item[1]]->id,
                'stok_total' => $item[2],
                'stok_tersedia' => $item[3],
                'kondisi' => $item[4],
                'merk' => $item[5],
                'tahun_pengadaan' => $item[6],
                'keterangan' => $item[7],
            ]);
        }

        // Insert Alat Praktik / Lab
        foreach ($alatPraktikList as $item) {
            $kode = sprintf('BRG-%03d', $barangCounter++);
            $createdBarangs[$kode] = Barang::create([
                'kode_barang' => $kode,
                'nama_barang' => $item[0],
                'kategori_id' => $kategoriMap['Alat Praktik / Lab']->id,
                'ruangan_id' => $ruanganMap[$item[1]]->id,
                'stok_total' => $item[2],
                'stok_tersedia' => $item[3],
                'kondisi' => $item[4],
                'merk' => $item[5],
                'tahun_pengadaan' => $item[6],
                'keterangan' => $item[7],
            ]);
        }

        // ─────────────────────────────────────────────────────────────
        // 4. SAMPLE TRANSAKSI PEMINJAMAN
        // ─────────────────────────────────────────────────────────────
        $petugas1 = User::where('role', 'petugas')->first();
        $petugasId = $petugas1?->id;

        $samplePinjaman = [
            [
                'kode_pinjam' => 'PJM-00001',
                'nama_peminjam' => 'Abdilah Malik Al-Jabbar',
                'no_identitas' => '2627020070001',
                'jenis_peminjam' => 'Siswa',
                'no_hp' => '081234567890',
                'barang_kode' => 'BRG-052', // Laptop
                'jumlah' => 1,
                'tanggal_pinjam' => Carbon::now()->subDays(3),
                'tanggal_kembali_rencana' => Carbon::now()->addDays(2),
                'tanggal_kembali_aktual' => null,
                'status' => 'Dipinjam',
                'keperluan' => 'Praktikum Uji Kompetensi Keahlian PPLG',
                'petugas_id' => $petugasId,
            ],
            [
                'kode_pinjam' => 'PJM-00002',
                'nama_peminjam' => 'Saskia Nurul Baeti',
                'no_identitas' => '2627017084037',
                'jenis_peminjam' => 'Siswa',
                'no_hp' => '082345678901',
                'barang_kode' => 'BRG-087', // Kamera DSLR Canon
                'jumlah' => 1,
                'tanggal_pinjam' => Carbon::now()->subDays(5),
                'tanggal_kembali_rencana' => Carbon::now()->subDay(),
                'tanggal_kembali_aktual' => null,
                'status' => 'Terlambat',
                'keperluan' => 'Sesi pemotretan tugas portofolio DKV',
                'petugas_id' => $petugasId,
            ],
            [
                'kode_pinjam' => 'PJM-00003',
                'nama_peminjam' => 'Rima Permata Ellya, S.Pd.',
                'no_identitas' => '198503122010012005',
                'jenis_peminjam' => 'Guru',
                'no_hp' => '083456789012',
                'barang_kode' => 'BRG-033', // Proyektor / Infokus
                'jumlah' => 1,
                'tanggal_pinjam' => Carbon::now()->subDays(2),
                'tanggal_kembali_rencana' => Carbon::now()->addDays(1),
                'tanggal_kembali_aktual' => null,
                'status' => 'Dipinjam',
                'keperluan' => 'Presentasi materi pembelajaran di kelas X PPLG 1',
                'petugas_id' => $petugasId,
            ],
            [
                'kode_pinjam' => 'PJM-00004',
                'nama_peminjam' => 'Dicky Maulana',
                'no_identitas' => '2627020070013',
                'jenis_peminjam' => 'Siswa',
                'no_hp' => '084567890123',
                'barang_kode' => 'BRG-126', // Bola Futsal
                'jumlah' => 2,
                'tanggal_pinjam' => Carbon::now()->subDays(7),
                'tanggal_kembali_rencana' => Carbon::now()->subDays(6),
                'tanggal_kembali_aktual' => Carbon::now()->subDays(6),
                'status' => 'Dikembalikan',
                'keperluan' => 'Latihan futsal ekskul antar kelas',
                'petugas_id' => $petugasId,
            ],
            [
                'kode_pinjam' => 'PJM-00005',
                'nama_peminjam' => 'Muhammad Raffy Albani',
                'no_identitas' => '2627020070035',
                'jenis_peminjam' => 'Siswa',
                'no_hp' => '085678901234',
                'barang_kode' => 'BRG-080', // Mic Wireless
                'jumlah' => 1,
                'tanggal_pinjam' => Carbon::now()->subDay(),
                'tanggal_kembali_rencana' => Carbon::now()->addDays(3),
                'tanggal_kembali_aktual' => null,
                'status' => 'Dipinjam',
                'keperluan' => 'Liputan podcast dan video berita sekolah',
                'petugas_id' => null,
            ],
        ];

        foreach ($samplePinjaman as $p) {
            $barangModel = $createdBarangs[$p['barang_kode']] ?? null;
            if ($barangModel) {
                Pinjaman::create([
                    'kode_pinjam' => $p['kode_pinjam'],
                    'nama_peminjam' => $p['nama_peminjam'],
                    'no_identitas' => $p['no_identitas'],
                    'jenis_peminjam' => $p['jenis_peminjam'],
                    'no_hp' => $p['no_hp'],
                    'barang_id' => $barangModel->id,
                    'jumlah' => $p['jumlah'],
                    'tanggal_pinjam' => $p['tanggal_pinjam'],
                    'tanggal_kembali_rencana' => $p['tanggal_kembali_rencana'],
                    'tanggal_kembali_aktual' => $p['tanggal_kembali_aktual'],
                    'status' => $p['status'],
                    'keperluan' => $p['keperluan'],
                    'petugas_id' => $p['petugas_id'],
                ]);
            }
        }

        $this->command->info('✓ Master Barang berhasil disimpan: 3 Kategori, 59 Ruangan, 129 Barang, 5 Transaksi Pinjaman.');
    }
}
