<?php

namespace App\Http\Controllers;

use App\Models\PengadaanBarang;
use App\Notifications\ApprovalNotification;
use App\Notifications\RejectNotification;
use Illuminate\Http\Request;

class AdminManagerController extends Controller
{
    public function index()
    {
        // Menampilkan daftar pengadaan barang yang perlu ditinjau oleh admin general
        $pengadaanBarang = PengadaanBarang::where('status', 'disetujui_admin_general')
            ->where('total', '>', 20000000000) // Harga total di atas 20 milyar
            ->get();
        return view('admin-manager.index', compact('pengadaanBarang'));
    }

    public function approveRequesta(Request $request, $id)
    {
        // Menyetujui pengajuan barang
        $adminmanager = auth()->user();
        $pengadaan = PengadaanBarang::findOrFail($id);
        $pengadaan->status = 'disetujui_admin_manager';
        $pengadaan->save();
        $pengajuanBarang = PengadaanBarang::find($id); // Sesuaikan dengan cara Anda mengidentifikasi pengajuan
        $pengajuanBarang->admin_manager_id = $adminmanager->id;
        $pengajuanBarang->save();
        $pengajuanBarang->user->notify(new ApprovalNotification($pengajuanBarang));

        return redirect()->back()->with('success', 'Pengajuan barang telah disetujui.');
    }

    public function rejectRequesta(Request $request, $id)
    {
        $admingeneral = auth()->user();
        $pengadaan = PengadaanBarang::findOrFail($id);
        $pengadaan->status = 'ditolak';
        $pengadaan->save();
        $pengajuanBarang = PengadaanBarang::find($id); // Sesuaikan dengan cara Anda mengidentifikasi pengajuan
        $pengajuanBarang->admin_general_id = $admingeneral->id;
        $pengajuanBarang->save();
        $pengajuanBarang->user->notify(new RejectNotification($pengajuanBarang));
        // Menolak pengajuan barang
        $pengadaan = PengadaanBarang::findOrFail($id);
        $pengadaan->status = 'ditolak';
        $pengadaan->save();

        return redirect()->back()->with('warning', 'Pengajuan barang telah ditolak.');
    }
    public function detail($id)
    {
        $pengajuan = PengadaanBarang::findOrFail($id);

        return view('admin-manager.detail', compact('pengajuan'));
    }
}
