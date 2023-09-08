<?php

namespace App\Http\Controllers;

use App\Models\PengadaanBarang;
use Illuminate\Http\Request;


class AdminGeneralController extends Controller
{
    public function index()
    {
        // Menampilkan daftar pengadaan barang yang perlu ditinjau oleh admin general
        $pengadaanBarang = PengadaanBarang::where('status', 'disetujui_admin_tim')->get();
        return view('admin-general.index', compact('pengadaanBarang'));
    }

    public function approveRequesta(Request $request, $id)
    {
        // Menyetujui pengajuan barang
        $pengadaan = PengadaanBarang::findOrFail($id);
        $pengadaan->status = 'disetujui_admin_general';
        $pengadaan->save();

        return redirect()->back()->with('success', 'Pengajuan barang telah disetujui.');
    }

    public function rejectRequesta(Request $request, $id)
    {
        // Menolak pengajuan barang
        $pengadaan = PengadaanBarang::findOrFail($id);
        $pengadaan->status = 'ditolak';
        $pengadaan->save();

        return redirect()->back()->with('warning', 'Pengajuan barang telah ditolak.');
    }
}
