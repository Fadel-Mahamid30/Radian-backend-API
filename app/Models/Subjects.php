<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subjects extends Model
{
    use HasFactory;

    protected $fillable = [
        "mata_pelajaran",
        "tingkatan_id"
    ];

    public function tingkatan(){
        return $this->belongsTo(Education_level::class);
    }
    
}
