<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education_level extends Model
{
    use HasFactory;

    protected $fillable = [
        "tingkatan"
    ];

    public function mapel(){
        return $this->hasMany(Subjects::class, "tingkatan_id");
    }
}
