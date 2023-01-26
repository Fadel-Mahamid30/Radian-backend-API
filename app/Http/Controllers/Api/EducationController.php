<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Education;
use Illuminate\Database\QueryException;
use App\Models\Profile;

class EducationController extends Controller
{
    public function index(){
        return response()->json([
            "data" => Education::all()
        ]);
    }

    public function store(Request $request){
        $validate = Validator::make($request->all(),[
            "universitas" => "required|max:255",
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
            $education = Education::create([
                "universitas" => $request->universitas, 
                "mulai" => $request->mulai,
                "sampai" => $request->sampai,
                "deskripsi" => $request->deskripsi,
                "profile_id" => $profile->id 
            ]);

            return response()->json([
                "data" => $education,
                "massage" => "Success Input Data!!"
            ]);

        } catch (QueryException $e) {
            return response()->json([
                "massage" => "Failed" . $e
            ], 400);
        }
    }

    public function show($id){
        $education = Education::findOrFail($id);

        return response()->json([
            "data" => $education,
        ]);
    }

    public function update(Request $request, $id){
        $education = Education::findOrFail($id);
        $validate = Validator::make($request->all(),[
            "universitas" => "required|max:255",
            "mulai" => "required|date_format:Y-m-d|before:today",
            "sampai" => "required|date_format:Y-m-d|before:today|after:mulai",
            "deskripsi" => "required"
        ]);

        if($validate->fails()){
            return response()->json($validate->errors(), 400);
        }

        try {
            $education = Education::findOrFail($id)->update([
                "universitas" => $request->universitas, 
                "mulai" => $request->mulai,
                "sampai" => $request->sampai,
                "deskripsi" => $request->deskripsi
            ]);

            return response()->json([
                "data" => $education,
                "massage" => "Success Update Data!!"
            ]);

        } catch (QueryException $e) {
            return response()->json([
                "massage" => "Failed" . $e
            ], 400);
        }
    }

    public function destroy($id){
        $education = Education::findOrFail($id)->delete();

        return response()->json([
            "massage" => "Success Delete Data!!"
        ]);
    }
}
