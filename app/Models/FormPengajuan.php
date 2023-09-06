<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormPengajuan extends Model
{
    protected $fillable = [
        'pengadaan_barang_id', 'status_persetujuan', 'catatan', 'user_id'
    ];

    public function pengadaanBarang()
    {
        return $this->belongsTo(PengadaanBarang::class, 'pengadaan_barang_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
