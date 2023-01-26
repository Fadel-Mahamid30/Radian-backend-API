<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Biodata;
use App\Models\Education;
use App\Models\Profile;
use App\Models\Teaching_domicile;
use App\Models\Teaching_interest;
use Illuminate\Http\Request;
use App\Models\User;

class FindTeacherController extends Controller
{
    public function guruRecomended(){

        $user = User::latest()->guruVerify()->paginate(8);

        $data = [];
        foreach ($user as $row) {
            $profile = Profile::latest()->where("user_id", $row->id)->first();
            $pendidikan = Education::latest()->where("profile_id", $profile->id)->first();
            $domisili_mengajar = Teaching_domicile::latest()->where("profile_id", $profile->id)->first();
            
            $data[] = [
                "nama" => $row->name,
                "kabupaten" => $domisili_mengajar->kabupaten,
                "universitas" => $pendidikan->universitas,
                "harga" => $profile->harga
            ];
        }

        return response()->json([
            "data" => $data
        ], 200);

    }

    public function cariGuru(Request $request){

        $user = User::latest()->findTeacher([
            "mata_pelajaran" => $request->mata_pelajaran,
            "domisili" => $request->domisili
        ])->paginate(8);

        $data = [];
        foreach ($user as $row) {
            $profile = Profile::latest()->where("user_id", $row->id)->first();
            $pendidikan = Education::latest()->where("profile_id", $profile->id)->first();
            $domisili_mengajar = Teaching_domicile::latest()->where("profile_id", $profile->id)->first();
            
            $data[] = [
                "nama" => $row->name,
                "kabupaten" => $domisili_mengajar->kabupaten,
                "universitas" => $pendidikan->universitas,
                "harga" => $profile->harga
            ];
        }

        return response()->json([
            "data" => $data
        ]);

    }

    public function detailGuru($id){


        $user = User::findOrFail($id);
        $profile = Profile::latest()->where("user_id", $user->id)->first();
        $biodata = Biodata::latest()->where("user_id", $user->id)->first();

        $minat_mengajar = Teaching_interest::latest()->where("Profile_id", $profile->id)->get();
        $domisili_mengajar = Teaching_domicile::latest()->where("profile_id", $profile->id)->get();
        $pendidikan = Education::latest()->where("profile_id", $profile->id)->first();

        $mapel_tingkatan = [];
        foreach($minat_mengajar as $row){
            $mapel_tingkatan[] =  $row->tingkatan . " - 
            " . $row->mata_pelajaran;
        }

        $domisili = []; 
        foreach($domisili_mengajar as $row){
            $domisili[] = $row->kabupaten . " - " . $row->domisili;
        }

        $data = [
            "nama" => $user->name,
            "universitas" => $pendidikan->universitas,
            "domisili" => $biodata->kabupaten,
            "deskripsi_diri" => $profile->deskripsi_diri,
            "minat_mengajar" => $mapel_tingkatan,
            "domisili_mengajar" => $domisili,
            "harga" => $profile->harga
        ];

        return response()->json([
            "data" => $data
        ], 200);

    }

}
