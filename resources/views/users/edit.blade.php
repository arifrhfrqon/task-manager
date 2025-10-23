@extends('layouts.app')
@section('title', 'Edit User')
@section('content')
<h4>Edit User</h4>
<form method="POST" action="{{ route('users.update', $user->id) }}">
    @csrf @method('PUT')
    <div class="mb-3">
        <label>Nama</label>
        <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
    </div>
    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
    </div>
    <div class="mb-3">
        <label>Role</label>
        <select name="role_id" class="form-select" required>
            @foreach($roles as $r)
            <option value="{{ $r->id }}" @if($r->id == $user->role_id) selected @endif>{{ $r->name }}</option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection
