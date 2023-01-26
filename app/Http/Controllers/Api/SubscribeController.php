<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Subscribe;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubscribeController extends Controller
{
    public function index(){
        $data = Subscribe::all();

        return response()->json([
            "data" => $data
        ]);
    }

    public function store(Request $request){
        $validate = Validator::make($request->all(),[
            "name" => "required|max:255",
            "email" => "email:dns|max:255|required|unique:users"
        ]);

        if($validate->fails()){
            return response()->json($validate->errors(), 400);
        }

        try {

            $subscribe = Subscribe::create([
                "nama" => $request->name,
                "email" => $request->email
            ]);

            return response()->json([
                "data" => $subscribe,
                "massage" => "Success input data!!"
            ]);

        } catch (QueryException $e) {
            return response()->json([
                "massage" => "Failed" . $e
            ]);
        }

    }

    public function show($id){
        $subscribe = Subscribe::findOrFail($id);

        return response()->json([
            "data" => $subscribe
        ]);
    }

    public function update(Request $request, $id){
        $subscribe = Subscribe::findOrFail($id);
        
        $validate = Validator::make($request->all(),[
            "name" => "required|max:255",
            "email" => "email:dns|max:255|required|unique:users"
        ]);

        if($validate->fails()){
            return response()->json($validate->errors(), 400);
        }

        try {

            $subscribe = Subscribe::findOrFail($id)->update([
                "nama" => $request->name,
                "email" => $request->email
            ]);

            return response()->json([
                "data" => $subscribe,
                "massage" => "Success input data!!"
            ]);

        } catch (QueryException $e) {
            return response()->json([
                "massage" => "Failed" . $e
            ]);
        }

    }

    public function destroy($id){
        $subscribe = Subscribe::findOrFail($id)->delete();
    
        
        return response()->json([
            "data" => $subscribe,
            "massage" => "Success delete data!!"
        ]);
    }

}
