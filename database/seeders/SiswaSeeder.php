<?php

namespace Database\Seeders;

use App\Models\Siswa;
use Illuminate\Database\Seeder;

class SiswaSeeder extends Seeder
{
    public function run(): void
    {
        Siswa::truncate();
        $this->seedKelasX();
        $this->seedKelasXI();
        $this->seedKelasXII();
        $this->command->info('✓ Data siswa berhasil disimpan.');
    }

    private function insert(array $rows, string $kelas, string $jurusan, string $tingkat, string $wali): void
    {
        $now = now();
        $records = array_map(fn ($r) => [
            'nis' => $r[0],
            'nama_lengkap' => $r[1],
            'jenis_kelamin' => $r[2],
            'kelas' => $kelas,
            'jurusan' => $jurusan,
            'tingkat' => $tingkat,
            'wali_kelas' => $wali,
            'created_at' => $now,
            'updated_at' => $now,
        ], $rows);
        Siswa::insert($records);
    }

    // ─────────────────────────────────────────────────────
    private function seedKelasX(): void
    {
        // X PPLG 1
        $this->insert([
            ['2627020070001', 'Abdilah Malik Al-Jabbar', 'L'],
            ['2627020070003', 'Aditya Musyaffa', 'L'],
            ['2627020070004', 'Allif Fakhrizal', 'L'],
            ['2627020070005', 'Amshor Mustofa Ilham', 'L'],
            ['2627020070006', 'Anita Siti Nurjanah', 'P'],
            ['2627020070011', 'Dava Herdiansyah', 'L'],
            ['2627020070013', 'Dicky Maulana', 'L'],
            ['2627020070015', 'Evian Afri Ansyah', 'L'],
            ['2627020070016', 'Fadyl Maulana Yusuf', 'L'],
            ['2627020070018', 'Faisal Ramdhani', 'L'],
            ['2627020070020', 'Hafizhan Hanif Abdullah', 'L'],
            ['2627020070023', 'Keandra Fadhil Azfar', 'L'],
            ['2627020070025', 'Kheidira Ahmad Fajar', 'L'],
            ['2627020070026', 'Leandra Mahawira Ardhani', 'L'],
            ['2627020070027', 'M. Irvan Abdillah', 'L'],
            ['2627020070029', 'Muhamad Raytama Derald', 'L'],
            ['2627020070030', 'Muhamad Ryfqy', 'L'],
            ['2627020070031', 'Muhammad Dendra Fadhilah', 'L'],
            ['2627020070034', 'Muhammad Juliyansyah', 'L'],
            ['2627020070035', 'Muhammad Raffy Albani', 'L'],
            ['2627020070036', 'Pasya Nurul Octaviani', 'P'],
            ['2627020070039', 'Rafka Radhitya Anugrah', 'L'],
            ['2627020070041', 'Raka Putra Adnesa', 'L'],
            ['2627020070042', 'Refky Ardiansyah', 'L'],
            ['2627020070043', 'Regina Nirwasita Putri Daiman', 'P'],
            ['2627020070052', 'Sayyidah Kayyis Fadhilah', 'P'],
            ['2627020070054', 'Widyan Daffa Hermawan', 'L'],
        ], 'X PPLG 1', 'Rekayasa Perangkat Lunak', 'X', 'Rima Permata Ellya, S.Pd.');

        // X PPLG 2
        $this->insert([
            ['2627020070002', 'Abiyyu Fadhlurrahman', 'L'],
            ['2627020070007', 'Arya Nurizky Wirayuda', 'L'],
            ['2627020070008', 'Aulia Putri Pratiwi', 'P'],
            ['2627020070009', 'Azzahra Variztha Zulkarnaen', 'P'],
            ['2627020070010', 'Cep Pahmi Muhammad Arya', 'L'],
            ['2627020070012', 'David Vila Septiawan', 'L'],
            ['2627020070014', 'Dwi Cahaya Kusumah', 'P'],
            ['2627020070017', 'Fahmi Nur Ahza', 'L'],
            ['2627020070019', 'Hafizh Fadhillah', 'L'],
            ['2627020070021', 'Husna Khoirunnisa', 'P'],
            ['2627020070022', 'Jalu Ramdhan As-Syaf', 'L'],
            ['2627020070024', 'Keyran Bilal Ashariansyah', 'L'],
            ['2627020070028', 'Muhamad Padhil Nurpajri', 'L'],
            ['2627020070032', 'Muhammad Fadlan Azzam', 'L'],
            ['2627020070033', 'Muhammad Farhan Septian Andari', 'L'],
            ['2627020070037', 'Putra Aditya', 'L'],
            ['2627020070038', 'Raffa Syaibil Axcel', 'L'],
            ['2627020070040', 'Raikhan Rizky Putra Herdiana', 'L'],
            ['2627020070044', 'Rezky Maulana', 'L'],
            ['2627020070045', 'Riky Nurbagja', 'L'],
            ['2627020070046', 'Ririn Anjani', 'P'],
            ['2627020070047', 'Rizki Prasetya Hermansyah', 'L'],
            ['2627020070048', 'Rizky Albyannur Ramadhan', 'L'],
            ['2627020070049', 'Salsabila Nurazizah', 'P'],
            ['2627020070050', 'Sarah Amelia', 'P'],
            ['2627020070051', 'Satriya Ramadhana Permana Putra', 'L'],
            ['2627020070053', 'Triana Anggra Nur Bagja', 'L'],
        ], 'X PPLG 2', 'Rekayasa Perangkat Lunak', 'X', 'Hurip Permana, S.T.');

        // X DKV 1
        $this->insert([
            ['2627017084003', 'Alvira Kavalera Poniman', 'P'],
            ['2627017084004', 'Annisa Nur Firdaus', 'P'],
            ['2627017084007', 'Ashita Kirana Dewi', 'P'],
            ['2627017084008', 'Asshira Sonia Zulfa', 'P'],
            ['2627017084009', 'Bossanova Aliyyu Dhakir', 'L'],
            ['2627017084010', 'Dimaz Widyan Sawungsono', 'L'],
            ['2627017084011', 'Fawwaz Catra Prasetia', 'L'],
            ['2627017084013', 'Ghania Alqisha', 'P'],
            ['2627017084016', 'Jasmine Rafifah Romadhoni', 'P'],
            ['2627017084018', 'Keisya Az-Zahira Putri Nurdimaja', 'P'],
            ['2627017084020', 'Luki Ramdani', 'L'],
            ['2627017084022', 'Muhamad Difka Pradipta', 'L'],
            ['2627017084023', 'Mulyana Malik Mathor Rizki', 'L'],
            ['2627017084028', "Nuril Sya'bani", 'P'],
            ['2627017084032', 'Revan Permana Aziz', 'L'],
            ['2627017084034', 'Rifki Adika Widi', 'L'],
            ['2627017084035', 'Rizki Mukti Fadillah', 'L'],
            ['2627017084036', 'Sabrina Annisa Setiawati', 'P'],
            ['2627017084037', 'Saskia Nurul Baeti', 'P'],
            ['2627017084040', 'Zoanna Qurota Yasin', 'L'],
        ], 'X DKV 1', 'Desain Komunikasi Visual', 'X', 'Sony Syaupala, S.T.');

        // X DKV 2
        $this->insert([
            ['2627017084001', 'Ainun Nadin Alhawarizmi Kosasih', 'P'],
            ['2627017084002', 'Almira Quentin Renata', 'P'],
            ['2627017084005', 'Arkia Abdan Syakir', 'L'],
            ['2627017084006', 'Arya Dwi Permadi', 'L'],
            ['2627017084012', 'Gallan Maulee Adam', 'L'],
            ['2627017084014', 'Hafizh Dzikra Al Ghifari', 'L'],
            ['2627017084015', 'Irham Putra Hamdani', 'L'],
            ['2627017084017', 'Karissa Fidriani', 'P'],
            ['2627017084019', 'Leia Zaydanish', 'P'],
            ['2627017084021', 'Mohamad Haristia Riyadi', 'L'],
            ['2627017084024', 'Nabilah Khoirunnisa Azzahro', 'P'],
            ['2627017084025', 'Naima Nur Khalizha', 'P'],
            ['2627017084026', 'Naufal Mari Fauzi', 'L'],
            ['2627017084027', 'Nayra Shyfa Auliya', 'P'],
            ['2627017084029', 'Oktafianto Nugraha', 'L'],
            ['2627017084030', 'Qirania Hafsa Aruni Kuswandi', 'P'],
            ['2627017084031', 'Raka Nurbagja', 'L'],
            ['2627017084033', 'Reza Aditya', 'L'],
            ['2627017084038', 'Wendy Kusnadi', 'L'],
            ['2627017084039', 'Yoga Pratama Putra', 'L'],
        ], 'X DKV 2', 'Desain Komunikasi Visual', 'X', 'Dr. Dani Wardani, S.Hum., M.Pd.');

        // X AKT 1
        $this->insert([
            ['2627012119002', 'Azka Thalita Rezkia', 'P'],
            ['2627012119003', 'Bela Siti Sania', 'P'],
            ['2627012119010', 'Gina Nur Indah Lestari', 'P'],
            ['2627012119013', 'Inge Milandunka Rohmah', 'P'],
            ['2627012119014', 'Kamila Nur Izzati', 'P'],
            ['2627012119015', 'Keisya Nurul Khotimah', 'P'],
            ['2627012119016', 'Khaila Adelia Putri', 'P'],
            ['2627012119017', 'Kirana Andriani Setiawan', 'P'],
            ['2627012119019', 'N. Najwa Marah Solihah', 'P'],
            ['2627012119023', 'Nazila Naura Yasmin', 'P'],
            ['2627012119024', 'Novia Nurjanah', 'P'],
            ['2627012119025', 'Nuriqhra Rambu Mashae', 'P'],
            ['2627012119026', 'Oryna Syatifa', 'P'],
            ['2627012119027', 'Rahmanissa Destianti', 'P'],
            ['2627012119028', 'Ramadhan Mulia Wardhani', 'L'],
            ['2627012119031', 'Rizky Joni Saputra', 'L'],
            ['2627012119033', 'Sandrika Alprianitri', 'P'],
            ['2627012119034', 'Saskia Amelia', 'P'],
            ['2627012119036', 'Shallya Arni', 'P'],
            ['2627012119038', 'Shierley Silawarti', 'P'],
            ['2627012119039', 'Shofa Fuadi', 'P'],
            ['2627012119040', 'Silvi Rahmawati', 'P'],
            ['2627012119042', 'Silvia Ardianti', 'P'],
            ['2627012119047', 'Tasya Maharani', 'P'],
        ], 'X AKT 1', 'Akuntansi dan Keuangan Lembaga', 'X', 'Rahayu Dalyanti, S.Pd., M.Ak.');

        // X AKT 2
        $this->insert([
            ['2627012119001', 'Arlita Siti Fatmah', 'P'],
            ['2627012119004', 'Cahyani Apriliyanti', 'P'],
            ['2627012119005', 'Cila Putri Prasetio', 'P'],
            ['2627012119006', 'Cynara Syifa Elysia', 'P'],
            ['2627012119007', 'Fakhira Hafiza Quranique', 'P'],
            ['2627012119008', 'Fathiya Nur Hasanah', 'P'],
            ['2627012119009', 'Fhatya Nur Ismi', 'P'],
            ['2627012119011', 'Ilona Belva Khansa', 'P'],
            ['2627012119012', 'Indah Eka Putri', 'P'],
            ['2627012119018', 'Lida Febriani', 'P'],
            ['2627012119020', 'N. Nazla Amalia Nurohmah', 'P'],
            ['2627012119021', 'Nadhira Kiranasya Azzahra', 'P'],
            ['2627012119022', 'Najwa Nur Karima', 'P'],
            ['2627012119029', 'Rienetta Husna Prima', 'P'],
            ['2627012119030', 'Rista Naura Hidayat', 'P'],
            ['2627012119032', 'Salwa Sumiyati', 'P'],
            ['2627012119035', 'Shakila Syafitri', 'P'],
            ['2627012119037', 'Shaummi Agustina', 'P'],
            ['2627012119041', 'Silvi Sri Rahayu', 'P'],
            ['2627012119043', 'Silvia Zahra', 'P'],
            ['2627012119044', 'Siti Maryam', 'P'],
            ['2627012119045', 'Siti Sarah', 'P'],
            ['2627012119046', 'Syabna Diva Maorine', 'P'],
            ['2627012119048', 'Zahira Nur Azizah', 'P'],
        ], 'X AKT 2', 'Akuntansi dan Keuangan Lembaga', 'X', 'Robingah, S.Pd.');
    }

