@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Detail Pengajuan Barang') }}</div>
                <div class="card-body">
                    <h5> Nama Barang : {{ $pengajuan->nama_barang}} </h5>

                    <p>Nomor Pengadaan: {{ $pengajuan->nomor_pengadaan }}</p>
                    <p>Jumlah: {{ $pengajuan->jumlah }}</p>
                    <p>Harga: {{ $pengajuan->harga }}</p>
                    <p>Tanggal Pengajuan: {{ $pengajuan->tanggal_pengajuan }}</p>
                    <!-- Tampilkan informasi lain yang relevan sesuai kebutuhan Anda -->

                    <!-- Tambahkan tautan atau tombol untuk kembali ke daftar pengajuan -->
                    @if($pengajuan->status === 'disetujui_admin_tim')
                    <span class="badge bg-warning">Disetujui Admin Tim </span>

                @elseif($pengajuan->status === 'disetujui_admin_general')
                        <span class="badge bg-success">Disetujui  </span>
                        @elseif($pengajuan->status === 'diajukan')
                        <span class="badge bg-warning">Menunggu Persetujuan </span>
                @else
                    <span class="badge badge-danger">Di Tolak</span>
                @endif
                <div class="d-flex justify-content-between">

                    <a href="{{ route('status-pengadaan') }}" class="btn btn-secondary">Kembali</a>


                    <div  class="d-flex justify-content-end btn-wrapper">
                        <a href="#" class="btn btn-otline-dark align-items-center"><i class="icon-share"></i> Share</a>
                        <a href="{{ url('/generate-pdf/'.$pengajuan->id) }}" class="btn btn-otline-dark"><i class="icon-printer"></i> Print</a>
                        <a href="#" class="btn btn-otline-dark"><i class="icon-download"></i> Export</a>
                      </div>
                </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
