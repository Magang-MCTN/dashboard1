<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormDisetujui extends Model
{
    protected $fillable = [
        'pengadaan_barang_id'
    ];

    public function pengadaanBarang()
    {
        return $this->belongsTo(PengadaanBarang::class, 'pengadaan_barang_id');
    }
}
