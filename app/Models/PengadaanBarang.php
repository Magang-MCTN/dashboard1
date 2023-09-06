<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengadaanBarang extends Model
{
    protected $fillable = [
        'nama_barang', 'nomor_pengadaan', 'jumlah', 'harga', 'tanggal_pengajuan', 'status', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function formPengajuan()
    {
        return $this->hasOne(FormPengajuan::class);
    }

    public function formDisetujui()
    {
        return $this->hasOne(FormDisetujui::class);
    }
}
