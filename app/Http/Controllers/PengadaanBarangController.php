<?php

namespace App\Http\Controllers;

use App\Models\PengadaanBarang;
use App\Models\Signature;
use App\Models\User;
use App\Notifications\Daftar;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Notification as FacadesNotification;
use PDF;



class PengadaanBarangController extends Controller
{
    public function index()
    {
        $totalBarang = PengadaanBarang::count();
        $barangDisetujui = PengadaanBarang::where('status', 'disetujui')->count();
        $barangDitolak = PengadaanBarang::where('status', 'ditolak')->count();

        $adminTimList = User::where('level', 'Admin Tim')->pluck('jabatan', 'id', 'jabatan');
        // Menampilkan formulir pengajuan barang
        return view('dashboard.pengajuan', compact('adminTimList', 'totalBarang', 'barangDisetujui', 'barangDitolak'));
    }

    public function store(Request $request)
    {
        $pengajuan = new PengadaanBarang;
        $pengajuan->nama_barang = $request->input('nama_barang'); // Set nama_barang dari input pengguna
        $pengajuan->nomor_pengadaan = $request->input('nomor_pengadaan');
        $pengajuan->jumlah = $request->input('jumlah');
        $pengajuan->harga = $request->input('harga');
        $pengajuan->dokumen = $request->input('dokumen');
        $pengajuan->tanggal_pengajuan = now();
        $pengajuan->status = 'diajukan';
        $pengajuan->admintim = $request->input('admintim');
        $pengajuan->user_id = auth()->user()->id;

        $hargaSatuan = $pengajuan->harga;
        $jumlahBarang = $pengajuan->jumlah;
        $hargaTotal = $hargaSatuan * $jumlahBarang;

        $pengajuan->total = $hargaTotal;
        $pengajuan->save();

        $adminTim = User::find($request->admintim); // Gantilah dengan cara Anda mendapatkan admin tim berdasarkan ID
        $adminTim->notify(new Daftar($pengajuan));
        // $adminTim = User::where('level', 'Admin Tim')->get(); // Sesuaikan dengan cara Anda mendapatkan admin tim
        // FacadesNotification::send($adminTim, new Daftar());
        return redirect('/status-pengadaan')->with('success', 'Pengajuan barang berhasil disampaikan.');
    }

    public function status(Request $request)
    {
        $selectedStatus = $request->input('status', 'semua');
        $searchKeyword = $request->input('search');

        $query = PengadaanBarang::query();

        if ($selectedStatus !== 'semua') {
            $query->where('status', $selectedStatus);
        }

        if ($searchKeyword) {
            $query->where('nama_barang', 'like', '%' . $searchKeyword . '%');
        }

        // Hanya menampilkan pengadaan barang yang diajukan oleh pengguna yang sedang login.
        $query->where('user_id', auth()->user()->id);

        $pengadaanBarang = $query->get();
        $pengadaanBarangUser = PengadaanBarang::where('user_id', auth()->user()->id)->get();

        return view('dashboard.status_pengajuan', compact('pengadaanBarang', 'selectedStatus', 'pengadaanBarangUser', 'searchKeyword'));
    }

    public function detail($id)
    {
        $pengajuan = PengadaanBarang::findOrFail($id);

        return view('dashboard.detail', compact('pengajuan'));
    }
    public function edit($id)
    {
        $adminTimList = User::where('level', 'Admin Tim')->pluck('jabatan', 'id', 'jabatan');
        $pengajuan = PengadaanBarang::find($id);

        return view('dashboard.edit', compact('pengajuan', 'adminTimList'));
    }

    public function ajukanUlang(Request $request, $id)
    {
        $pengajuan = PengadaanBarang::find($id);
        $pengajuan->nama_barang = $request->input('nama_barang'); // Set nama_barang dari input pengguna
        $pengajuan->nomor_pengadaan = $request->input('nomor_pengadaan');
        $pengajuan->jumlah = $request->input('jumlah');
        $pengajuan->harga = $request->input('harga');
        $pengajuan->dokumen = $request->input('dokumen');
        $pengajuan->tanggal_pengajuan = now();
        $pengajuan->status = 'diajukan';
        $pengajuan->admintim = $request->input('admintim');
        $pengajuan->user_id = auth()->user()->id;

        $hargaSatuan = $pengajuan->harga;
        $jumlahBarang = $pengajuan->jumlah;
        $hargaTotal = $hargaSatuan * $jumlahBarang;

        $pengajuan->total = $hargaTotal;
        $pengajuan->save();
        $adminTim = User::find($request->admintim); // Gantilah dengan cara Anda mendapatkan admin tim berdasarkan ID
        $adminTim->notify(new Daftar($pengajuan));

        return redirect()->route('detail', $id)->with('success', 'Pengajuan berhasil diajukan ulang.');
    }

