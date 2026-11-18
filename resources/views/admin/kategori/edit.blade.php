@extends('layouts.app')
@section('title', 'Edit Kategori')
@section('page-title', 'Edit Kategori')

@section('content')
<div class="row justify-content-center">
<div class="col-lg-5">
<div class="card shadow-sm">
    <div class="card-header bg-white fw-semibold">
        <i class="bi bi-pencil me-2 text-warning"></i>Edit Kategori: {{ $kategori->nama_kategori }}
    </div>
    <div class="card-body p-4">
        <form action="{{ route('admin.kategori.update', $kategori) }}" method="POST">
            @csrf @method('PUT')
            @include('admin.kategori._form')
            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-warning"><i class="bi bi-save me-1"></i>Perbarui</button>
                <a href="{{ route('admin.kategori.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
</div>
</div>
@endsection
