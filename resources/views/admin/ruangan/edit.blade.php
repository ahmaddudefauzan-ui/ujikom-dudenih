@extends('layouts.app')
@section('title', 'Edit Ruangan')
@section('page-title', 'Edit Ruangan')

@section('content')
<div class="row justify-content-center">
<div class="col-lg-6">
<div class="card shadow-sm">
    <div class="card-header bg-white fw-semibold">
        <i class="bi bi-pencil me-2 text-warning"></i>Edit Ruangan: {{ $ruangan->nama_ruangan }}
    </div>
    <div class="card-body p-4">
        <form action="{{ route('admin.ruangan.update', $ruangan) }}" method="POST">
            @csrf @method('PUT')
            @include('admin.ruangan._form')
            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-warning"><i class="bi bi-save me-1"></i>Perbarui</button>
                <a href="{{ route('admin.ruangan.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
</div>
</div>
@endsection
