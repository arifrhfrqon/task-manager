@extends('layouts.app')

@section('title', 'Kelola Video')

@section('content')
<div class="container mt-4">

    <h3 class="mb-4 fw-bold">Kelola Video</h3>

    <a href="{{ route('videos.create') }}" class="btn btn-primary mb-3">+ Upload Video Baru</a>

    <table class="table table-bordered table-hover align-middle">
        <thead class="table-dark text-center">
            <tr>
                <th style="width: 50px;">#</th>
                <th>Judul</th>
                <th>Akses</th>
                <th>Durasi</th>
                <th>Preview</th>
                <th style="width: 180px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($videos as $v)
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>

                <td>{{ $v->title }}</td>

                <td class="text-center">
                    @if($v->access_level == 'full')
                        <span class="badge bg-success">Full</span>
                    @else
                        <span class="badge bg-warning text-dark">Preview</span>
                    @endif
                </td>

                <td class="text-center">
                    @if($v->duration)
                        <span class="badge bg-info text-dark">{{ $v->duration }} menit</span>
                    @else
                        <span class="badge bg-secondary">∞ Unlimited</span>
                    @endif
                </td>

                <td class="text-center">
                    <video width="200" controls style="border-radius: 6px;">
                        <source src="{{ asset('storage/'.$v->video_path) }}">
                    </video>
                </td>

                <td class="text-center">
                    <a href="{{ route('videos.edit', $v->id) }}" class="btn btn-sm btn-warning">Edit</a>

                    <form action="{{ route('videos.reset.access', $v->id) }}" method="POST" class="d-inline">
                        @csrf
                        <button class="btn btn-sm btn-info"
                                onclick="return confirm('Reset akses tonton untuk semua staff?')">
                            Reset Akses
                        </button>
                    </form>

                    <form action="{{ route('videos.destroy', $v->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus video ini?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                </td>

            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center text-muted py-4">
                    Belum ada video diunggah.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

</div>
@endsection
