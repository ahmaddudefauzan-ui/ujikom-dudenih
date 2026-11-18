@extends('layouts.app')
@section('title', 'Edit Siswa')
@section('page-title', 'Edit Data Siswa')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center border-bottom">
                <span class="fw-bold text-dark">
                    <i class="bi bi-pencil-square me-2 text-warning"></i>Edit Data Siswa: <span class="text-primary">{{ $siswa->nama_lengkap }}</span>
                </span>
                <a href="{{ route('admin.siswa.index') }}" class="btn btn-outline-secondary btn-sm">
                    <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar
                </a>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('admin.siswa.update', $siswa) }}" method="POST">
                    @csrf
                    @method('PUT')
                    @include('admin.siswa._form')
                    <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">
                        <a href="{{ route('admin.siswa.index') }}" class="btn btn-light px-3">Batal</a>
                        <button type="submit" class="btn btn-warning px-4 text-dark fw-semibold">
                            <i class="bi bi-check-circle me-1"></i> Perbarui Data Siswa
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
