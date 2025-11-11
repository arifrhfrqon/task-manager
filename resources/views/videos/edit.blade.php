@extends('layouts.app')

@section('title', 'Edit Video')

@section('content')
<div class="container mt-4">
    <h3>Edit Video</h3>

    <form action="{{ route('videos.update', $video->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Judul</label>
            <input type="text" name="title" class="form-control" value="{{ $video->title }}" required>
        </div>

        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="description" class="form-control">{{ $video->description }}</textarea>
        </div>

        <div class="mb-3">
            <label>Akses</label>
            <select name="access_level" class="form-select">
                <option value="full" {{ $video->access_level == 'full' ? 'selected' : '' }}>Full Access</option>
                <option value="preview" {{ $video->access_level == 'preview' ? 'selected' : '' }}>Preview (Akses Terbatas)</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Durasi Tonton (menit)</label>
            <input type="number" name="duration" class="form-control" value="{{ $video->duration }}">
            <small class="text-muted">Kosongkan jika tidak ada batas waktu.</small>
        </div>

        <div class="mb-3">
            <label>Video saat ini:</label><br>
            <video width="300" controls>
                <source src="{{ asset('storage/' . $video->video_path) }}">
            </video>
        </div>

        <div class="mb-3">
            <label>Upload Video Baru (Opsional)</label>
            <input type="file" name="video" class="form-control">
            <small class="text-muted">Biarkan kosong jika tidak ingin mengganti video.</small>
        </div>

        <button type="submit" class="btn btn-success">Update Video</button>
        <a href="{{ route('videos.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
