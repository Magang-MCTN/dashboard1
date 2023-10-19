@extends('dashboard.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h3 class="text-center">Detail User</h3>
                <div class="container col">
                    <div class="row px-5 pt-2">
                        <div class="col">
                            <h6>Name</h6>
                        </div>
                        <div class="col">
                            <h6>{{ $user->name }}</h6>
                        </div>
                    </div>
                    <hr>

                    <div class="row px-5 pt-2">
                        <div class="col">
                            <h6>Email</h6>
                        </div>
                        <div class="col">
                            <h6>{{ $user->email }}</h6>
                        </div>
                    </div>
                    <hr>

                    <div class="row px-5 pt-2">
                        <div class="col">
                            <h6>Jabatan</h6>
                        </div>
                        <div class="col">
                            <h6>{{ $user->jabatan }}</h6>
                        </div>
                    </div>
                    <hr>

                    <div class="row px-5 pt-2">
                        <div class="col">
                            <h6>Level</h6>
                        </div>
                        <div class="col">
                            <h6>{{ $user->level }}</h6>
                        </div>
                    </div>
                    <hr>
                </div>
                <div class="container my-2">
                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-info">Ubah</a>
                    <a href="{{ route('admin.users.destroy', $user->id) }}" class="btn btn-danger">Hapus</a>
                </div>
                <div class="container my-2">
                    <a href="{{ route('admin.users.index', $user->id) }}" class="btn btn-primary">Kembali</a>
                </div>
            </div>
        </div>
    </div>
@endsection
