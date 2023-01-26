<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Teaching_interest;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Profile;

class TeachingInterestController extends Controller
{
    public function index(){
        return response()->json([
            "data" => Teaching_interest::all()
        ]);
    }

    public function store(Request $request){
        $validata = Validator::make($request->all(),[
            "tingkatan" => "required|max:255", 
            "mata_pelajaran" => "required|max:255" 
        ]);

        if($validata->fails()){
            return response()->json($validata->errors(), 400);
        }

        try {
            $user_id = auth()->user()->id;
            $profile = Profile::where("user_id", $user_id)->first();
            $tecahing_int = Teaching_interest::create([
                "tingkatan" => $request->tingkatan,
                "mata_pelajaran" => $request->mata_pelajaran,
                "profile_id" => $profile->id
            ]);

            return response()->json([
                "data" => $tecahing_int,
                "massage" => "Success Input Data!!"
            ]);

        } catch (QueryException $e) {
            return response()->json([
                "massage" => "Failed" . $e
            ], 400);
        }
    }

    public function show($id){
        $tecahing_int = Teaching_interest::findOrFail($id);

        return response()->json([
            "data" => $tecahing_int
        ]);
    }

    public function update(Request $request, $id){
        $tecahing_int = Teaching_interest::findOrFail($id);

        $validata = Validator::make($request->all(),[
            "tingkatan" => "required|max:255", 
            "mata_pelajaran" => "required|max:255" 
        ]);

        if($validata->fails()){
            return response()->json($validata->errors(), 400);
        }

        try {

            $tecahing_int = Teaching_interest::findOrFail($id)->update([
                "tingkatan" => $request->tingkatan,
                "mata_pelajaran" => $request->mata_pelajaran
            ]);

            return response()->json([
                "data" => $tecahing_int,
                "massage" => "Success Update Data!!"
            ]);

        } catch (QueryException $e) {
            return response()->json([
                "massage" => "Failed" . $e
            ], 400);
        }
    }

    public function destroy($id){
        $tecahing_int = Teaching_interest::findOrFail($id)->delete();

        return response()->json([
            "massage" => "Success Delete Data!!"
        ]);
    }
}
