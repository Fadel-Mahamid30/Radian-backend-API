<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teaching_domicile extends Model
{
    use HasFactory;

    protected $fillable = [
        "provinsi",
        "kabupaten",
        "domisili",
        "profile_id"
    ];

    public function profile(){
        return $this->belongsTo(Profile::class);
    }
}
