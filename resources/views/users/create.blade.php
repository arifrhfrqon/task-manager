@extends('layouts.app')
@section('title', 'Tambah User')
@section('content')
<h4>Tambah User</h4>
<form method="POST" action="{{ route('users.store') }}">
    @csrf
    <div class="mb-3">
        <label>Nama</label>
        <input type="text" name="name" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Password</label>
        <input type="password" name="password" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Role</label>
        <select name="role_id" class="form-select" required>
            <option value="">-- Pilih Role --</option>
            @foreach($roles as $r)
            <option value="{{ $r->id }}">{{ $r->name }}</option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
</form>
@endsection
