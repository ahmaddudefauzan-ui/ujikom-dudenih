@if($errors->any())
<div class="alert alert-danger">
    <ul class="mb-0 ps-3">
        @foreach($errors->all() as $e) <li>{{ $e }}</li> @endforeach
    </ul>
</div>
@endif

<div class="row g-3">
    <div class="col-sm-4">
        <label class="form-label fw-semibold small">Kode Barang <span class="text-danger">*</span></label>
        <input type="text" name="kode_barang" class="form-control @error('kode_barang') is-invalid @enderror"
            value="{{ old('kode_barang', $barang->kode_barang ?? '') }}" placeholder="BRG-001" required>
        @error('kode_barang') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-sm-8">
        <label class="form-label fw-semibold small">Nama Barang <span class="text-danger">*</span></label>
        <input type="text" name="nama_barang" class="form-control @error('nama_barang') is-invalid @enderror"
            value="{{ old('nama_barang', $barang->nama_barang ?? '') }}" placeholder="Nama barang" required>
        @error('nama_barang') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-sm-6">
        <label class="form-label fw-semibold small">Kategori <span class="text-danger">*</span></label>
        <select name="kategori_id" class="form-select @error('kategori_id') is-invalid @enderror" required>
            <option value="">— Pilih Kategori —</option>
            @foreach($kategoris as $k)
                <option value="{{ $k->id }}"
                    {{ old('kategori_id', $barang->kategori_id ?? '') == $k->id ? 'selected' : '' }}>
                    {{ $k->nama_kategori }}
                </option>
            @endforeach
        </select>
        @error('kategori_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-sm-6">
        <label class="form-label fw-semibold small">Ruangan <span class="text-danger">*</span></label>
        <select name="ruangan_id" class="form-select @error('ruangan_id') is-invalid @enderror" required>
            <option value="">— Pilih Ruangan —</option>
            @foreach($ruangans as $r)
                <option value="{{ $r->id }}"
                    {{ old('ruangan_id', $barang->ruangan_id ?? '') == $r->id ? 'selected' : '' }}>
                    {{ $r->nama_ruangan }}
                </option>
            @endforeach
        </select>
        @error('ruangan_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-sm-3">
        <label class="form-label fw-semibold small">Stok Total <span class="text-danger">*</span></label>
        <input type="number" name="stok_total" class="form-control @error('stok_total') is-invalid @enderror"
            value="{{ old('stok_total', $barang->stok_total ?? 0) }}" min="0" required>
        @error('stok_total') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-sm-3">
        <label class="form-label fw-semibold small">Stok Tersedia <span class="text-danger">*</span></label>
        <input type="number" name="stok_tersedia" class="form-control @error('stok_tersedia') is-invalid @enderror"
            value="{{ old('stok_tersedia', $barang->stok_tersedia ?? 0) }}" min="0" required>
        @error('stok_tersedia') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-sm-3">
        <label class="form-label fw-semibold small">Kondisi <span class="text-danger">*</span></label>
        <select name="kondisi" class="form-select @error('kondisi') is-invalid @enderror" required>
            @foreach(['Baik','Rusak Ringan','Rusak Berat'] as $k)
                <option value="{{ $k }}"
                    {{ old('kondisi', $barang->kondisi ?? 'Baik') == $k ? 'selected' : '' }}>
                    {{ $k }}
                </option>
            @endforeach
        </select>
        @error('kondisi') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-sm-3">
        <label class="form-label fw-semibold small">Tahun Pengadaan</label>
        <input type="number" name="tahun_pengadaan" class="form-control"
            value="{{ old('tahun_pengadaan', $barang->tahun_pengadaan ?? '') }}"
            min="2000" max="{{ date('Y') }}" placeholder="{{ date('Y') }}">
    </div>
    <div class="col-sm-6">
        <label class="form-label fw-semibold small">Merk / Tipe</label>
        <input type="text" name="merk" class="form-control"
            value="{{ old('merk', $barang->merk ?? '') }}" placeholder="Contoh: Dell, Acer, Panasonic">
    </div>
    <div class="col-12">
        <label class="form-label fw-semibold small">Keterangan</label>
        <textarea name="keterangan" class="form-control" rows="2"
            placeholder="Keterangan tambahan">{{ old('keterangan', $barang->keterangan ?? '') }}</textarea>
    </div>
</div>
