@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
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
                            @foreach($pengadaanBarang as $pengajuan)
                                <tr>
                                    <td>{{ $pengajuan->nama_barang }}</td>
                                    <td>
                                        @if($pengajuan->status === 'disetujui_admin_general')
                                            <span class="badge badge-success">Disetujui Admin General</span>
                                        @else
                                            <span class="badge badge-warning">Menunggu Tinjauan Admin General</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin-general.detail', $pengajuan->id) }}" class="btn btn-info">Lihat Detail</a>
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
