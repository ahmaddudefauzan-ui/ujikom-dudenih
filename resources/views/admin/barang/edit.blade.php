@extends('layouts.app')
@section('title', 'Edit Barang')
@section('page-title', 'Edit Barang')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-white fw-semibold">
        <i class="bi bi-pencil me-2 text-warning"></i>Edit Barang: {{ $barang->nama_barang }}
    </div>
    <div class="card-body p-4">
        <form action="{{ route('admin.barang.update', $barang) }}" method="POST">
            @csrf @method('PUT')
            @include('admin.barang._form')
            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-warning"><i class="bi bi-save me-1"></i>Perbarui</button>
                <a href="{{ route('admin.barang.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