    // ─────────────────────────────────────────────────────
    private function seedKelasXI(): void
    {
        // XI RPL 1
        $this->insert([
            ['2526019070001', "Abby Muhammad Rafi'u", 'L'],
            ['2526019070002', 'Akbar Fachreza Wilyas', 'L'],
            ['2526019070006', 'Alvino Noufal Sanjaya', 'L'],
            ['2526019070007', 'Andieni Siti Khumairoh', 'P'],
            ['2526019070009', 'Arifal Ghifari Budiman', 'L'],
            ['2526019070010', 'Bintang Martyana Duta Putera', 'L'],
            ['2526019070012', 'Cherilla Amnati Istiqomah', 'P'],
            ['2526019070013', 'Cindy Rahayu', 'P'],
            ['2526019070047', 'Dudi Suparji', 'L'],
            ['2526019070015', 'Fahmi Adhari Akbar', 'L'],
            ['2526019070016', 'Fahrul Rozi Ardiansyah', 'L'],
            ['2526019070018', 'Fauzan Rasyid Sumarna', 'L'],
            ['2526019070022', 'M. Rafqa Hidayat', 'L'],
            ['2526019070025', 'Maniq Dwi Pradita', 'P'],
            ['2526019070026', 'Mirza Lutfil Hadi Susila', 'L'],
            ['2526019070027', 'Mochamad Bima Putra Ramadhan', 'L'],
            ['2526019070029', 'Muhammad Al Farizi A H', 'L'],
            ['2526019070030', "Muhammad Fauzan Ma'ruf", 'L'],
            ['2526019070031', 'Muhammad Ihsan Supriadi', 'L'],
            ['2526019070034', 'Nida Fauziyah Indiragesty', 'P'],
            ['2526019070035', 'Pranata Jaya Hartato', 'L'],
            ['2526019070040', 'Risqi Muhamad Padhilah', 'L'],
            ['2526019070043', 'Tegar Permana', 'L'],
            ['2526019070046', 'Ziyad Akbar Putra', 'L'],
            ['2526019070049', 'Ardi Firmansyah', 'L'],
        ], 'XI RPL 1', 'Rekayasa Perangkat Lunak', 'XI', 'N. Yani Suryani, S.Pd.');

        // XI RPL 2
        $this->insert([
            ['2526019070003', 'Al Fikri Nur Tawab', 'L'],
            ['2526019070004', 'Aldi Nurohman', 'L'],
            ['2526019070005', 'Alfin Al Ghazali', 'L'],
            ['2526019070008', 'Andika Atha Fadhlullah', 'L'],
            ['2526019070011', 'Bustan Nur Wildan', 'L'],
            ['2526019070014', "Darin Mis'an", 'P'],
            ['2526019070017', 'Fauzan Maulana', 'L'],
            ['2526019070019', 'Jihan Nur Azizah', 'P'],
            ['2526019070020', 'Khoerul Arka Maulana', 'L'],
            ['2526019070021', 'Lutfan Baehaqi', 'L'],
            ['2526019070023', 'M. Rifqy Hidayat', 'L'],
            ['2526019070024', 'Manggala Wirafitriawan', 'L'],
            ['2526019070028', 'Muhamad Aditya Muhtar', 'L'],
            ['2526019070032', 'Muhammad Nufa Al-Qalami', 'L'],
            ['2526019070033', 'Nabila Haifa Hadian', 'P'],
            ['2526019070036', 'Rasya Putra Andika Mulyana', 'L'],
            ['2526019070037', 'Rasya Rahadian Nijar', 'L'],
            ['2526019070039', 'Rifky Eldiyan Putra', 'L'],
            ['2526019070041', 'Rizky Maulana Nur Hidayat', 'L'],
            ['2526019070042', 'Sabian Al Fiqh', 'L'],
            ['2526019070044', 'Wibi Yuda Pratama', 'L'],
            ['2526019070045', 'Wildan Galih', 'L'],
            ['2526019070048', 'Muhamad Adli Maulana', 'L'],
        ], 'XI RPL 2', 'Rekayasa Perangkat Lunak', 'XI', 'Ridwan Setiawan, S.Kom.I., M.Kom.');

        // XI DKV
        $this->insert([
            ['2526016084001', 'Alfarini Nur Aulia', 'P'],
            ['2526016084002', 'Anggraeni Puspita Dewi', 'P'],
            ['2526016084003', 'Arfa Rizky Raditya Rukandi', 'L'],
            ['2526016084004', 'Athalah Sakha Putra Andriansyah', 'L'],
            ['2526016084005', 'Azril Muhammad Sofyan Tsauri', 'L'],
            ['2526016084006', 'Bilal Baihaki', 'L'],
            ['2526016084007', 'Billy Al Mugni Dermawan', 'L'],
            ['2526016084008', 'Devina Sheyla Ramlan', 'P'],
            ['2526016084009', 'Fawaz Azfi Abdillah', 'L'],
            ['2526016084010', 'Hilmy Hafid Amrulloh', 'L'],
            ['2526016084011', 'Muhamad Arkan Monterdy', 'L'],
            ['2526016084012', 'Muhamad Nazril Hermanto', 'L'],
            ['2526016084013', 'Muhamad Zahran Ali', 'L'],
            ['2526016084014', 'Muhammad Taufik', 'L'],
            ['2526016084022', 'Muhammad Willy Adrian', 'L'],
            ['2526016084015', 'Raffi Zaenal Pratama', 'L'],
            ['2526016084017', 'Rizky Nur Fadilah', 'L'],
            ['2526016084018', 'Siti Fauziah', 'P'],
            ['2526016084019', 'Waroka Lainatusyifa', 'P'],
            ['2526016084020', 'Yara Anami Alifa', 'P'],
            ['2526016084021', 'Zulfikri Hamdani Mahendra', 'L'],
        ], 'XI DKV', 'Desain Komunikasi Visual', 'XI', 'Neni Septilia, S.Pd.');

        // XI ANIMASI
        $this->insert([
            ['2526016073001', 'Anindya Rana Malaika', 'P'],
            ['2526016073002', 'Jauza Sajida Abdia Rahim', 'P'],
            ['2526016073003', 'M. Alfarizi Lilfirdaus', 'L'],
            ['2526016073004', 'Nadila Diana Putri', 'P'],
            ['2526016073005', 'Naufal Akbar Alfarobi', 'L'],
            ['2526016073006', 'Nayla Alfiyanti Nadhifa', 'P'],
            ['2526016073007', 'Sabia Najla Gushamisa', 'P'],
            ['2526016073008', 'Zahra Ghaina Fakhirah', 'P'],
        ], 'XI ANIMASI', 'Animasi', 'XI', 'Nina Ervina, S.Si.');

        // XI AKT
        $this->insert([
            ['2526011119001', 'Alfira Nur Revanda', 'P'],
            ['2526011119002', 'Ameera Nayana Hidayat', 'P'],
            ['2526011119003', 'Anggita Anggraini Kusnaindar', 'P'],
            ['2526011119004', 'Anisa Meydiati Purnama', 'P'],
            ['2526011119005', 'Dikra Assyifa', 'P'],
            ['2526011119006', 'Dina Febriyani Putri', 'P'],
            ['2526011119007', 'Dwi Oktaviani', 'P'],
            ['2526011119008', 'Febi Saparingga', 'P'],
            ['2526011119009', 'Indri Andriani', 'P'],
            ['2526011119011', 'Kanaya Aulia Salsabila', 'P'],
            ['2526011119012', 'Muhammad Fauzi Ridwan Sesfao', 'L'],
            ['2526011119024', 'Muhammad Zaky Ardiansyah', 'L'],
            ['2526011119013', 'Naima Putri Nurdiansyah', 'P'],
            ['2526011119014', 'Najwa Puspita', 'P'],
            ['2526011119015', 'Naysha Nur Sanni', 'P'],
            ['2526011119016', 'Nazwa Nafisa Putri', 'P'],
            ['2526011119017', 'Puspa Febbyanti', 'P'],
            ['2526011119018', 'Putri Carrisa Nur Azmy', 'P'],
            ['2526011119019', 'Rini Agustin Putri Firdaus', 'P'],
            ['2526011119020', 'Saeka Agustiani', 'P'],
            ['2526011119021', 'Syalia Zahratusyifa', 'P'],
            ['2526011119022', 'Tyara Oktafya Sriwahyuni', 'P'],
            ['2526011119023', 'Zahra Nur Faridah', 'P'],
        ], 'XI AKT', 'Akuntansi dan Keuangan Lembaga', 'XI', 'Anton Mulyana, S.Sos.');
    }

