@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
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
                    <div class="d-flex p-2">
                    <a href="{{ route('admintim') }}" class="btn btn-primary">Kembali</a>
                    @if($pengajuan->status === 'diajukan')
                    <form action="{{ route('approveRequest', $pengajuan->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success">Setujui</button>
                    </form>
                    <form action="{{ route('rejectRequest', $pengajuan->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger">Tolak</button>
                    </form>

                @endif</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
