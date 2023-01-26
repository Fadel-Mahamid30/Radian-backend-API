<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Education_level;
use App\Models\Province;
use App\Models\Regency;
use App\Models\Subjects;
use Illuminate\Http\Request;
use Mockery\Matcher\Subset;

class SelectController extends Controller
{
    public function getkabupaten($name){
        $provinsi = Province::where("name", $name)->first();
        $kabupaten = Regency::where("province_id", $provinsi->id)->get();

        $data = [];
        foreach ($kabupaten as $row) {
            $data[] = $row->name;
        }

        return response()->json([
            "data" => $data
        ]);
    }

    public function getkecamatan($name){
        $kabupaten = Regency::where("name", $name)->first();
        $kecamatan = District::where("regency_id", $kabupaten->id)->get();

        $data = [];
        foreach ($kecamatan as $row) {
            $data[] = $row->name;
        }

        return response()->json([
            "data" => $data
        ]);
    }

    public function getmapel($name){
        $tingkatan = Education_level::where("tingkatan", $name)->first();

        if(!$tingkatan){
            return response()->json([
                "data" => "Not Found"
            ], 404);
        }

        $mapel = Subjects::where("tingkatan_id", $tingkatan->id)->get();

        $data = [];
        foreach ($mapel as $row) {
            $data[] = $row->mata_pelajaran;
        }

        return response()->json([
            "data" => $data
        ]);
    }
}
