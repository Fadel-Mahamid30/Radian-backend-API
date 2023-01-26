<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Biodata extends Model
{
    use HasFactory;

    protected $fillable = [
        "foto_diri",
        "cv",
        "name",
        "tempat",
        "tanggal_lahir",
        "jenis_kelamin",
        "email",
        "nomor_hp",
        "asal_ptn",
        "jurusan",
        "provinsi",
        "kabupaten",
        "kecamatan",
        "alamat",
        "apply",
        "user_id",
        "ipk"
    ];


    // public function provinsi()
    // {
    //     return $this->belongsTo(Province::class);
    // }

    // public function kabupaten()
    // {
    //     return $this->belongsTo(Regency::class);
    // }

    // public function kecamatan()
    // {
    //     return $this->belongsTo(District::class);
    // }

    public function aktivitas()
    {
        return $this->hasMany(Activity::class, "biodata_id");
    }
}
