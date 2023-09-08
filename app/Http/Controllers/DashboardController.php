<?php

namespace App\Http\Controllers;

use App\Models\Signature;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {


        return view('dashboard.home');
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
