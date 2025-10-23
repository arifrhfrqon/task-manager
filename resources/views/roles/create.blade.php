@extends('layouts.app')
@section('title', 'Tambah Role')
@section('content')
<h3>Tambah Role</h3>
<form action="{{ route('roles.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label>Nama Role</label>
        <input type="text" name="name" class="form-control" required>
    </div>
    <button class="btn btn-primary">Simpan</button>
    <a href="{{ route('roles.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection
