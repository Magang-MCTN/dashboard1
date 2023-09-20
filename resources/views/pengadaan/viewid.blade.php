<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pengajuan Barang</title>
    <style>
        /* Atur gaya CSS sesuai kebutuhan */
        .signature {
            margin-left: 180px;
        }

        .sign-1 {
            float: left;
            margin-right: 140px;
            text-align: center;
        }

        .sign-2 {
            float: left;
            text-align: center;
        }

        .ttd {
            max-width: 100%;
        }

        .clear {
            clear: both; /* Membersihkan float */
        }
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        img {
            display: flex;
            align-items: stretch;
            width: 100px;
        }
        table, th, td {
            border: 1px solid;
            width: 100%;
            border-collapse: collapse;
            text-align: center;
        }
        .container .header{
            text-align: center;
            font-size: 18px;
            font-weight: bold;
        }
        .container p{
            text-align: center;
        }
        .ttd {
            display: flex;
            align-items: center;
        }
        .header{
            padding: 5px;
        }
        .letterhead img{
            float: left;
            justify-content: center;
        }
        .letterhead {
            text-align: center;
            padding: 20px 0;
        }
        .letterhead h3 {
            margin: 0;
            font-size: 24px;
        }
        .letterhead p {
            margin: 0;
            font-size: 16px;
        }

    </style>
</head>
<body>
    <div class="letterhead">
        <img src="<?php echo $pics?>" alt="" style="width: 100px; background: transparent;">
        <h3>PT MANDAU CIPTA TENAGA NUSANTARA</h3>
        <p>HWA Tower, Lt 1 & 2 Jl. Ciputat Raya No. 123, Kebayoran LamaJakarta Selatan</p>
        <font size=2>Nomor PL : {{ $pengajuanBarang->nomor_pengadaan }}</font>
    </div>
    <hr>

    <div class="container">
        <center><h3>FORM PENGADAAN LANGSUNG BARANG/JASA </h3></center>
        <div class="header">
            Pengadaan {{ $pengajuanBarang->nama_barang }}
        </div>
        <p>{{ $pengajuanBarang->nomor_pengadaan }}</p><br>
        <p class="text">Berikut terlampir usulan Harga Perhitungan {{ $pengajuanBarang->nama_barang }} sejumlah {{ $pengajuanBarang->jumlah }} untuk pengadaan tersebut di atas, yakni senilai</p>
        <?php
        // Mengambil nilai harga per barang dan jumlah barang dari data
        $hargaPerBarang = $pengajuanBarang->harga;
        $jumlahBarang = $pengajuanBarang->jumlah;

        // Menghitung harga total
        $hargaTotal = $hargaPerBarang * $jumlahBarang;
        ?>
        <p>Rp. {{ $hargaTotal }}</p>

        <p class="text">Usulan Harga Perhitungan {{ $pengajuanBarang->nama_barang }} diatas mempertimbangkan dan tidak melebihi nilai pagu dana sebesar</p>
        <?php
        // Menghitung nilai baru setelah dikurangi 20 persen
        $hargaAwal = $hargaTotal;
        $potongan = 0.20; // 20 persen
        $hargaPertimbangan  = $hargaAwal - ($hargaAwal * $potongan);
        ?>
        <p>Rp. {{ $hargaPertimbangan }} </p>
    </div>

    <div class="signature">
        <div class="sign-1">
            <p>{{$adminTimjabatan}}</p>
            @if ($adminTimSignature)
                <img class="ttd" src="<?php echo $pic ?>" width="200px" alt="">
                <p>{{ $adminTimName }}</p>
            @else
                <p>Tidak ada tanda tangan Admin Tim</p>
            @endif

        </div>
        <div class="sign-2">
            <p>{{$adminGeneraljabatan}}</p>
            @if ($adminGeneralSignature)
                <img class="ttd" src="<?php echo $pica ?>" width="200px" alt="">
                <p>{{ $adminGeneralName }}</p>
            @else
                <p>Tidak ada tanda tangan Admin General</p>
            @endif
        </div>
        <div class="clear"></div> <!-- Membersihkan float -->
    </div>
</body>
</html>
