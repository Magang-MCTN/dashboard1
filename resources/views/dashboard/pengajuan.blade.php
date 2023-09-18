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
                        <div>
                        <label for="admintim">Pilih Admin Tim Tujuan:</label>
                        <select id="admintim" name="admintim">
                            @foreach($adminTimList as $adminTimId => $adminTimName)
                                <option value="{{ $adminTimId }}">{{ $adminTimName }}</option>
                            @endforeach
                        </select>
                    </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
