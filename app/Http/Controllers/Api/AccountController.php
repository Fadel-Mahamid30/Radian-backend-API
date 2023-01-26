<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Biodata;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    public function index(){
        $data = User::all();

        return response()->json([
            "data" => $data
        ]);
    }

    public function management_account(Request $request, $id){
        $user = User::findOrFail($id);

        $validate = Validator::make($request->all(), [
            "status"  => "required|max:255",
            "verification" => "required|max:255",
            "nilai" => "required|numeric|min:1|max:5",
        ]);

        if($validate->fails()){
            return response()->json($validate->errors(), 400);
        }

        try {
            $data = User::findOrFail($id)->update([
                "status"  => $request->status,
                "verification" => $request->verification,
                "nilai" => $request->nilai,
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
        $data = User::findOrFail($id);
        $biodata = Biodata::where("user_id", $data->id);

        if ($biodata->foto_diri && $biodata->cv) {
            Storage::delete($biodata->foto_diri);
            Storage::delete($biodata->cv);
        }

        $data->delete();
        $biodata->delete();
        
        return response()->json([
            "massage" => "Success delete account!!"
        ]);
    }

    public function account_verify(Request $request){

        $data = User::latest()->verify([
            "category" => $request->category, 
            "search" => $request->search
        ])->get();
        
        return response()->json([
            "data" => $data 
        ]);
        
    }

    public function account_nonverify(Request $request){

        $data = User::latest()->non_verify([
            "category" => $request->category, 
            "search" => $request->search
        ])->get();
        
        return response()->json([
            "data" => $data 
        ]);
        
    }

    public function account_active(Request $request){

        $data = User::latest()->active([
            "category" => $request->category, 
            "search" => $request->search
        ])->get();
        
        return response()->json([
            "data" => $data 
        ]);
        
    }

    public function account_nonactive(Request $request){

        $data = User::latest()->non_active([
            "category" => $request->category, 
            "search" => $request->search
        ])->get();
        
        return response()->json([
            "data" => $data 
        ]);
        
    }
}
