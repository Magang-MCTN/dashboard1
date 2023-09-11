<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pengajuan Barang</title>
    <style>
        /* Atur gaya CSS sesuai kebutuhan */
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            margin: 20px;
        }
        .header {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #000;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        .signature {
            margin-top: 30px;
            text-align: center;

        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            Pengajuan Barang
        </div>

        <table>
            <thead>
                <tr>
                    <th>Nama Barang</th>
                    <th>Nomor Pengadaan</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                </tr>
            </thead>
            <tbody>

                <tr>
                    <td>{{ $pengajuanBarang->nama_barang }}</td>
                    <td>{{ $pengajuanBarang->nomor_pengadaan }}</td>

                    <td>{{ $pengajuanBarang->jumlah }}</td>
                    <td>{{ $pengajuanBarang->harga }}</td>
                </tr>

            </tbody>
        </table>

        <div class="signature">
            <div>
                <p>Tanda Tangan Admin Tim</p>
                @if ($adminTimSignature)
                    {{-- <img src="{{ public_path("storage/app/public/signatures/".$adminTimSignature->signature) }}" alt=""> --}}
                    <img src="<?php echo $pic  ?>" width="10%" alt="">
                @else
                    <p>Tidak ada tanda tangan Admin Tim</p>
                @endif
            </div>
            <div>
                <p>Tanda Tangan Admin General</p>
                @if ($adminGeneralSignature)
                <img src="<?php echo $pica  ?>" width="10%" alt="">
                @else
                    <p>Tidak ada tanda tangan Admin General</p>
                @endif
            </div>
        </div>
    </div>
</body>
</html>
