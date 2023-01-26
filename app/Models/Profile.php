<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        "deskripsi_diri",
        "user_id",
        "harga",
    ];

    public function user(){
        return $this->belongsTo(user::class);
    }

    public function pengalaman(){
        return $this->hasMany(Experience::class, "profile_id");
    }

    public function pendidikan(){
        return $this->hasMany(Education::class, "profile_id");
    }

    public function domisili_mengajar(){
        return $this->hasMany(Teaching_domicile::class, "profile_id");
    }

    public function minat_mengajar(){
        return $this->hasMany(Teaching_interest::class, "profile_id");
    }

}
