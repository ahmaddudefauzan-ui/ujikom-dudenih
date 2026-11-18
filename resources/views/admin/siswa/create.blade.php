@extends('layouts.app')
@section('title', 'Tambah Siswa')
@section('page-title', 'Tambah Data Siswa')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center border-bottom">
                <span class="fw-bold text-dark">
                    <i class="bi bi-person-plus-fill me-2 text-primary"></i>Formulir Tambah Data Siswa Baru
                </span>
                <a href="{{ route('admin.siswa.index') }}" class="btn btn-outline-secondary btn-sm">
                    <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar
                </a>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('admin.siswa.store') }}" method="POST">
                    @csrf
                    @include('admin.siswa._form')
                    <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">
                        <a href="{{ route('admin.siswa.index') }}" class="btn btn-light px-3">Batal</a>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-save me-1"></i> Simpan Data Siswa
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
