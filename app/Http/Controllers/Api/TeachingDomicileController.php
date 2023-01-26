<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Teaching_domicile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Profile;
use Illuminate\Database\QueryException;

class TeachingDomicileController extends Controller
{
    public function index(){
        return response()->json([
            "data" => Teaching_domicile::all()
        ]);
    }

    public function store(Request $request){
        $validata = Validator::make($request->all()
        ,[
            "provinsi" => "required|max:255",
            "kabupaten" => "required|max:255",
            "domisili.*" => "required|max:255"
        ]);

        if(!$request->domisili){
            $validata = Validator::make($request->all(),[
                "domisili" => "required|max:255"
            ]);
        }

        if($validata->fails()){
            return response()->json($validata->errors(), 400);
        }

        try {
            $user_id = auth()->user()->id;
            $profile = Profile::where("user_id", $user_id)->first();
            $domisili = $request->domisili;

            $data = [];
            for ($i=0; $i < count($domisili); $i++) { 
                $data[] = Teaching_domicile::create([
                            "provinsi" => $request->provinsi,
                            "kabupaten" => $request->kabupaten,
                            "domisili" => $domisili[$i],
                            "profile_id" => $profile->id
                        ]);
            }

            return response()->json([
                "data" => $data,
                "massage" => "Success Input Data!!"
            ]);

        } catch (QueryException $e) {
            return response()->json([
                "massage" => "Failed" . $e
            ], 400);
        }
    }

    public function show($id){
        $teaching_dmc = Teaching_domicile::findOrFail($id);
        
        return response()->json([
            "data" => $teaching_dmc
        ]);
    }

    public function update(Request $request, $id){
        $teaching_dmc = Teaching_domicile::findOrFail($id);

        $validata = Validator::make($request->all(),[
            "provinsi" => "required|max:255",
            "kabupaten" => "required|max:255",
            "domisili" => "required|max:255|unique:teaching_domiciles"
        ]);

        if($validata->fails()){
            return response()->json($validata->errors(), 400);
        }

        try {
            $teaching_dmc =Teaching_domicile::findOrFail($id)->update([
                "provinsi" => $request->provinsi,
                "kabupaten" => $request->kabupaten,
                "domisili" => $request->domisili
            ]);

            return response()->json([
                "data" => $teaching_dmc,
                "massage" => "Success Update Data!!"
            ]);

        } catch (QueryException $e) {
            return response()->json([
                "massage" => "Failed" . $e
            ], 400);
        }
    }

    public function destroy($id){
        $teaching_dmc = Teaching_domicile::findOrFail($id)->delete();
        
        return response()->json([
            "massage" => "Success Delete Data!!"
        ]);
    }
}
