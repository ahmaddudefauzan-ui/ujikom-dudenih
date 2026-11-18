@if($errors->any())
<div class="alert alert-danger d-flex align-items-start gap-2 mb-4 rounded-3 border-0 shadow-sm" style="background:#fee2e2;color:#991b1b;">
    <i class="bi bi-exclamation-triangle-fill fs-5 mt-1 flex-shrink-0"></i>
    <div>
        <strong>Terdapat beberapa kesalahan pengisian:</strong>
        <ul class="mb-0 ps-3 mt-1 small">
            @foreach($errors->all() as $e)
                <li>{{ $e }}</li>
            @endforeach
        </ul>
    </div>
</div>
@endif

<div class="row g-4">
    {{-- Bagian Identitas Siswa --}}
    <div class="col-12">
        <div class="border-bottom pb-2 mb-3">
            <h6 class="fw-bold text-primary mb-0">
                <i class="bi bi-person-vcard me-2"></i>Identitas Siswa
            </h6>
            <small class="text-muted">Informasi identitas dasar siswa.</small>
        </div>
        <div class="row g-3">
            <div class="col-md-5">
                <label class="form-label fw-semibold small">NIS (Nomor Induk Siswa) <span class="text-danger">*</span></label>
                <input type="text" name="nis" class="form-control @error('nis') is-invalid @enderror"
                    value="{{ old('nis', $siswa->nis ?? '') }}" placeholder="Contoh: 2627020070001" required>
                @error('nis')
                    <div class="invalid-feedback">{{ $message }}</div>
                @else
                    <div class="form-text small text-muted">Nomor induk unik siswa di SMK Bakti Nusantara 666.</div>
                @enderror
            </div>
            <div class="col-md-7">
                <label class="form-label fw-semibold small">Nama Lengkap Siswa <span class="text-danger">*</span></label>
                <input type="text" name="nama_lengkap" class="form-control @error('nama_lengkap') is-invalid @enderror"
                    value="{{ old('nama_lengkap', $siswa->nama_lengkap ?? '') }}" placeholder="Contoh: Abdilah Malik Al-Jabbar" required>
                @error('nama_lengkap')
                    <div class="invalid-feedback">{{ $message }}</div>
                @else
                    <div class="form-text small text-muted">Format huruf kapital akan dirapikan secara otomatis saat disimpan.</div>
                @enderror
            </div>
            <div class="col-md-4">
                <label class="form-label fw-semibold small">Jenis Kelamin <span class="text-danger">*</span></label>
                <select name="jenis_kelamin" class="form-select @error('jenis_kelamin') is-invalid @enderror" required>
                    <option value="">— Pilih Jenis Kelamin —</option>
                    <option value="L" {{ old('jenis_kelamin', $siswa->jenis_kelamin ?? '') === 'L' ? 'selected' : '' }}>
                        Laki-laki
                    </option>
                    <option value="P" {{ old('jenis_kelamin', $siswa->jenis_kelamin ?? '') === 'P' ? 'selected' : '' }}>
                        Perempuan
                    </option>
                </select>
                @error('jenis_kelamin')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>
    </div>

    {{-- Bagian Akademik & Rombel --}}
    <div class="col-12">
        <div class="border-bottom pb-2 mb-3">
            <h6 class="fw-bold text-primary mb-0">
                <i class="bi bi-mortarboard me-2"></i>Informasi Akademik & Kelas
            </h6>
            <small class="text-muted">Penempatan rombongan belajar dan jurusan siswa.</small>
        </div>
        <div class="row g-3">
            <div class="col-md-3">
                <label class="form-label fw-semibold small">Tingkat <span class="text-danger">*</span></label>
                <select name="tingkat" id="tingkatSelect" class="form-select @error('tingkat') is-invalid @enderror" required>
                    <option value="">— Pilih Tingkat —</option>
                    @foreach(['X','XI','XII'] as $t)
                        <option value="{{ $t }}" {{ old('tingkat', $siswa->tingkat ?? '') === $t ? 'selected' : '' }}>
                            Kelas {{ $t }}
                        </option>
                    @endforeach
                </select>
                @error('tingkat')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-4">
                <label class="form-label fw-semibold small">Kelas <span class="text-danger">*</span></label>
                <input type="text" name="kelas" id="kelasInput" list="kelasList"
                    class="form-control @error('kelas') is-invalid @enderror"
                    value="{{ old('kelas', $siswa->kelas ?? '') }}" placeholder="Pilih atau ketik kelas (misal: X PPLG 1)" required autocomplete="off">
                <datalist id="kelasList">
                    @foreach($kelasList as $k)
                        <option value="{{ $k }}">
                    @endforeach
                </datalist>
                @error('kelas')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-5">
                <label class="form-label fw-semibold small">Jurusan / Program Keahlian <span class="text-danger">*</span></label>
                <input type="text" name="jurusan" id="jurusanInput" list="jurusanList"
                    class="form-control @error('jurusan') is-invalid @enderror"
                    value="{{ old('jurusan', $siswa->jurusan ?? '') }}" placeholder="Program keahlian" required autocomplete="off">
                <datalist id="jurusanList">
                    @foreach($jurusanList as $j)
                        <option value="{{ $j }}">
                    @endforeach
                </datalist>
                @error('jurusan')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-12">
                <label class="form-label fw-semibold small">Wali Kelas</label>
                <input type="text" name="wali_kelas" id="waliKelasInput" class="form-control @error('wali_kelas') is-invalid @enderror"
                    value="{{ old('wali_kelas', $siswa->wali_kelas ?? '') }}" placeholder="Nama guru wali kelas beserta gelar (opsional)">
                @error('wali_kelas')<div class="invalid-feedback">{{ $message }}</div>@enderror
                <div class="form-text small text-muted">Contoh: Rima Permata Ellya, S.Pd. atau Dr. Dani Wardani, S.Hum., M.Pd.</div>
            </div>
        </div>
    </div>
</div>

{{-- Autofill Script when picking a known class --}}
@if(isset($classMetadata))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const classMeta = @json($classMetadata);
        const kelasInput = document.getElementById('kelasInput');
        const tingkatSelect = document.getElementById('tingkatSelect');
        const jurusanInput = document.getElementById('jurusanInput');
        const waliKelasInput = document.getElementById('waliKelasInput');

        if (kelasInput) {
            kelasInput.addEventListener('change', function () {
                const val = this.value.trim();
                if (classMeta[val]) {
                    const data = classMeta[val];
                    if (data.tingkat && (!tingkatSelect.value || tingkatSelect.value === '')) {
                        tingkatSelect.value = data.tingkat;
                    }
                    if (data.jurusan && (!jurusanInput.value || jurusanInput.value === '')) {
                        jurusanInput.value = data.jurusan;
                    }
                    if (data.wali_kelas && (!waliKelasInput.value || waliKelasInput.value === '')) {
                        waliKelasInput.value = data.wali_kelas;
                    }
                }
            });
        }
    });
</script>
@endif
