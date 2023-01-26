<?php

namespace App\Http\Controllers\api;

use App\Models\Profile;
use App\Http\Controllers\Controller;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Teaching_domicile;
use App\Models\Teaching_interest;
use Illuminate\Http\Request;

class ValidasiController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        $user = auth()->user();

        $profile = Profile::where("user_id", $user->id)->first();
        if(!$profile){
            return response()->json([
                "massage" => "Profile not found!!"
            ], 404);
        }

        $experience = Experience::where("profile_id", $profile->id)->get();
        $education = Education::where("profile_id", $profile->id)->get();
        $teaching_int = Teaching_interest::where("profile_id", $profile->id)->get();
        $teaching_dmc = Teaching_domicile::where("profile_id", $profile->id)->get();

        if ($profile && $experience && $education && $teaching_dmc && $teaching_int){
            return response()->json([
                "massage" => "Next page"
            ], 200);
        }

        return response()->json([
            "massage" => "Complete the data first!!"
        ], 400);

    }
}
