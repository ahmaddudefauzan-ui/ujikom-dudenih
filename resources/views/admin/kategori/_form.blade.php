@if($errors->any())
<div class="alert alert-danger">
    <ul class="mb-0 ps-3">
        @foreach($errors->all() as $e) <li>{{ $e }}</li> @endforeach
    </ul>
</div>
@endif

<div class="mb-3">
    <label class="form-label fw-semibold small">Nama Kategori <span class="text-danger">*</span></label>
    <input type="text" name="nama_kategori" class="form-control @error('nama_kategori') is-invalid @enderror"
        value="{{ old('nama_kategori', $kategori->nama_kategori ?? '') }}"
        placeholder="Contoh: Elektronik" required>
    @error('nama_kategori') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label class="form-label fw-semibold small">Keterangan</label>
    <textarea name="keterangan" class="form-control" rows="3"
        placeholder="Keterangan kategori">{{ old('keterangan', $kategori->keterangan ?? '') }}</textarea>
</div>
