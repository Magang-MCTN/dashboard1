@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Detail Pengajuan Barang') }}</div>

                <div class="card-body">
                    <h5>Nama Barang: {{ $pengajuan->nama_barang }}</h5>
                    <p>Nomor Pengadaan: {{ $pengajuan->nomor_pengadaan }}</p>
                    <p>Jumlah: {{ $pengajuan->jumlah }}</p>
                    <p>Harga: {{ $pengajuan->harga }}</p>
                    <p>Tanggal Pengajuan: {{ $pengajuan->tanggal_pengajuan }}</p>
                    <!-- Tampilkan informasi lain yang relevan sesuai kebutuhan Anda -->

                    <!-- Tambahkan tautan atau tombol untuk kembali ke daftar pengajuan -->
                    <a href="{{ route('admintim') }}" class="btn btn-primary">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
