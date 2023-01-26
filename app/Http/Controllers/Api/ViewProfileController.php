<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Profile;
use App\Models\Teaching_domicile;
use App\Models\Teaching_interest;
use Illuminate\Http\Request;

class ViewProfileController extends Controller
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
                "massage" => "Profile Not Found!!"
            ], 404);
        }

        $experience = Experience::where("profile_id", $profile->id)->get();
        $education = Education::where("profile_id", $profile->id)->first();
        $teaching_int = Teaching_interest::where("profile_id", $profile->id)->get();
        $teaching_dmc = Teaching_domicile::where("profile_id", $profile->id)->get();

        return response()->json([
            "profile" => $profile,
            "pengalaman" => $experience,
            "pendidikan" => $education,
            "minat mengajar" => $teaching_int,
            "domisili mengajar" => $teaching_dmc
        ]);
    }
}
