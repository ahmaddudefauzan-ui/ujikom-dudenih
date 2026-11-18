@extends('layouts.app')
@section('title', 'Input Peminjaman')
@section('page-title', 'Input Peminjaman Baru')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-white fw-semibold">
        <i class="bi bi-box-arrow-right me-2 text-primary"></i>Form Input Peminjaman
    </div>
    <div class="card-body p-4">
        @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0 ps-3">
                @foreach($errors->all() as $e) <li>{{ $e }}</li> @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('petugas.pinjaman.store') }}" method="POST">
            @csrf
            <div class="row g-3">
                <div class="col-sm-8">
                    <label class="form-label fw-semibold small">Nama Peminjam <span class="text-danger">*</span></label>
                    <input type="text" name="nama_peminjam" id="nama_peminjam" class="form-control @error('nama_peminjam') is-invalid @enderror"
                        value="{{ old('nama_peminjam') }}" placeholder="Nama lengkap" required>
                    @error('nama_peminjam') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-sm-4">
                    <label class="form-label fw-semibold small">Jenis <span class="text-danger">*</span></label>
                    <select name="jenis_peminjam" id="jenisPeminjam" class="form-select" required>
                        @foreach(['Siswa','Guru','Staff','Tamu'] as $j)
                            <option value="{{ $j }}" {{ old('jenis_peminjam') == $j ? 'selected' : '' }}>{{ $j }}</option>
                        @endforeach
                    </select>
                </div>
                {{-- Siswa picker --}}
                <div class="col-12" id="siswaPicker" style="display:none">
                    <div class="p-3 rounded-3 border bg-light">
                        <label class="form-label fw-semibold small text-primary mb-2">
                            <i class="bi bi-search me-1"></i>Cari dari Data Siswa
                        </label>
                        <div class="row g-2">
                            <div class="col-sm-5">
                                <select id="filterKelas" class="form-select form-select-sm">
                                    <option value="">— Semua Kelas —</option>
                                    @foreach($kelasList as $k)
                                        <option value="{{ $k }}">{{ $k }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-7">
                                <input type="text" id="cariSiswa" class="form-control form-control-sm"
                                    placeholder="Ketik nama atau NIS...">
                            </div>
                        </div>
                        <div id="hasilSiswa" class="mt-2" style="max-height:160px;overflow-y:auto"></div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <label class="form-label fw-semibold small">NIS / NIP</label>
                    <input type="text" name="no_identitas" class="form-control"
                        value="{{ old('no_identitas') }}" placeholder="Nomor identitas (opsional)">
                </div>
                <div class="col-sm-6">
                    <label class="form-label fw-semibold small">No. HP</label>
                    <input type="text" name="no_hp" class="form-control"
                        value="{{ old('no_hp') }}" placeholder="08xx (opsional)">
                </div>
                <div class="col-sm-8">
                    <label class="form-label fw-semibold small">Barang <span class="text-danger">*</span></label>
                    <select name="barang_id" id="barangSelect"
                        class="form-select @error('barang_id') is-invalid @enderror" required>
                        <option value="">— Pilih Barang —</option>
                        @foreach($barangs as $b)
                            <option value="{{ $b->id }}"
                                data-stok="{{ $b->stok_tersedia }}"
                                {{ old('barang_id') == $b->id ? 'selected' : '' }}>
                                {{ $b->nama_barang }} (Stok: {{ $b->stok_tersedia }})
                            </option>
                        @endforeach
                    </select>
                    <div id="stokInfo" class="form-text text-success fw-semibold d-none">
                        <i class="bi bi-info-circle me-1"></i><span id="stokText"></span>
                    </div>
                    @error('barang_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-sm-4">
                    <label class="form-label fw-semibold small">Jumlah <span class="text-danger">*</span></label>
                    <input type="number" name="jumlah" id="jumlahInput"
                        class="form-control @error('jumlah') is-invalid @enderror"
                        value="{{ old('jumlah', 1) }}" min="1" required>
                    @error('jumlah') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-sm-6">
                    <label class="form-label fw-semibold small">Tanggal Rencana Kembali <span class="text-danger">*</span></label>
                    <input type="date" name="tanggal_kembali_rencana"
                        class="form-control @error('tanggal_kembali_rencana') is-invalid @enderror"
                        value="{{ old('tanggal_kembali_rencana') }}"
                        min="{{ date('Y-m-d') }}" required>
                    @error('tanggal_kembali_rencana') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-sm-6">
                    <label class="form-label fw-semibold small">Keperluan</label>
                    <input type="text" name="keperluan" class="form-control"
                        value="{{ old('keperluan') }}" placeholder="Keperluan peminjaman">
                </div>
                <div class="col-12">
                    <label class="form-label fw-semibold small">Catatan Internal</label>
                    <textarea name="catatan" class="form-control" rows="2"
                        placeholder="Catatan dari petugas">{{ old('catatan') }}</textarea>
                </div>
            </div>
            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i>Simpan</button>
                <a href="{{ route('petugas.pinjaman.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // ── Stok barang ──────────────────────────────────────
    document.getElementById('barangSelect').addEventListener('change', function () {
        const opt = this.options[this.selectedIndex];
        const stok = opt.dataset.stok;
        const info = document.getElementById('stokInfo');
        const txt = document.getElementById('stokText');
        const jml = document.getElementById('jumlahInput');

        if (stok !== undefined && this.value) {
            txt.textContent = 'Stok tersedia: ' + stok + ' unit';
            info.classList.remove('d-none');
            jml.max = stok;
        } else {
            info.classList.add('d-none');
            jml.removeAttribute('max');
        }
    });

    // ── Siswa picker ──────────────────────────────────────
    const jenisSel  = document.getElementById('jenisPeminjam');
    const picker    = document.getElementById('siswaPicker');
    const cariInput = document.getElementById('cariSiswa');
    const kelasSel  = document.getElementById('filterKelas');
    const hasil     = document.getElementById('hasilSiswa');

    function togglePicker() {
        picker.style.display = jenisSel.value === 'Siswa' ? 'block' : 'none';
    }
    jenisSel.addEventListener('change', togglePicker);
    togglePicker();

    let debounce;
    function fetchSiswa() {
        clearTimeout(debounce);
        debounce = setTimeout(() => {
            const q     = cariInput.value.trim();
            const kelas = kelasSel.value;
            if (q.length < 2 && !kelas) { hasil.innerHTML = ''; return; }

            fetch(`/api/siswa?q=${encodeURIComponent(q)}&kelas=${encodeURIComponent(kelas)}`)
                .then(r => r.json())
                .then(data => {
                    if (!data.length) {
                        hasil.innerHTML = '<p class="text-muted small mb-0 mt-1">Tidak ditemukan.</p>';
                        return;
                    }
                    hasil.innerHTML = data.map(s => `
                        <div class="d-flex justify-content-between align-items-center border rounded px-2 py-1 mb-1 bg-white siswa-item"
                             style="cursor:pointer"
                             data-nama="${s.nama_lengkap}" data-nis="${s.nis}">
                            <span><strong>${s.nama_lengkap}</strong> <small class="text-muted">${s.nis}</small></span>
                            <small class="badge bg-secondary">${s.kelas}</small>
                        </div>`).join('');

                    document.querySelectorAll('.siswa-item').forEach(el => {
                        el.addEventListener('click', () => {
                            document.getElementById('nama_peminjam').value = el.dataset.nama;
                            document.querySelector('[name="no_identitas"]').value = el.dataset.nis;
                            hasil.innerHTML = `<div class="alert alert-success py-1 mb-0 small">
                                <i class="bi bi-check-circle me-1"></i><strong>${el.dataset.nama}</strong> dipilih.
                            </div>`;
                            cariInput.value = '';
                        });
                    });
                });
        }, 300);
    }
    cariInput.addEventListener('input', fetchSiswa);
    kelasSel.addEventListener('change', fetchSiswa);
</script>
@endsection
