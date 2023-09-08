<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Signature extends Model
{
    public $table = "signatures";
    use HasFactory;
    protected $fillable = [
        'user_id', 'signature',
    ];

    // Definisikan hubungan antara Signature dan User jika diperlukan.
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
