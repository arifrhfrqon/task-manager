@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container text-center mt-5">
    <h3>Dashboard — Admin</h3>
    <p>Selamat datang, {{ auth()->user()->name }}. Anda admin.</p>
    <a href="{{ route('users.index') }}" class="btn btn-primary mt-3">Kelola Users</a>
    <a href="{{ route('tasks.index') }}" class="btn btn-success mt-3">Kelola Tasks</a>
    <a href="{{ route('videos.index') }}" class="btn btn-warning mt-3">Kelola Video</a>
</div>
@endsection
