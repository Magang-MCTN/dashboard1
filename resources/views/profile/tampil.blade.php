@extends('layouts.app')

@section('content')


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <p>
                        <a href="{{ url('password') }}" class="btn btn-success"><i class="fas fa-lock"></i> Ubah Password</a>
                    </p>
                    <table class="table table-bordered table-hover">
                        <tr>
                            <td>Nama Lengkap</td>
                            <td>{{ $users['name'] }}</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>{{ $users['email'] }}</td>
                        </tr>
                        <tr>
                            <td>Level</td>
                            <td>{{ $users['level'] }}</td>
                        </tr>

                        <tr>
                            <td>Tanda tangan</td>
                            <td>{{ $users['tanda_tangan'] }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
