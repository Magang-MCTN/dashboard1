<?php

namespace App\Http\Controllers;

use App\Models\PengadaanBarang;
use Illuminate\Http\Request;
use App\Pengadaan; // Pastikan Anda mengimpor model Pengadaan atau sesuaikan dengan model yang sesuai

class AdminTimController extends Controller
{
    public function index()
    {
        // Tampilkan daftar pengajuan barang yang perlu ditinjau oleh admin tim
        $pengajuanBarang = PengadaanBarang::where('status', 'pengajuan')->get();
        return view('admin-tim.index', compact('pengajuanBarang'));
    }

    public function approveRequest(Request $request, $id)
    {
        // Menyetujui pengajuan barang
        $pengajuan = PengadaanBarang::findOrFail($id);
        $pengajuan->status = 'disetujui';
        $pengajuan->save();

        return redirect()->back()->with('success', 'Pengajuan barang telah disetujui.');
    }

    public function rejectRequest(Request $request, $id)
    {
        // Menolak pengajuan barang
        $pengajuan = PengadaanBarang::findOrFail($id);
        $pengajuan->status = 'ditolak';
        $pengajuan->save();

        return redirect()->back()->with('warning', 'Pengajuan barang telah ditolak.');
    }

    // Metode-metode lain sesuai kebutuhan
}
