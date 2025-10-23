@extends('layouts.app')
@section('title', 'Roles')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Daftar Role</h3>
    <a href="{{ route('roles.create') }}" class="btn btn-success">+ Tambah Role</a>
</div>

<table class="table table-bordered table-striped">
    <thead class="table-primary text-center">
        <tr>
            <th>ID</th>
            <th>Nama Role</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($roles as $r)
        <tr>
            <td>{{ $r->id }}</td>
            <td>{{ $r->name }}</td>
            <td class="text-center">
                <a href="{{ route('roles.edit', $r->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('roles.destroy', $r->id) }}" method="POST" class="d-inline">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
