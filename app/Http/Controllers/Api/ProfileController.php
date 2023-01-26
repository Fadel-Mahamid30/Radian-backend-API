<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Biodata;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Price;
use App\Models\Profile;
use App\Models\Teaching_domicile;
use App\Models\Teaching_interest;
use Faker\Provider\Lorem;
use GrahamCampbell\ResultType\Success;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index(){
        return response()->json([
            "data" => Profile::all()
        ]);
    }

    public function store(Request $request){
        
        $user_id = auth()->user()->id;
        $biodata = Biodata::where("user_id", $user_id)->first();
        $price = Price::where("kabupaten", $biodata->kabupaten)->first();

        if($price == null){
            $price = Price::where("kabupaten", "Default")->first();
        }

        $validate = Validator::make($request->all(), [
            "harga" => "numeric|min:$price->min_harga|max:$price->max_harga"
        ]);

        if($validate->fails()){
            return response()->json($validate->errors(), 400);
        }

        try {
            $data = Profile::create([
                "deskripsi_diri" => $request->deskripsi,
                "harga" => $request->harga,
                "user_id" => $user_id 

            ]);

            return response()->json([
                "data" => $data,
                "massage" => "Success Add Data"
            ]);

        } catch (QueryException $e) {
            return response()->json([
                "massage" => "Failed" . $e
            ], 400);
        }
    }

    public function show($id){
        $profile = Profile::findOrFail($id);

        return response()->json([
            "data" => $profile
        ]);
    }

    public function update(Request $request, $id){
        $profile = Profile::findOrFail($id);
        $user_id = auth()->user()->id;
        $biodata = Biodata::where("user_id", $user_id)->first();
        $price = Price::where("kabupaten", $biodata->kabupaten)->first();

        if($price == null){
            $price = Price::where("kabupaten", "Default")->first();
        }

        $validate = Validator::make($request->all(), [
            "harga" => "numeric|min:$price->min_harga|max:$price->max_harga"
        ]);

        if($validate->fails()){
            return response()->json($validate->errors(), 400);
        }

        try {
            $profile = Profile::findOrFail($id)->update([
                "deskripsi_diri" => $request->deskripsi,
                "harga" => $request->harga 
            ]);
            
            return response()->json([
                "data" => $profile,
                "massage" => "Success Update Data!!"
            ]);

        } catch (QueryException $e) {
            return response()->json([
                "massage" => "Failed" . $e
            ], 400);
        }
    }

    public function destroy($id){
        
        $profile = Profile::findOrFail($id)->delete();

        return response()->json([
            "massage" => "Success Delete Data!!"
        ]);
    }

    
}

