<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FindNewsController extends Controller
{
    public function find_news(Request $request){

        $validate = Validator::make($request->all(), [
            "search" => "max:255",
            "category" => "max:255"
        ]);

        if($validate->fails()){
            return response()->json($validate->errors());
        }

        $news = News::latest()->find_news([
            "search" => $request->search,
            "category" => $request->category
        ])->get();

        return response()->json([
            "data" => $news
        ]);
        
    }
}
