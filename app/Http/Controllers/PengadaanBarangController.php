<?php

namespace App\Http\Controllers;

use App\Models\PengadaanBarang;
use Illuminate\Http\Request;


class PengadaanBarangController extends Controller
{
    public function index()
    {
        // Menampilkan formulir pengajuan barang
        return view('dashboard.pengajuan');
    }

    public function store(Request $request)
    {
        // Menyimpan pengajuan barang yang diajukan oleh pengguna
        PengadaanBarang::create([
            'nama_barang' => $request->input('nama_barang'),
            'nomor_pengadaan' => $request->input('nomor_pengadaan'),
            'jumlah' => $request->input('jumlah'),
            'harga' => $request->input('harga'),
            'tanggal_pengajuan' => now(),
            'status' => 'diajukan',
            'user_id' => auth()->user()->id,
        ]);

        return redirect('/status-pengadaan')->with('success', 'Pengajuan barang berhasil disampaikan.');
    }

    public function status()
    {
        // Menampilkan status pengajuan barang oleh pengguna
        $pengadaanBarang = PengadaanBarang::where('user_id', auth()->user()->id)->get();
        return view('dashboard.status_pengajuan', compact('pengadaanBarang'));
    }
    public function detail($id)
    {
        $pengajuan = PengadaanBarang::findOrFail($id);

        return view('dashboard.detail', compact('pengajuan'));
    }
}
