@extends('layouts.app')

@section('title', 'Dashboard Manager')

@section('content')
<div class="container text-center mt-5">
    <h3>Dashboard — Manager</h3>
    <p>Halo, {{ auth()->user()->name }}.</p>
    <a href="{{ route('manager.tasks.index') }}" class="btn btn-primary mt-3">Lihat / Kelola Tasks</a>
</div>
@endsection
