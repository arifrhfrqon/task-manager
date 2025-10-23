@extends('layouts.app')
@section('title', 'Akses Ditolak')
@section('content')
<div class="text-center mt-5">
    <h2 class="text-danger">403 | Akses Ditolak</h2>
    <p>Anda tidak memiliki izin untuk mengakses halaman ini.</p>
    <a href="{{ route('dashboard') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection
