@extends('layouts.app')

@section('title', 'Tugas Saya')

@section('content')
<div class="container mt-5">
    <h3 class="mb-4">Daftar Tugas Anda</h3>
    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>Judul</th>
                <th>Deskripsi</th>
                <th>Status</th>
                <th>Batas Waktu</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($tasks as $task)
                <tr>
                    <td>{{ $task->title }}</td>
                    <td>{{ $task->description }}</td>
                    <td>{{ ucfirst($task->status) }}</td>
                    <td>{{ $task->due_date }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">Belum ada tugas untuk Anda.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
