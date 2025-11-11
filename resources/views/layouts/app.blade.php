<!DOCTYPE html><html lang="id"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>@yield('title','App')</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"></head><body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4"><div class="container">
<a class="navbar-brand" href="{{ route('dashboard') }}">Task Manager</a>
<div class="d-flex ms-auto">
    @auth
        <a class="btn btn-sm btn-light me-2" href="{{ route('dashboard') }}">Dashboard</a>
        @if(auth()->user()->role->name === 'admin')<a class="btn btn-sm btn-light me-2" href="{{ route('users.index') }}">Users</a>@endif
        @if(in_array(auth()->user()->role->name,['admin','manager']))<a class="btn btn-sm btn-light me-2" href="{{ route('tasks.index') }}">Tasks</a>@endif
        <form action="{{ route('logout') }}" method="POST">@csrf<button class="btn btn-danger btn-sm">Logout</button></form>
    @endauth
</div>
</div></nav>
<div class="container">@yield('content')</div>
</body></html>
