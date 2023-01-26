<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function index(Request $request){
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

    public function store(Request $request){
        $validate = Validator::make($request->all(),[
            "post_foto" => "required|max:2024|mimes:png,jpeg,jpg",
            "title" => "required|max:255",
            "deskripsi" => "required",
            "category_id" => "required"
        ]);

        if($validate->fails()){
            return response()->json($validate->errors(), 400);
        }

        if ($request->file("post_foto")){
            $request->post_foto = $request->file("post_foto")->store("content_news");
        }

        try {
            
            $data = News::create([
                "post_foto" => $request->post_foto,
                "title" => $request->title,
                "author" => auth()->user()->name,
                "deskripsi" => $request->deskripsi,
                "category_id" => $request->category_id
            ]);

            return response()->json([
                "data" => $data,
                "massage" => "Success input data!!"
            ], 200);

        } catch (QueryException $e) {
            
            return response()->json([
                "massage" => "Failed" . $e
            ], 400);
        }
    }

    public function show($id){
        $news = News::findOrFail($id);

        return response()->json([
            "data" => $news
        ]);
    }

    public function update(Request $request, $id){
        $news = News::findOrFail($id);

        $validate = Validator::make($request->all(),[
            "post_foto" => "required|max:2024|mimes:png,jpeg,jpg",
            "title" => "required|max:255",
            "deskripsi" => "required",
            "category_id" => "required"
        ]);

        if($validate->fails()){
            return response()->json($validate->errors(), 400);
        }

        if ($request->file("foto_diri")){
            if($news->post_foto){
                Storage::delete($news->post_foto);
            }

            $request->post_foto = $request->file("post_foto")->store("content_news");
        }

        try {
            
            $data = News::findOrFail($id)->update([
                "post_foto" => $request->post_foto,
                "title" => $request->title,
                "deskripsi" => $request->deskripsi,
                "category_id" => $request->category_id
            ]);

            return response()->json([
                "data" => $data,
                "massage" => "Success update data!!"
            ]);

        } catch (QueryException $e) {
            return response()->json([
                "massage" => "Failed" . $e
            ], 400);
        }
    }

    public function destroy($id){
        $news = News::findOrFail($id)->delete();

        return response()->json([
            "data" => $news,
            "massage" => "Success delete data!!"
        ]);
    }

}
