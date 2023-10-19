@extends('dashboard.app')

@section('content')
    <div class="container">
        <h1>Daftar Pengguna Baru</h1>

        <form method="post" action="{{ route('admin.users.store') }}">
            @csrf

            <div class="form-group">
                <label for="name">Nama Pengguna</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
            </div>

            <div class="form-group">
                <label for="jabatan">Jabatan</label>
                <input type="text" class="form-control" id="jabatan" name="jabatan" value="{{ old('jabatan') }}">
            </div>

            <div class="form-group">
                <label for="level">Level</label>
                <select id="level" class="form-control @error('level') is-invalid @enderror" name="level" required>
                    <option value="" selected disabled> Pilih Role </option>
                    <option value="User">User</option>
                    <option value="Admin Tim">Admin Tim</option>
                    <option value="Admin General">Admin General</option>
                    <option value="Admin Manager">Admin Manager</option>
                    <option value="Administrator">Administrator</option>
                </select>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>

            <div class="form-group">
                <label for="password_confirmation">Konfirmasi Password</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
            </div>

            <button type="submit" class="btn btn-primary">Daftar</button>
        </form>
    </div>
@endsection
