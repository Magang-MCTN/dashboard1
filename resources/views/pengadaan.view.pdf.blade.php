<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pengajuan Barang</title>
    <!-- Atur gaya CSS sesuai kebutuhan -->
    <style>
        /* Isi gaya CSS Anda di sini */
    </style>
</head>
<body>
    <h1>Pengajuan Barang</h1>

    <table>
        <tr>
            <th>Nama Barang</th>
            <th>Nomor Pengadaan</th>
            <th>Jumlah</th>
            <th>Harga</th>
        </tr>
        @foreach ($pengajuanBarang as $barang)
            <tr>
                <td>{{ $barang->nama_barang }}</td>
                <td>{{ $barang->nomor_pengadaan }}</td>
                <td>{{ $barang->jumlah }}</td>
                <td>{{ $barang->harga }}</td>
            </tr>
        @endforeach
    </table>

    <!-- Kolom Tanda Tangan Admin Tim -->
    <div class="admin-tim-signature">
        <p>Tanda Tangan Admin Tim</p>
        <!-- Tambahkan gambar tanda tangan Admin Tim di sini -->
        <!-- Contoh: <img src="path_ke_gambar_tanda_tangan_admin_tim.png" alt="Tanda Tangan Admin Tim"> -->
    </div>

    <!-- Kolom Tanda Tangan Admin General -->
    <div class="admin-general-signature">
        <p>Tanda Tangan Admin General</p>
        <!-- Tambahkan gambar tanda tangan Admin General di sini -->
        <!-- Contoh: <img src="path_ke_gambar_tanda_tangan_admin_general.png" alt="Tanda Tangan Admin General"> -->
    </div>
</body>
</html>
