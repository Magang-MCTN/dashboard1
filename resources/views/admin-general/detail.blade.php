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
                    <p>Harga: @currency($pengajuan->harga)</p>
                    <p>Tanggal Pengajuan: {{ $pengajuan->tanggal_pengajuan }}</p>
                    <!-- Tampilkan informasi lain yang relevan sesuai kebutuhan Anda -->

                    <!-- Tambahkan tautan atau tombol untuk kembali ke daftar pengajuan -->

<div class="d-flex">
    @if($pengajuan->status === 'disetujui_admin_tim')
    <form action="{{ route('admin-general.approve', $pengajuan->id) }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-success me-2" id="btn-approve">Setuju</button>
    </form>
    @endif

    @if($pengajuan->status === 'disetujui_admin_tim')
    <form action="{{ route('admin-general.reject', $pengajuan->id) }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-danger" id="btn-reject">Tolak</button>
    </form>
    @endif
</div>
<div class="d-flex">
    <div id="alasan-form" style="display: none;">
        <form action="{{ route('admin-general.approve', $pengajuan->id) }}" method="POST">
            @csrf
            <div class="form-group my-3 me-3">
                <label for="alasan">Alasan Setuju:</label><br>
                <textarea name="alasan" id="alasan" cols="40" rows="5" style="border-radius: 5px" required></textarea>
            </div>
            <button type="submit" class="btn btn-success">Setuju</button>
        </form>
    </div>

    <div id="alasan-tolak-form" style="display: none;">
        <form action="{{ route('admin-general.reject', $pengajuan->id) }}" method="POST">
            @csrf
            <div class="form-group my-3 me-3">
                <label for="alasan">Alasan Tolak:</label><br>
                <textarea name="alasan" id="alasan" cols="40" rows="5" style="border-radius: 5px" required></textarea>
            </div>
            <button type="submit" class="btn btn-danger">Tolak</button>
        </form>
    </div>
</div>
<a href="{{ route('admingeneral') }}" class="btn btn-primary my-4">Kembali</a>
<!-- Tampilkan tombol setuju dan tolak jika status pengajuan adalah diajukan -->

</div>
</div>
</div>
</div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
const btnApprove = document.getElementById('btn-approve');
const btnReject = document.getElementById('btn-reject');
const alasanForm = document.getElementById('alasan-form');
const alasanTolakForm = document.getElementById('alasan-tolak-form');

btnApprove.addEventListener('click', function(e) {
e.preventDefault();
if (alasanForm.style.display === 'block') {
alasanForm.style.display = 'none'; // Sembunyikan tampilan alasan setuju jika sudah terbuka
} else {
alasanForm.style.display = 'block'; // Tampilkan tampilan alasan setuju jika belum terbuka
alasanTolakForm.style.display = 'none'; // Sembunyikan tampilan alasan tolak jika terbuka
}
});

btnReject.addEventListener('click', function(e) {
e.preventDefault();
if (alasanTolakForm.style.display === 'block') {
alasanTolakForm.style.display = 'none'; // Sembunyikan tampilan alasan tolak jika sudah terbuka
} else {
alasanTolakForm.style.display = 'block'; // Tampilkan tampilan alasan tolak jika belum terbuka
alasanForm.style.display = 'none'; // Sembunyikan tampilan alasan setuju jika terbuka
}
});
});
</script>
@endsection
