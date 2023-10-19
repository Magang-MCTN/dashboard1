<?php

namespace App\Http\Controllers;

use App\Models\PengadaanBarang;
use App\Models\Signature;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBarang = PengadaanBarang::count();
        $barangDisetujui2 = PengadaanBarang::where('status', 'disetujui_admin_manager')->count();
        $barangDisetujui1 = PengadaanBarang::where('status', 'disetujui_admin_general')->count();
        $barangDisetujui = PengadaanBarang::where('status', 'disetujui_admin_tim')->count();
        $barangDitolak = PengadaanBarang::where('status', 'ditolak')->count();
        $barangDiajukan = PengadaanBarang::where('status', 'diajukan')->count();
        $query = PengadaanBarang::query();
        $pengadaanBarang = $query->get();
        $pengadaanBarangUser = PengadaanBarang::where('user_id', auth()->user()->id)->paginate(10);

        return view('dashboard.home', compact('pengadaanBarangUser', 'totalBarang', 'barangDisetujui', 'barangDitolak', 'barangDiajukan', 'barangDisetujui1', 'barangDisetujui2'));
    }
    public function getChartData()
    {
        $totalBarang = PengadaanBarang::count();
        $barangDiajukan = PengadaanBarang::where('status', 'diajukan')->count();
        $barangDisetujui = PengadaanBarang::where('status', 'disetujui_admin_manager')->count();
        $barangDitolak = PengadaanBarang::where('status', 'ditolak')->count();

        $data = [
            'total' => $totalBarang,
            'diajukan' => $barangDiajukan,
            'disetujui' => $barangDisetujui,
            'ditolak' => $barangDitolak,
        ];

        return response()->json($data);
    }

    public function signature()
    {
        return view('dashboard.upload');
    }

    public function store(Request $request)
    {
        // Validasi request


        $request->validate([
            'signature' => 'required|image|mimes:png|max:2048', // Gambar tanda tangan harus berformat PNG dan tidak melebihi 2MB.
        ]);
        $user = auth()->user(); // Mendapatkan user yang sedang login
        $signaturePath = $request->file('signature')->store('signatures', 'public'); // Simpan gambar tanda tangan di direktori 'storage/app/public/signatures'

        // Simpan tanda tangan ke dalam basis data
        $signature = Signature::updateOrCreate(
            ['user_id' => $user->id],
            ['signature' => $signaturePath]
        );
        // Buat atau perbarui tanda tangan user



        return redirect()->route('dashboard')->with('success', 'Tanda tangan berhasil diunggah.');
    }
}
