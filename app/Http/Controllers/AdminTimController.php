<?php

namespace App\Http\Controllers;

use App\Models\AlasanPengadaan;
use App\Models\PengadaanBarang;
use App\Notifications\RejectNotification;
use Illuminate\Http\Request;
use App\Pengadaan; // Pastikan Anda mengimpor model Pengadaan atau sesuaikan dengan model yang sesuai

class AdminTimController extends Controller
{
    public function index()
    {
        // Tampilkan daftar pengajuan barang yang perlu ditinjau oleh admin tim
        $pengajuanBarang = PengadaanBarang::where('status', 'diajukan')

            // Harga total kurang dari atau sama dengan 2 milyar
            ->get();
        return view('admin-tim.index', compact('pengajuanBarang'));
    }

    public function approveRequest(Request $request, $id)
    {
        // Menyetujui pengajuan barang
        $adminTim = auth()->user();
        $pengajuan = PengadaanBarang::findOrFail($id);
        $pengajuan->status = 'disetujui_admin_tim';
        $pengajuan->alasan = $request->input('alasan');
        $pengajuan->save();
        $pengajuanBarang = PengadaanBarang::find($id); // Sesuaikan dengan cara Anda mengidentifikasi pengajuan
        $pengajuanBarang->admin_tim_id = $adminTim->id;
        $pengajuanBarang->save();


        return redirect()->back()->with('success', 'Pengajuan barang telah disetujui.');
    }

    public function rejectRequest(Request $request, $id)
    {
        // Menolak pengajuan barang
        $admintim = auth()->user();
        $pengajuan = PengadaanBarang::findOrFail($id);
        $pengajuan->status = 'ditolak';
        $pengajuan->alasan = $request->input('alasan');
        $pengajuan->save();
        $pengajuanBarang = PengadaanBarang::find($id); // Sesuaikan dengan cara Anda mengidentifikasi pengajuan
        $pengajuanBarang->admintim = $admintim->id;
        $pengajuanBarang->save();
        $pengajuanBarang->user->notify(new RejectNotification($pengajuanBarang));
        // Menolak pengajuan barang
        // $pengadaan = PengadaanBarang::findOrFail($id);
        // $pengadaan->status = 'ditolak';
        // $pengadaan->save();
        // $pengajuan = PengadaanBarang::findOrFail($id);
        // $pengajuan->status = 'ditolak';
        // $pengajuan->save();

        return redirect()->back()->with('warning', 'Pengajuan barang telah ditolak.');
    }
    public function detail($id)
    {
        $pengajuan = PengadaanBarang::findOrFail($id);

        return view('admin-tim.detail', compact('pengajuan'));
    }
    public function redirectTo()
    {
        if (auth()->check() && auth()->user()->level === 'Admin Tim') {
            return route('persetujuan-barang');
        }

        // Pengaturan pengalihan lainnya sesuai kebutuhan
        return route('dashboard');
    }

    // Metode-metode lain sesuai kebutuhan
}
