<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Price;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;

class PriceController extends Controller
{
    public function index(){
        return response()->json([
            "data" => Price::all()
        ]);
    }

    public function store(Request $request){
        $validate = Validator::make($request->all(),[
            "provinsi" => "required|max:255",
            "kabupaten" => "required|max:255|unique:prices",
            "min_harga" => "required|numeric",
            "max_harga" => "required|numeric|gt:min_harga"
        ]);

        if($validate->fails()){
            return response()->json($validate->errors(), 400);
        }

        try {
            
            $data = Price::create([
                "provinsi" => $request->provinsi,
                "kabupaten" => $request->kabupaten,
                "min_harga" => $request->min_harga,
                "max_harga" => $request->max_harga
            ]);

            return response()->json([
                "data" => $data,
                "massage" => "Succes Input data"
            ]);
            
        } catch (QueryException $e) {
            return response()->json([
                "massage" => "Failed" . $e
            ], 400);
        }
    }

    public function show($id)
    {
        $price = Price::findOrFail($id);

        return response()->json([
            "data" => $price
        ]);
    }

    public function update(Request $request, $id)
    {
        $price = Price::findOrFail($id);
        $validate = Validator::make($request->all(),[
            "provinsi" => "required|max:255",
            "kabupaten" => "required|max:255",
            "min_harga" => "required|numeric",
            "max_harga" => "required|numeric|gt:min_harga"
        ]);

        if($validate->fails()){
            return response()->json($validate->errors(), 400);
        }

        try {
            
            $data = Price::find($price->id)->update([
                "provinsi" => $request->provinsi,
                "kabupaten" => $request->kabupaten,
                "min_harga" => $request->min_harga,
                "max_harga" => $request->max_harga
            ]);

            return response()->json([
                "data" => $data,
                "massage" => "Succes Input data"
            ]);
            
        } catch (QueryException $e) {
            return response()->json([
                "massage" => "failed" . $e
            ], 400);
        }
    }

    public function destroy($id){
        $price = Price::findOrFail($id)->delete();

        return response()->json([
            "massage" => "Success delete data"
        ]);
    }
}
