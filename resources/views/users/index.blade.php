@extends('layouts.app')
@section('title', 'Data User')
@section('content')
<div class="d-flex justify-content-between mb-3">
    <h4>Data User</h4>
    <a href="{{ route('users.create') }}" class="btn btn-success">Tambah User</a>
</div>

<table class="table table-bordered">
    <thead class="table-dark text-center">
        <tr>
            <th>#</th><th>Nama</th><th>Email</th><th>Role</th><th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $u)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $u->name }}</td>
            <td>{{ $u->email }}</td>
            <td>{{ $u->role->name }}</td>
            <td>
                <a href="{{ route('users.edit', $u->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('users.destroy', $u->id) }}" method="POST" class="d-inline">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus user ini?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
