<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use App\Models\Profile;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ExperienceController extends Controller
{
    public function index(){
        return response()->json([
            "data" => Experience::all()
        ]);
    }

    public function store(Request $request){
        $validate = Validator::make($request->all(),[
            "perusahaan" => "required|max:255",
            "mulai" => "required|date_format:Y-m-d|before:today",
            "sampai" => "required|date_format:Y-m-d|before:today|after:mulai",
            "deskripsi" => "required"
        ]);

        if($validate->fails()){
            return response()->json($validate->errors(), 400);
        }

        try {

            $user_id = auth()->user()->id;
            $profile = Profile::where("user_id", $user_id)->first();
            $data = Experience::create([
                "perusahaan" => $request->perusahaan,
                "mulai" => $request->mulai,
                "sampai" => $request->sampai,
                "deskripsi" => $request->deskripsi,
                "profile_id" => $profile->id
            ]);
            
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
        $exp = Experience::findOrFail($id);

        return response()->json([
            "data" => $exp
        ]);
    }

    public function update(Request $request, $id){
        $exp = Experience::findOrFail($id);

        $validate = Validator::make($request->all(),[
            "perusahaan" => "required|max:255",
            "mulai" => "required|date_format:Y-m-d|before:today",
            "sampai" => "required|date_format:Y-m-d|before:today|after:mulai",
            "deskripsi" => "required"
        ]);

        if($validate->fails()){
            return response()->json($validate->errors(), 400);
        }

        try {

            $data = Experience::findOrFail($id)->update([
                "peusahaan" => $request->perusahaan,
                "mulai" => $request->mulai,
                "sampai" => $request->sampai,
                "deskripsi" => $request->deskripsi,
            ]);
            
            return response()->json([
                "data" => $data,
                "massage" => "Success Update Data!!"
            ]);

        } catch (QueryException $e) {
            return response()->json([
                "massage" => "Failed" . $e
            ], 400);
        }
    }

    public function destroy($id){
        $experience = Experience::findOrFail($id)->delete();
        return response()->json([
            "massage" => "Success Delete Data"
        ]);
    }


}
