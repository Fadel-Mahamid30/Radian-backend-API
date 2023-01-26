<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;

    protected $fillable = [
        "perusahaan",
        "mulai",
        "sampai",
        "deskripsi",
        "profile_id"
    ];

    public function profile(){
        return $this->belongsTo(Profile::class);
    }
}
