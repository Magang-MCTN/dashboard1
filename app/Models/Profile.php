<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $table = "users";
    protected $fillable =[
    'id',
    'name',
    'email',
    'level',
    'updated_at',
    'tanda_tangan'
    ];

    public function users(){
        return $this->belongsTo(User::class,'id');
    }
}
