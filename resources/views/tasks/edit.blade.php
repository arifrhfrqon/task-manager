@extends('layouts.app')@section('title','Edit Task')@section('content')
<h4>Edit Task</h4>
<form method="POST" action="{{ route('tasks.update',$task->id) }}">@csrf @method('PUT')
  <div class="mb-3"><label>Judul</label><input name="title" class="form-control" value="{{ $task->title }}" required></div>
  <div class="mb-3"><label>Deskripsi</label><textarea name="description" class="form-control">{{ $task->description }}</textarea></div>
  <div class="mb-3"><label>Status</label>
    <select name="status" class="form-select">
      <option value="open" @if($task->status=='open') selected @endif>Open</option>
      <option value="in_progress" @if($task->status=='in_progress') selected @endif>In Progress</option>
      <option value="done" @if($task->status=='done') selected @endif>Done</option>
    </select>
  </div>
  <div class="mb-3"><label>Assign ke</label>
    <select name="assigned_to" class="form-select">
      <option value="">-- Pilih --</option>
      @foreach($users as $u)<option value="{{ $u->id }}" @if($task->assigned_to==$u->id) selected @endif>{{ $u->name }}</option>@endforeach
    </select>
  </div>
  <div class="mb-3"><label>Due Date</label><input type="date" name="due_date" class="form-control" value="{{ $task->due_date }}"></div>
  <button class="btn btn-primary">Update</button>
</form>
@endsection
