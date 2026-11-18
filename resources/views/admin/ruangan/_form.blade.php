@if($errors->any())
<div class="alert alert-danger">
    <ul class="mb-0 ps-3">
        @foreach($errors->all() as $e) <li>{{ $e }}</li> @endforeach
    </ul>
</div>
@endif

<div class="mb-3">
    <label class="form-label fw-semibold small">Kode Ruangan <span class="text-danger">*</span></label>
    <input type="text" name="kode_ruangan" class="form-control @error('kode_ruangan') is-invalid @enderror"
        value="{{ old('kode_ruangan', $ruangan->kode_ruangan ?? '') }}"
        placeholder="Contoh: RG-001" required>
    @error('kode_ruangan') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label class="form-label fw-semibold small">Nama Ruangan <span class="text-danger">*</span></label>
    <input type="text" name="nama_ruangan" class="form-control @error('nama_ruangan') is-invalid @enderror"
        value="{{ old('nama_ruangan', $ruangan->nama_ruangan ?? '') }}"
        placeholder="Contoh: Lab Komputer 1" required>
    @error('nama_ruangan') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label class="form-label fw-semibold small">Lokasi</label>
    <input type="text" name="lokasi" class="form-control"
        value="{{ old('lokasi', $ruangan->lokasi ?? '') }}"
        placeholder="Contoh: Gedung B, Lantai 2">
</div>

<div class="mb-3">
    <label class="form-label fw-semibold small">Keterangan</label>
    <textarea name="keterangan" class="form-control" rows="3"
        placeholder="Keterangan tambahan">{{ old('keterangan', $ruangan->keterangan ?? '') }}</textarea>
</div>
