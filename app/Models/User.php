<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'nomor_hp',
        'hak_akses',
        'nilai',
        'status',
        'verification'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    // untuk akun yang sudah verfikasi (micro teaching) pada dasboard
    public function scopeVerify($query, array $filters){

        if($filters["category"] == "nama" && $filters["search"] ){

            $query->when($filters["search"] ?? false,  function($query, $search){
                return $query->where("verification", "verify")->where("name", "like", "%" . $search . "%");
            });
                
        }elseif($filters["category"]  == "domisili" && $filters["search"]){

            $query->when($filters["search"] ?? false,  function($query, $search){
                return $query->where("verification", "verify")
                    ->whereHas("biodata", function($query) use ($search){
                    $query->where("kabupaten", "like", "%" . $search . "%");
                });
            });

        }elseif($filters["category"]  == "minat_mengajar" && $filters["search"]){

            $query->when($filters["search"] ?? false,  function($query, $search){
                return $query->where("verification", "verify")
                ->whereHas("profile", function($query) use ($search){
                    $query->whereHas("minat_mengajar", function($query) use ($search){
                        $query->where("mata_pelajaran", "like", "%" . $search . "%");
                    });
                });

            });

        }else{

            $query->when(true, function($query){
                return $query->where("verification", "verify");
            });

        }

    }

    // untuk akun yang sudah belum verfikasi (micro teaching) pada dasboard
    public function scopeNon_Verify($query, array $filters){

        if($filters["category"] == "nama" && $filters["search"] ){

            $query->when($filters["search"] ?? false,  function($query, $search){
                return $query->where("name", "like", "%" . $search . "%")->where("verification", "non_verify");
            });
                
        }elseif($filters["category"]  == "domisili" && $filters["search"]){

            $query->when($filters["search"] ?? false,  function($query, $search){
                return $query->where("verification", "non_verify")
                    ->whereHas("biodata", function($query) use ($search){
                    $query->where("kabupaten", "like", "%" . $search . "%");
                });
            });

        }elseif($filters["category"]  == "minat_mengajar" && $filters["search"]){

            $query->when($filters["search"] ?? false,  function($query, $search){
                return $query->where("verification", "non_verify")
                ->whereHas("profile", function($query) use ($search){
                    $query->whereHas("minat_mengajar", function($query) use ($search){
                        $query->where("mata_pelajaran", "like", "%" . $search . "%");
                    });
                });

            });

        }else{

            $query->when(true, function($query){
                return $query->where("verification", "non_verify");
            });

        }

    }

    // untuk akun yang active pada dasboard
    public function scopeActive($query, array $filters){

        if($filters["category"] == "nama" && $filters["search"] ){

            $query->when($filters["search"] ?? false,  function($query, $search){
                return $query->where("name", "like", "%" . $search . "%")->where("status", "active");
            });
                
        }elseif($filters["category"]  == "domisili" && $filters["search"]){

            $query->when($filters["search"] ?? false,  function($query, $search){
                return $query->where("status", "active")
                    ->whereHas("biodata", function($query) use ($search){
                    $query->where("kabupaten", "like", "%" . $search . "%");
                });
            });

        }elseif($filters["category"]  == "minat_mengajar" && $filters["search"]){

            $query->when($filters["search"] ?? false,  function($query, $search){
                return $query->where("status", "active")
                ->whereHas("profile", function($query) use ($search){
                    $query->whereHas("minat_mengajar", function($query) use ($search){
                        $query->where("mata_pelajaran", "like", "%" . $search . "%");
                    });
                });

            });

        }else{

            $query->when(true, function($query){
                return $query->where("status", "active");
            });

        }

    }


    // untuk akun yang tidak active pada dasboard
    public function scopeNon_active($query, array $filters){

        if($filters["category"] == "nama" && $filters["search"] ){
            $query->when($filters["search"] ?? false,  function($query, $search){
                return $query->where("name", "like", "%" . $search . "%")->where("status", "non_active");
            });
                
        }elseif($filters["category"]  == "domisili" && $filters["search"]){

            $query->when($filters["search"] ?? false,  function($query, $search){
                return $query->where("status", "non_active")
                    ->whereHas("biodata", function($query) use ($search){
                    $query->where("kabupaten", "like", "%" . $search . "%");
                });
            });

        }elseif($filters["category"]  == "minat_mengajar" && $filters["search"]){

            $query->when($filters["search"] ?? false,  function($query, $search){
                return $query->where("status", "non_active")
                ->whereHas("profile", function($query) use ($search){
                    $query->whereHas("minat_mengajar", function($query) use ($search){
                        $query->where("mata_pelajaran", "like", "%" . $search . "%");
                    });
                });

            });

        }else{

            $query->when(true, function($query){
                return $query->where("status", "non_active");
            });

        }

    }

    // untuk guru yang rekomendasi
    public function scopeGuruVerify($query){

        $query->when(true, function($query){
            return $query->where("status", "active")->where("verification", "verify");
        });

    }

    // untuk fitur cari guru
    public function scopeFindTeacher($query, array $filters){

        $query->when(true, function($query){
            return $query->where("status", "active");
        });

        // mencari guru berdasarkan minat mengajarnya
        $query->when($filters["mata_pelajaran"] ?? false,  function($query, $mapel){
            return $query->whereHas("profile", function($query) use ($mapel){
                $query->whereHas("minat_mengajar", function($query) use ($mapel){
                    $query->where("mata_pelajaran", "like", "%" . $mapel . "%");
                });
            });

        });

        // mencari guru berdasarkan domisili mengajarnya
        $query->when($filters["domisili"] ?? false, function($query, $domisili){
            return $query->whereHas("profile", function($query) use ($domisili){
                $query->whereHas("domisili_mengajar", function($query) use ($domisili){
                    $query->where("kabupaten", "like", "%" . $domisili . "%");
                });
            });
        }); 
    }

    public function biodata(){
        return $this->hasOne(Biodata::class, "user_id");
    }

    public function profile(){
        return $this->hasOne(Profile::class, "user_id");
    }

}
