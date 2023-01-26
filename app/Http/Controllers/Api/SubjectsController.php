<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Subjects;
use Dotenv\Parser\Value;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class pSubjectsController extends Controller
{
    public function index(){
        return response()->json([
            "data" => Subjects::all()
        ]);
    }

    public function store(Request $request){

        $validate = Validator::make($request->all(), [
            "tingkatan_id" => "required|numeric",
            "mata_pelajaran" => "required|max:255"
        ]);

        if($validate->fails()){
            return response()->json($validate->errors(), 400);
        }

        try {
           $data = Subjects::create([
            "tingkatan_id" => $request->tingkatan_id,
            "mata_pelajaran" => $request->mata_pelajaran
        ]);

           return response()->json([
            "data" => $data,
            "massage" =>"Berhasil menambah data!!"
           ]);

        } catch (QueryException $e) {
            return response()->json([
                "massage" => "Failed" . $e
            ], 400);
        }

    }

    public function show($id){
        
        $subjects = Subjects::findOrFail($id);

        return response()->json([
            "data" => $subjects,
        ]);
        
    }

    public function update(Request $request ,$id){

        $validata = Validator::make($request->all(), [
            "tingkatan_id" => "required|numeric",
            "mata_pelajaran" => "required|max:255"
        ]);

        if($validata->fails()){
            return response()->json($validata->errors(), 400);
        }

        try {
     
            Subjects::findOrFail($id)->update([
                "tingkatan_id" => $request->tingkatan_id,
                "mata_pelajaran" => $request->mata_pelajaran
            ]);
            
            return response()->json([
                "massage" => "Berhasil mengupdate data!!"
            ]);

        } catch (QueryException $e) {
            return response()->json([
                "massage" => "Failed" . $e
            ], 400);
        }
    }

    public function destroy($id){
        $subjects = Subjects::findOrFail($id)->delete();
       
        return response()->json([
            "massage" => "Berhasil menghapus data!!"
        ]);

       
    }

}
