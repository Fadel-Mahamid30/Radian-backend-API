<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class LoginController extends Controller
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
            "email" => "required|email:dns",
            "password" => "required|min:6"
        ]);

        if (!$token = auth()->attempt($request->only("email", "password"))) {
            return response()->json([
                "massage" => "Failed Login"
            ], 400);
        }

        $user = user::where("email", $request->email)->firstOrFail();

        if($user->status == "active"){
            $token_access = $user->createToken("auth_token")->plainTextToken;
            return response()->json([
                "massage" => "Login success",
                "access_token" => $token_access,
                "access_type" => "Bearer"
            ]);
        } else {
            return response()->json([
                "massage" => "Failed Login"
            ], 400);
        }

    }
}
