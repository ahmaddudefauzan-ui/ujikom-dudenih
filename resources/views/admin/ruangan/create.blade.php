@extends('layouts.app')
@section('title', 'Tambah Ruangan')
@section('page-title', 'Tambah Ruangan')

@section('content')
<div class="row justify-content-center">
<div class="col-lg-6">
<div class="card shadow-sm">
    <div class="card-header bg-white fw-semibold">
        <i class="bi bi-building me-2 text-primary"></i>Form Tambah Ruangan
    </div>
    <div class="card-body p-4">
        <form action="{{ route('admin.ruangan.store') }}" method="POST">
            @csrf
            @include('admin.ruangan._form')
            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i>Simpan</button>
                <a href="{{ route('admin.ruangan.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
</div>
</div>
@endsection
