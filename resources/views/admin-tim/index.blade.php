@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-14">
            <div class="card">
                <div class="card-header">{{ __('Daftar Pengajuan Barang') }}</div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @elseif(session('warning'))
                        <div class="alert alert-warning">{{ session('warning') }}</div>
                    @endif

                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nama Barang</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pengajuanBarang as $pengajuan)
                                <tr>
                                    <td>{{ $pengajuan->nama_barang }}</td>
                                    <td>
                                        @if($pengajuan->status === 'diajukan')
                                            <span class="badge badge-warning">Menunggu Tinjauan</span>
                                        @elseif($pengajuan->status === 'disetujui')
                                            <span class="badge badge-success">Disetujui</span>
                                        @elseif($pengajuan->status === 'ditolak')
                                            <span class="badge badge-danger">Ditolak</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($pengajuan->status === 'diajukan')
                                            <form action="{{ route('approveRequest', $pengajuan->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-success">Setujui</button>
                                            </form>
                                            <form action="{{ route('rejectRequest', $pengajuan->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-danger">Tolak</button>
                                            </form>
                                            <a href="{{ route('admin-tim.detail', $pengajuan->id) }}" class="btn btn-info">Lihat Detail</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
