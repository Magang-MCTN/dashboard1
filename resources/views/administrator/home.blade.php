{{-- @extends('dashboard.app')

@section('content')
    <h1>Daftar Pengguna</h1>
    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <a href="{{ route('admin.users.edit', $user->id) }}">Edit</a>
                        <form method="POST" action="{{ route('admin.users.destroy', $user->id)}}" >
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('admin.users.create') }}">Tambah Pengguna</a>
@endsection --}}
@extends('dashboard/app')

@section('content')

    <div class="container">
        <div class="card">
            <div class="card-body">
                <h3 class="text-center">Data User</h3>
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Jabatan</th>
                            <th>Level</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->jabatan }}</td>
                                <td>{{ $user->level }}</td>
                                <td>
                                    <a href="{{ route('admin.users.detail', $user->id) }}" class="btn btn-primary">Detail</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
