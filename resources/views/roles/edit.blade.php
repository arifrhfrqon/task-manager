@extends('layouts.app')
@section('title', 'Edit Role')
@section('content')
<h3>Edit Role</h3>
<form action="{{ route('roles.update', $role->id) }}" method="POST">
    @csrf @method('PUT')
    <div class="mb-3">
        <label>Nama Role</label>
        <input type="text" name="name" value="{{ $role->name }}" class="form-control" required>
    </div>
    <button class="btn btn-primary">Update</button>
    <a href="{{ route('roles.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection
