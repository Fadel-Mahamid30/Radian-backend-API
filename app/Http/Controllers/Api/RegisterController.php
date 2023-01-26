<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $validate = Validator::make($request->all(),[
            "name" => "required|max:255",
            "nomor_hp" => "required|max:14",
            "email" => "email:dns|max:255|required|unique:users",
            "password" =>"required|max:255"
        ]);

        if ($validate->fails()) {
            return response()->json($validate->errors(), 400);
        }

        try {
            $user = user::create([
                "name" => $request->name,
                "nomor_hp" => $request->nomor_hp,
                "email" => $request->email,
                "password" => Hash::make($request->password)
            ]);
            $token = $user->createToken("auth_token")->plainTextToken;

            $massage = [
                "data" => $user,
                "access_token" => $token,
                "token_type" => "bearer"
            ];
            return response()->json($massage);


        } catch (QueryException $e) {
            return response()->json([
                "massage" => "Failed" . $e
            ], 400);
        }
    
    }
}
