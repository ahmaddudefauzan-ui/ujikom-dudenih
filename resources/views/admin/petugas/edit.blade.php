@extends('layouts.app')
@section('title', 'Edit Petugas')
@section('page-title', 'Edit Petugas')

@section('content')
<div class="row justify-content-center">
<div class="col-lg-5">
<div class="card shadow-sm">
    <div class="card-header bg-white fw-semibold">
        <i class="bi bi-pencil me-2 text-warning"></i>Edit Petugas: {{ $petugas->name }}
    </div>
    <div class="card-body p-4">
        @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0 ps-3">
                @foreach($errors->all() as $e) <li>{{ $e }}</li> @endforeach
            </ul>
        </div>
        @endif
        <form action="{{ route('admin.petugas.update', $petugas) }}" method="POST">
            @csrf @method('PUT')
            <div class="mb-3">
                <label class="form-label fw-semibold small">Nama <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name', $petugas->name) }}" required>
                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold small">Email <span class="text-danger">*</span></label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email', $petugas->email) }}" required>
                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold small">Password Baru</label>
                <input type="password" name="password" class="form-control"
                    placeholder="Kosongkan jika tidak diubah">
            </div>
            <div class="mb-4">
                <label class="form-label fw-semibold small">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="form-control"
                    placeholder="Ulangi password baru">
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-warning"><i class="bi bi-save me-1"></i>Perbarui</button>
                <a href="{{ route('admin.petugas.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
</div>
</div>
@endsection
