@extends('layouts.app')@section('title','Tambah Task')@section('content')
<h4>Tambah Task</h4>
<form method="POST" action="{{ route('tasks.store') }}">@csrf
  <div class="mb-3"><label>Judul</label><input name="title" class="form-control" required></div>
  <div class="mb-3"><label>Deskripsi</label><textarea name="description" class="form-control"></textarea></div>
  <div class="mb-3"><label>Assign ke</label>
    <select name="assigned_to" class="form-select">
      <option value="">-- Pilih --</option>
      @foreach($users as $u)<option value="{{ $u->id }}">{{ $u->name }} ({{ $u->role->name }})</option>@endforeach
    </select>
  </div>
  <div class="mb-3"><label>Due Date</label><input type="date" name="due_date" class="form-control"></div>
  <button class="btn btn-primary">Simpan</button>
</form>
@endsection
