<!-- resources/views/status_pengadaan.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Status Pengadaan Barang') }}</div>

                <div class="card-body">
                    <h3>Riwayat Pengadaan Barang</h3>

                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nama Barang</th>
                                <th>Nomor Pengadaan</th>
                                <th>Status</th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pengadaanBarang as $item)
                                <tr>
                                    <td>{{ $item->nama_barang }}</td>
                                    <td>{{ $item->nomor_pengadaan }}</td>
                                    <td>
                                        @if($item->status === 'disetujui_admin_tim')
                                            <span class="badge badge-warning">Disetujui Admin Tim </span>

                                        @elseif($item->status === 'disetujui_admin_general')
                                                <span class="badge badge-success">Disetujui  </span>
                                                @elseif($item->status === 'diajukan')
                                                <span class="badge badge-warning">Menunggu Persetujuan </span>
                                        @else
                                            <span class="badge badge-danger">Di Tolak</span>
                                        @endif
                                    </td>
                                    <td><a href="{{ route('detail', $item->id) }}" class="btn btn-info">Lihat</a>
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
