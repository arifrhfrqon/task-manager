@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Upload Video</h3>

    <form action="{{ route('videos.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label>Judul</label>
        <input type="text" name="title" class="form-control">

        <label>Deskripsi</label>
        <textarea name="description" class="form-control"></textarea>

        <label>Video</label>
        <input type="file" name="video" class="form-control">

        <label>Akses untuk Staff</label>
        <select name="access_level" class="form-select">
            <option value="full">Full</option>
            <option value="preview">Preview (Terbatas)</option>
        </select>

        <label>Durasi Akses (menit)</label>
        <input type="number" name="duration" class="form-control" placeholder="Misal: 60 / 1440 / 10080">

        <button class="btn btn-success mt-3">Upload</button>
    </form>
</div>
@endsection
    