    public function generatePdf($id)
    {
        // try {
        // Ambil data pengajuan barang berdasarkan ID
        $pengajuanBarang = PengadaanBarang::find($id);

        if (!$pengajuanBarang) {
            // Handle jika ID pengajuan barang tidak ditemukan
            return redirect()->back()->with('error', 'Pengajuan barang tidak ditemukan.');
        }
        $adminTimUserId = $pengajuanBarang->admin_tim_id;
        $adminGeneralUserId = $pengajuanBarang->admin_general_id;
        $adminManagerUserId = $pengajuanBarang->admin_manager_id;

        $adminTimSignature = Signature::where('user_id', $adminTimUserId)->first();

        // Ambil gambar tanda tangan admin general
        $adminGeneralSignature = Signature::where('user_id', $adminGeneralUserId)->first();


        // Ambil gambar tanda tangan admin manager
        $adminManagerSignature = Signature::where('user_id', $adminManagerUserId)->first();

        // Ambil nama admin tim
        $adminTimName = User::where('id', $adminTimUserId)->value('name');

        // Ambil nama admin general
        $adminGeneralName = User::where('id', $adminGeneralUserId)->value('name');

        // Ambil nama admin manager
        $adminManagerName = User::where('id', $adminManagerUserId)->value('name');

        // Ambil nama admin tim
        $adminTimjabatan = User::where('id', $adminTimUserId)->value('jabatan');

        // Ambil nama admin general
        $adminGeneraljabatan = User::where('id', $adminGeneralUserId)->value('jabatan');

        // Ambil nama admin manager
        $adminManagerjabatan = User::where('id', $adminManagerUserId)->value('jabatan');
        // // Ambil tanda tangan admin tim
        // $adminTimSignature = Signature::find($pengajuanBarang->admin_tim_id);

        // // Ambil tanda tangan admin general
        // $adminGeneralSignature = Signature::find($pengajuanBarang->admin_general_id);

        if ($pengajuanBarang->total <= 2000000000) {
            $path_logo = base_path('public/dashboard/template/images/MCTN.png');
            $types = pathinfo($path_logo, PATHINFO_EXTENSION);
            $datas = file_get_contents($path_logo);
            $pics = 'data:public/dashboard/template/images/' . $types . ';base64,' . base64_encode($datas);
            // Load view PDF yang telah Anda buat
            $path = base_path('storage/app/public/signatures/' . $adminTimSignature->signature);
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $data = file_get_contents($path);
            $pic = 'data:storage/app/public/signatures/' . $type . ';base64,' . base64_encode($data);
            $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('pengadaan.viewtim', compact('pengajuanBarang', 'adminTimSignature',  'pic',  'adminTimName', 'pics', 'adminTimjabatan'));
            // Menyimpan atau mengirim PDF sesuai kebutuhan Anda
            return $pdf->download('pengajuan_barang.pdf');
        } elseif ($pengajuanBarang->total <= 20000000000) {
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
            $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('pengadaan.viewid', compact('pengajuanBarang', 'adminTimSignature', 'adminGeneralSignature', 'pic', 'pica', 'adminTimName', 'adminGeneralName', 'pics', 'adminTimjabatan', 'adminGeneraljabatan'));
            // Menyimpan atau mengirim PDF sesuai kebutuhan Anda
            return $pdf->download('pengajuan_barang.pdf');
        } else {
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
            //admin manager
            $pathar = base_path('storage/app/public/signatures/' .  $adminManagerSignature->signature);
            $typear = pathinfo($patha, PATHINFO_EXTENSION);
            $dataar = file_get_contents($patha);
            $picar = 'data:storage/app/public/signatures/' . $typea . ';base64,' . base64_encode($dataa);
            $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('pengadaan.viewmanager', compact('pengajuanBarang', 'adminTimSignature', 'adminManagerSignature', 'adminGeneralSignature', 'pic', 'pica', 'adminTimName', 'adminGeneralName', 'pics', 'picar', 'adminManagerName', 'adminTimjabatan', 'adminGeneraljabatan', 'adminManagerjabatan'));
            // Menyimpan atau mengirim PDF sesuai kebutuhan Anda
            return $pdf->download('pengajuan_barang.pdf');
        }
        // } catch (\Exception $e) {
        return redirect()->route('detail', ['id' => $id])->with('error', 'Tidak bisa mencetak PDF karena pengajuan belum selesai diproses !!');
    }
    public function delete($id)
    {
        $pengajuanBarang = PengadaanBarang::find($id);

        if (!$pengajuanBarang) {
            return redirect()->route('status')->with('error', 'Pengajuan barang tidak ditemukan.');
        }

        // Pastikan pengguna yang menghapus adalah pemilik pengajuan atau admin yang berwenang.
        if (auth()->user()->id === $pengajuanBarang->user_id || auth()->user()->level === 'Admin Tim' || auth()->user()->level === 'Admin Manager') {
            $pengajuanBarang->delete();
            return redirect()->route('status')->with('success', 'Pengajuan barang berhasil dihapus.');
        } else {
            return redirect()->route('status')->with('error', 'Anda tidak memiliki izin untuk menghapus pengajuan barang ini.');
        }
    }
}
