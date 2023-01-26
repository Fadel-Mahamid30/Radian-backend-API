<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use function GuzzleHttp\Promise\all;

class CategoryController extends Controller
{
    public function index(){
        $data = Category::all();

        return response()->json([
            "data" => $data
        ]);
    }

    public function store(Request $request){
        $validate = Validator::make($request->all(),[
            "category" => "required|max:255"
        ]);

        if($validate->fails()){
            return response()->json($validate->errors(), 400);
        }

        try {

            $category = Category::create([
                "category" => $request->category
            ]);

            return response()->json([
                "data" => $category,
                "massage" => "Success input data!!"
            ]);

        } catch (QueryException $e) {

            return response()->json([
                "massage" => "Failed" . $e    
            ]);

        }
    }

    public function show($id){
        $category = Category::findOrFail($id);

        return response()->json([
            "data" => $category
        ]);
    }

    public function update(Request $request, $id){
        $category = Category::findOrFail($id);

        $validate = Validator::make($request->all(), [
            "category" => "required|max:255"
        ]);

        if($validate->fails()){
            return response()->json($validate->errors(), 400);
        }

        try {
            
            $category = Category::findOrFail($id)->update([
                "category" => $request->category
            ]);

            return response()->json([
                "data" => $category,
                "massage" => "Success update data!!"
            ]);
            
        } catch (QueryException $e) {
            return response()->json([
                "massage" => "Failed" . $e
            ]);
        }
    }

    public function destroy($id){
        $category = Category::findOrFail($id)->delete();

        return response()->json([
            "data" => $category,
            "massage" => "Success delete data!!"
        ]);
    }

}
