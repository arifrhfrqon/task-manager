@extends('layouts.app')
@section('title', 'Daftar Tugas')

@section('content')
<div class="container mt-4">
    <h3>Daftar Tugas</h3>

    @if(auth()->user()->role->name === 'admin')
        <a href="{{ route('tasks.create') }}" class="btn btn-success mb-3">+ Tambah Task</a>
    @endif

    <table class="table table-bordered">
        <thead class="table-light text-center">
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Deskripsi</th>
                <th>Assigned User</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tasks as $task)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $task->title }}</td>
                    <td>{{ $task->description }}</td>
                    <td>{{ $task->assignedUser->name ?? '-' }}</td>
                    <td class="text-center">{{ ucfirst(str_replace('_',' ',$task->status)) }}</td>
                    <td class="text-center">
                        @if(auth()->user()->role->name === 'admin')
                            <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin?')">Hapus</button>
                            </form>
                        @elseif(auth()->user()->role->name === 'manager')
                            <form action="{{ route('manager.tasks.updateStatus', $task->id) }}" method="POST" class="d-inline">
                                @csrf
                                <select name="status" class="form-select form-select-sm d-inline w-auto">
                                    <option value="pending" {{ $task->status=='pending'?'selected':'' }}>Pending</option>
                                    <option value="in_progress" {{ $task->status=='in_progress'?'selected':'' }}>In Progress</option>
                                    <option value="completed" {{ $task->status=='completed'?'selected':'' }}>Completed</option>
                                    <option value="rejected" {{ $task->status=='rejected'?'selected':'' }}>Rejected</option>
                                </select>
                                <button class="btn btn-primary btn-sm">Update</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
