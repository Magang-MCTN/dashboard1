<?php

namespace App\Http\Controllers;

use App\Models\PengadaanBarang;
use App\Models\Signature;
use App\Models\User;
use Illuminate\Http\Request;
use PDF;



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

    public function generatePengajuanBarangPdf()
    {
        // Ambil data pengajuan barang dari database
        $pengajuanBarang = PengadaanBarang::all();

        // Load view PDF yang telah Anda buat
        $pdf = PDF::loadView('pengadaan.view', compact('pengajuanBarang', 'adminTimSignature', 'adminGeneralSignature'));


        // Atur nama file PDF yang akan dihasilkan
        $pdf->setPaper('A4', 'portrait'); // Atur ukuran dan orientasi kertas

        // Menghasilkan dan menampilkan PDF dalam browser
        return $pdf->stream('pengadaan.view.pdf');
    }
    public function generatePdf($id)
    {
        // Ambil data pengajuan barang berdasarkan ID
        $pengajuanBarang = PengadaanBarang::find($id);

        if (!$pengajuanBarang) {
            // Handle jika ID pengajuan barang tidak ditemukan
            return redirect()->back()->with('error', 'Pengajuan barang tidak ditemukan.');
        }
        $adminTimUserId = $pengajuanBarang->admin_tim_id;
        $adminGeneralUserId = $pengajuanBarang->admin_general_id;
        $adminTimSignature = Signature::where('user_id', $adminTimUserId)->first();

        // Ambil gambar tanda tangan admin general
        $adminGeneralSignature = Signature::where('user_id', $adminGeneralUserId)->first();

        // Ambil nama admin tim
        $adminTimName = User::where('id', $adminTimUserId)->value('name');

        // Ambil nama admin general
        $adminGeneralName = User::where('id', $adminGeneralUserId)->value('name');

        // // Ambil tanda tangan admin tim
        // $adminTimSignature = Signature::find($pengajuanBarang->admin_tim_id);

        // // Ambil tanda tangan admin general
        // $adminGeneralSignature = Signature::find($pengajuanBarang->admin_general_id);
        $path_logo = base_path('public/dashboard/template/images/MCTN.png');
        $types = pathinfo($path_logo, PATHINFO_EXTENSION);
        $datas = file_get_contents($path_logo);
        $pics = 'data:public/dashboard/template/images/' . $types . ';base64,' . base64_encode($datas);
        // Load view PDF yang telah Anda buat
        $path = base_path('storage/app/public/signatures/' . $adminTimSignature->signature);
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $pic = 'data:storage/app/public/signatures/' . $type . ';base64,' . base64_encode($data);
        $patha = base_path('storage/app/public/signatures/' .  $adminGeneralSignature->signature);
        $typea = pathinfo($patha, PATHINFO_EXTENSION);
        $dataa = file_get_contents($patha);
        $pica = 'data:storage/app/public/signatures/' . $typea . ';base64,' . base64_encode($dataa);
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('pengadaan.viewid', compact('pengajuanBarang', 'adminTimSignature', 'adminGeneralSignature', 'pic', 'pica', 'adminTimName', 'adminGeneralName', 'pics'));

        // Atur nama file PDF yang akan dihasilkan
        $pdf->setPaper('A4', 'portrait'); // Atur ukuran dan orientasi kertas

        // Menghasilkan dan menampilkan PDF dalam browser
        return $pdf->stream('pengajuan_barang_' . $pengajuanBarang->id . '.pdf');
    }
}
