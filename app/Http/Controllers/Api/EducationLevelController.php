<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Education;
use App\Models\Education_level;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EducationLevelController extends Controller
{
    public function index(){
        return response()->json([
            "data" => Education_level::all()
        ]);
    }

    public function store(Request $request){
        $validate = Validator::make($request->all(),[
            "tingkatan" => "required|max:255|unique:education_levels"
        ]);

        if($validate->fails()){
            return response()->json($validate->errors(), 400);
        }

        try {
            $edu_level = Education_level::create(["tingkatan" => $request->tingkatan]);

            return response()->json([
                "data" => $edu_level,
                "massage" => "Success Input Data!!"
            ]);
        } catch (QueryException $e) {
            return response()->json([
                "massage" => "Failed" . $e
            ], 400);
        }

    }

    public function show($id){
        $edu_level = Education_level::findOrFail($id);
        
        return response()->json([
            "data" => $edu_level
        ]);
    }

    public function update(Request $request, $id){
        $edu_level = Education_level::findOrFail($id);

        $validate = Validator::make($request->all(),[
            "tingkatan" => "required|max:255|unique:education_levels"
        ]);

        if($validate->fails()){
            return response()->json($validate->errors(), 400);
        }

        try {
            $edu_level = Education_level::findOrFail($id)->update(["tingkatan" => $request->tingkatan]);

            return response()->json([
                "data" => $edu_level,
                "massage" => "Success Update Data!!"
            ]);
        } catch (QueryException $e) {
            return response()->json([
                "massage" => "Failed" . $e
            ], 400);
        }
    }
    

    public function destroy($id){
        $edu_level = Education_level::findOrFail($id)->delete();

        return response()->json([
            "massage" => "Success Delete Data!!"
        ]);

    }
}
