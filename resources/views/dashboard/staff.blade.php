@extends('layouts.app')

@section('title', 'Dashboard Staff')

@section('content')
<div class="container text-center mt-5">
    <h3>Dashboard — Staff</h3>
    <p>Halo, {{ auth()->user()->name }}. Anda dapat melihat tugas yang ditugaskan kepada Anda.</p>
    <a href="{{ route('staff.tasks.index') }}" class="btn btn-primary mt-3">Lihat Task Saya</a>
</div>
@endsection
