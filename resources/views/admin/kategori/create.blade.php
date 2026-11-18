@extends('layouts.app')
@section('title', 'Tambah Kategori')
@section('page-title', 'Tambah Kategori')

@section('content')
<div class="row justify-content-center">
<div class="col-lg-5">
<div class="card shadow-sm">
    <div class="card-header bg-white fw-semibold">
        <i class="bi bi-tags me-2 text-primary"></i>Form Tambah Kategori
    </div>
    <div class="card-body p-4">
        <form action="{{ route('admin.kategori.store') }}" method="POST">
            @csrf
            @include('admin.kategori._form')
            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i>Simpan</button>
                <a href="{{ route('admin.kategori.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
</div>
</div>
@endsection
