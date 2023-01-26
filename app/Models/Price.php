<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    use HasFactory;

    protected $fillable = [
        "provinsi",
        "kabupaten",
        "min_harga",
        "max_harga"
    ];

    public function provinsi(){
        return $this->belongsTo(Province::class);
    }

    public function kabupaten(){
        return $this->belongsTo(Regency::class);
    }
}
