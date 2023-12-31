<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Signature;
use Illuminate\Foundation\Auth\User;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{
    public function profile($id)
    {
        $user = auth()->user(); // Mengambil pengguna yang sedang masuk
        // $signature = $user->signature; // Mengambil tanda tangan dari relasi
        $signature = Signature::where('user_id', $id)->first();
        // Mengambil pengguna yang sedang masuk


        $profile = Profile::where('id', $id)->first();
        $users = $profile;
        return view('profile.tampil', compact('users', 'signature'));
    }
    // public function update(request $request, $id){
    //     $request->validate([
    //         'name'=> 'required',
    //         'npm'=> 'required',
    //         'prodi'=> 'required',
    //         'alamat'=> 'required',
    //         'noTelp'=> 'required',
    //         'photoProfile'=> 'nullable|mimes:jpg,jpeg,png|max:2048'
    //     ],
    //     [
    //         'name.required'=>"Nama tidak boleh kosong",
    //         'npm.required'=>"Nomor Induk tidak boleh kosong",
    //         'prodi.required'=>"Prodi tidak boleh kosong",
    //         'alamat.required'=>"Alamat tidak boleh kosong",
    //         'noTelp.required'=>"Nomor Telepon tidak boleh kosong",
    //         'photoProfile.mimes' =>"Foto Profile Harus Berupa jpg,jpeg,atau png",
    //         'photoProfile.max' => "ukuran gambar tidak boleh lebih dari 2048 MB"
    //     ]);
    //     $iduser = Auth::id();
    //     $profile = Profile::where('id',$iduser)->first();
    //     $user = User::where('id',$iduser)->first();

    //     if($request->has('photoProfile')){
    //      $path='images/photoProifle';

    //      File::delete($path.$profile->photoProfile);

    //      $namaGambar = time().'.'.$request->photoProfile->extension();

    //      $request->photoProfile->move(public_path('images/photoProfile'),$namaGambar);

    //      $profile->photoProfile =$namaGambar;

    //      $profile->save();
    //     }
    //     $user->name = $request->name;
    //     $profile->npm = $request->npm;
    //     $profile->prodi = $request->prodi;
    //     $profile->alamat = $request->alamat;
    //     $profile->noTelp = $request->noTelp;

    //     $profile->save();
    //     $user->save();

    //     Alert::success('Success', 'Berhasil Mengubah Profile');
    //     return redirect('/profile');
    // }
}
