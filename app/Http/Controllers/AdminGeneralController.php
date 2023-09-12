<?php

namespace App\Http\Controllers;

use App\Models\PengadaanBarang;
use App\Notifications\ApprovalNotification;
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
        $admingeneral = auth()->user();
        $pengadaan = PengadaanBarang::findOrFail($id);
        $pengadaan->status = 'disetujui_admin_general';
        $pengadaan->save();
        $pengajuanBarang = PengadaanBarang::find($id); // Sesuaikan dengan cara Anda mengidentifikasi pengajuan
        $pengajuanBarang->admin_general_id = $admingeneral->id;
        $pengajuanBarang->save();
        $pengajuanBarang->user->notify(new ApprovalNotification($pengajuanBarang));

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
    public function detail($id)
    {
        $pengajuan = PengadaanBarang::findOrFail($id);

        return view('admin-general.detail', compact('pengajuan'));
    }
}
