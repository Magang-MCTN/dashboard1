@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-15">
            <div class="card">
                <div class="card-header">{{ __('Form Pengajuan Barang') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('barang') }}">
                        @csrf

                        <div class="form-group">
                            <label for="nama_barang">Nama Barang</label>
                            <input type="text" name="nama_barang" id="nama_barang" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="nomor_pengadaan">Nomor Pengadaan</label>
                            <input type="text" name="nomor_pengadaan" id="nomor_pengadaan" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="jumlah">Jumlah</label>
                            <input type="number" name="jumlah" id="jumlah" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="harga">Harga</label>
                            <input type="number" name="harga" id="harga" class="form-control" required>
                        </div>
                        <label for="admin_tim">Pilih Admin Tim Tujuan:</label>
<select id="admin_tim" name="admin_tim">
    <option value="Admin Tim 1">Admin Tim 1</option>
    <option value="Admin Tim 2">Admin Tim 2</option>
    <!-- Tambahkan pilihan admin tim lainnya sesuai kebutuhan -->
</select>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
