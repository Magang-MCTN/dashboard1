@extends('dashboard.app')

@section('content')
<form method="POST" action="{{ route('admin.users.update', $user->id) }}">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="name">Nama</label>
        <input type="text" name="name" id="name" value="{{ $user->name }}" class="form-control">
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="{{ $user->email }}" class="form-control">
    </div>
    <div class="form-group">
        <label for="level">Level</label>
        <select id="level" class="form-control @error('level') is-invalid @enderror" name="level" required>
            <option value="User">User</option>
            <option value="Admin Tim">Admin Tim</option>
            <option value="Admin General">Admin General</option>
            <option value="Admin Manager">Admin Manager</option>
            <option value="Administrator">Administrator</option>
        </select>
    </div>
    <div class="form-group">
        <label for="jabatan">Jabatan</label>
        <input type="text" name="jabatan" id="jabatan" value="{{ $user->jabatan }}" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Perbarui</button>
</form>

@endsection