    // ─────────────────────────────────────────────────────
    private function seedKelasXII(): void
    {
        // XII RPL 1
        $this->insert([
            ['242518070006', 'Anggella Berliana Lusambudi', 'P'],
            ['242518070008', 'Arham Yaasin', 'L'],
            ['242518070009', 'Aris Alfarizi', 'L'],
            ['242518070011', 'Arya Teja Arum', 'L'],
            ['242518070012', 'Azky Fauzan', 'L'],
            ['242518070013', 'Benjamin Athallah Muhammad', 'L'],
            ['242518070019', 'Fahmi Umar Syarif', 'L'],
            ['242518070022', 'Faizatul Ilham', 'L'],
            ['242518070023', 'Fardhan Darmawan Subrata', 'L'],
            ['242518070024', 'Fasha Shauman Ramadhan', 'L'],
            ['242518070025', 'Fauzan Alfarizi Setiawan', 'L'],
            ['242518070026', 'Fauzi Abdurrahman Aziz', 'L'],
            ['242518070029', 'Gautama Ramadhan Garnida', 'L'],
            ['242518070030', 'Haikal Hanan Adela', 'L'],
            ['242518070031', 'Hisyam Faisal', 'L'],
            ['242518070032', 'Krisna Ramdani', 'L'],
            ['242518070033', 'Lutfi Febriasyah', 'L'],
            ['242518070034', 'Muhamad Ghifari Nurrazaq', 'L'],
            ['242518070050', 'Nuril Huda', 'L'],
            ['242518070040', 'Priyamukti Azalia Trihapsoro', 'L'],
            ['242518070042', 'Rafa Fauzan Pratama', 'L'],
            ['242518070044', 'Randy Rizky Putra Mahardika', 'L'],
            ['242518070045', 'Rizki Noval Saputra', 'L'],
            ['242518070046', 'Salman Avicenna Andriansah', 'L'],
            ['242518070049', 'Zakia Abdillah Az-Zahra', 'L'],
            ['242518070048', 'Syifa Nurnabilla', 'P'],
        ], 'XII RPL 1', 'Rekayasa Perangkat Lunak', 'XII', 'Ajeng Susanti, S.Pd.');

        // XII RPL 2
        $this->insert([
            ['242518070002', 'Adid Yulianto', 'L'],
            ['242518070003', 'Ahmad Fauzan', 'L'],
            ['242518070005', 'Alvi Fauzan Al-Farizi', 'L'],
            ['242518070007', 'Anwar Abdulah', 'L'],
            ['242518070010', 'Arkana Alfarizi Devantara', 'L'],
            ['242518070014', 'Dedin Syauqi Al-Fahri', 'L'],
            ['242518070015', 'Detran Rizki Firmansyah', 'L'],
            ['242518070016', 'Dika Muhammad Al-Fath Baharizqi', 'L'],
            ['242518070017', 'Dimas Rizki Maulana Yusuf', 'L'],
            ['242518070020', 'Faiq Adila', 'L'],
            ['242518070021', 'Fairuz Al Sahabir Afli', 'L'],
            ['242518070027', 'Febrian Qaidan Nasik', 'L'],
            ['242518070028', 'Fikrul Islam Al Amiq', 'L'],
            ['242518070035', 'Muhammad Algiffari Ramadhani', 'L'],
            ['242518070036', 'Muhammad Bagir Almaliqy Kastaman', 'L'],
            ['242518070037', 'Muhammad Dzakiy Kamil', 'L'],
            ['242518070038', 'Muhammad Fauzan Nurdiana', 'L'],
            ['242518070039', 'Muhammad Nazril Putra Natrabu', 'L'],
            ['242518070041', 'Raditya Bagas Wicaksono', 'L'],
            ['242518070043', 'Rakha Al Farizi Abdul Jabar', 'L'],
            ['242518070047', 'Septian Ramadhan Dwiyanto', 'L'],
            ['242518070051', 'Zaky Zulfiqar', 'L'],
        ], 'XII RPL 2', 'Rekayasa Perangkat Lunak', 'XII', 'Salma Fauziyyah, S.Psi.');

        // XII DKV
        $this->insert([
            ['242515084001', 'Aftah Ardiansyah', 'L'],
            ['242515084002', 'Aghniya Inayati Muthmainnah', 'P'],
            ['242515084003', 'Ahmad Zaki', 'L'],
            ['242515084004', 'Allifian Nurrahman', 'L'],
            ['242515084005', 'Andika Zafiansyah TS', 'L'],
            ['242515084006', 'Anisa Fitri Awaliah', 'P'],
            ['242515084011', 'Ikhwan', 'L'],
            ['242515084012', 'Jaka Bandung Rijkiawan Hamdani', 'L'],
            ['242515084013', 'Keyla Safa Nurhidayat', 'P'],
            ['242515084014', 'Marsya Malik Musaffa', 'L'],
            ['242515084015', 'Miqdam Alwan Afghani', 'L'],
            ['242515084016', 'Muhammad Dimas Dzulfitra', 'L'],
            ['242515084017', 'Muhammad Rasendriya Arkana', 'L'],
            ['242515084018', 'Novan Afgan Sobariman', 'L'],
            ['242515084023', 'Raisa Rona Zahra', 'P'],
            ['242515084019', 'Raisya Agrasandhya Putri Nurdimaja', 'P'],
            ['242515084020', 'Raisya Almahira', 'P'],
            ['242515084021', 'Rifki Surya Ramdani', 'L'],
            ['242515084022', 'Zahra Nursukma', 'P'],
        ], 'XII DKV', 'Desain Komunikasi Visual', 'XII', 'Dedi Junaedi, S.Ag.');

        // XII ANIMASI
        $this->insert([
            ['242515073001', 'Della Dwiyani', 'P'],
            ['242515073002', 'Ganis Rambu Basae', 'P'],
            ['242515073003', 'Hana Hamidah', 'P'],
            ['242515073004', 'Kirana Vilova Alwaysha Putri Aji', 'P'],
            ['242515073005', 'Muhammad Rezkya Ramadhan', 'L'],
            ['242515073006', 'Naisha Saqeena Almahyra', 'P'],
            ['242515073007', 'Qiera Raaihanah Almahira', 'P'],
            ['242515073008', 'Sania Putri Azizah', 'P'],
            ['242515073009', "Saskia Nur'aini An-Nazwa", 'P'],
        ], 'XII ANIMASI', 'Animasi', 'XII', 'Syifa Alfi Syahr, S.Kom.');

        // XII AKT
        $this->insert([
            ['242510119001', 'Alfi Laila Kamil', 'P'],
            ['242510119002', "A'rasyaa Syofha Noer Al-Fiyach", 'P'],
            ['242510119003', 'Azkha Khairunisa', 'P'],
            ['242510119004', 'Carissa Alvira Sabilatul Kamilah', 'P'],
            ['242510119005', 'Dara Anggraeni', 'P'],
            ['242510119006', 'Dewi Sri Lestari', 'P'],
            ['242510119007', 'Elvira Puspita Rahayu', 'P'],
            ['242510119008', 'Fadia Reina Rahayu', 'P'],
            ['242510119009', 'Fauzia Fitri', 'P'],
            ['242510119010', 'Felicia Febriany', 'P'],
            ['242510119011', 'Hanifa Shafa Afifah', 'P'],
            ['242510119012', 'Intan Fitri Rahmalia', 'P'],
            ['242510119013', 'Iren Sukma Watri Radius', 'P'],
            ['242510119014', 'Jihan Fahrunnisa Apriadi', 'P'],
            ['242510119015', 'Kheiradya Zhafira', 'P'],
            ['242510119016', 'Maudy Citra Aprezia', 'P'],
            ['242510119017', 'Meyfi Rizkatiara', 'P'],
            ['242510119018', 'Milanda Aprilyani', 'P'],
            ['242510119019', 'Nazwa Octavia Setiawan', 'P'],
            ['242510119020', 'Qirey Aprillia Putri', 'P'],
            ['242510119021', 'Revalina Octa Nur Fadilah', 'P'],
            ['242510119022', 'Reysa Alviany Nugraha', 'P'],
            ['242510119023', 'Rizqy Alfahreza', 'L'],
            ['242510119024', 'Shanny Aulia', 'P'],
            ['242510119025', 'Shintya Ayu Ramadhani', 'P'],
            ['242510119026', 'Sindi Yuliantini', 'P'],
            ['242510119027', 'Tiara Elitya Ramadhani', 'P'],
            ['242510119028', 'Ula Aulia', 'P'],
            ['242510119029', 'Vera Chintia Sari', 'P'],
            ['242510119030', 'Vinna Plantika', 'P'],
            ['242510119031', 'Wulan Salsabilah', 'P'],
            ['242510119032', 'Zachrani Agustin Hidayat', 'P'],
            ['242510119033', 'Zahra Andriani Putri', 'P'],
            ['242510119034', 'Zaskia Rizki Syammi', 'P'],
            ['242510119035', 'Derlin Gusviani', 'P'],
        ], 'XII AKT', 'Akuntansi dan Keuangan Lembaga', 'XII', 'Kania Rachmawati, S.Ag.');

        // XII BISNIS DIGITAL
        $this->insert([
            ['242507121001', 'Alifa Muthia', 'P'],
            ['242507121002', 'Arkana Putra Permana', 'L'],
            ['242507121003', 'Devi Siti Nur Aulia', 'P'],
            ['242507121005', 'Fairus Nadhir Amrullah', 'L'],
            ['242507121006', 'Luqita Fransiska Putri', 'P'],
            ['242507121007', 'Qisty Auni Nurrania', 'P'],
            ['242507121008', 'Rifkan Surya Ramdan', 'L'],
            ['242507121009', 'Riki Habib Rizis TS', 'L'],
            ['242507121010', 'Zahra Putri Maharani', 'P'],
        ], 'XII BISNIS DIGITAL', 'Pemasaran', 'XII', 'Ririn Suharnita, S.Hum.');
    }
}
