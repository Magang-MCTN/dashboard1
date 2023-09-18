<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlasanPengadaan extends Model
{
    use HasFactory;
    public $table = "alasan_pengadaan";
    protected $fillable = [
        'pengadaan_barang_id', // Tambahkan 'pengadaan_barang_id' ke dalam daftar fillable
        'alasan',
        'admin_id'
    ];
}
