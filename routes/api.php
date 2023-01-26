<?php

use App\Http\Controllers\Api\AccountController;
use App\Http\Controllers\Api\BiodataController;
use App\Http\Controllers\api\CategoryController;
use App\Http\Controllers\Api\EducationController;
use App\Http\Controllers\Api\EducationLevelController;
use App\Http\Controllers\api\ExperienceController;
use App\Http\Controllers\api\FindNewsController;
use App\Http\Controllers\Api\FindTeacherController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\LogoutController;
use App\Http\Controllers\api\NewsController;
use App\Http\Controllers\api\PriceController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\SelectController;
use App\Http\Controllers\api\SubjectsController;
use App\Http\Controllers\api\SubscribeController;
use App\Http\Controllers\Api\TeachingDomicileController;
use App\Http\Controllers\Api\TeachingInterestController;
use App\Http\Controllers\api\ValidasiController;
use App\Http\Controllers\Api\ViewProfileController;
use App\Models\News;
use App\Models\Subjects;
use Illuminate\Http\Request;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// auth
Route::post("/register", RegisterController::class);
Route::post("/login", LoginController::class);

Route::middleware('auth:sanctum')->group(function () {
    
    // logout
    Route::post("/logout", LogoutController::class);

    // biodata
    Route::get("/biodata", [BiodataController::class, "showAll"]);
    Route::get("/biodata/{id}", [BiodataController::class, "show"]);
    Route::post("/biodata", [BiodataController::class, "store"]);
    Route::post("/biodata/{id}", [BiodataController::class, "update"]);
    Route::delete("/biodata/{id}", [BiodataController::class, "destroy"]);

    // price
    Route::get("/price", [PriceController::class, "index"]);
    Route::get("/price/{id}", [PriceController::class, "show"]);
    Route::post("/price", [PriceController::class, "store"]);
    Route::post("/price/{id}", [PriceController::class, "update"]);
    Route::delete("/price/{id}", [PriceController::class, "destroy"]);

    // education level
    Route::get("/education_level", [EducationLevelController::class, "index"]);
    Route::get("/education_level/{id}", [EducationLevelController::class, "show"]);
    Route::post("/education_level", [EducationLevelController::class, "store"]);
    Route::post("/education_level/{id}", [EducationLevelController::class, "update"]);
    Route::delete("/education_level/{id}", [EducationLevelController::class, "destroy"]);

    // subjects
    Route::get("/subjects", [SubjectsController::class, "index"]);
    Route::get("/subjects/{id}", [SubjectsController::class, "show"]);
    Route::post("/subjects", [SubjectsController::class, "store"]);
    Route::post("/subjects/{id}", [SubjectsController::class, "update"]);
    Route::delete("/subjects/{id}", [SubjectsController::class, "destroy"]);

    // profile
    Route::get("/profile", ViewProfileController::class);
    Route::get("/profile/{id}", [ProfileController::class, "show"]);
    Route::post("/profile", [ProfileController::class, "store"]);
    Route::post("/profile/{id}", [ProfileController::class, "update"]);
    Route::delete("/profile/{id}", [ProfileController::class, "destroy"]);

    // experience - profile
    Route::get("/experience", [ExperienceController::class, "index"]);
    Route::get("/experience/{id}", [ExperienceController::class, "show"]);
    Route::post("/experience", [ExperienceController::class, "store"]);
    Route::post("/experience/{id}", [ExperienceController::class, "update"]);
    Route::delete("/experience/{id}", [ExperienceController::class, "destroy"]);

    // education - profile
    Route::get("/education", [EducationController::class, "index"]);
    Route::get("/education/{id}", [EducationController::class, "show"]);
    Route::post("/education", [EducationController::class, "store"]);
    Route::post("/education/{id}", [EducationController::class, "update"]);
    Route::delete("/education/{id}", [EducationController::class, "destroy"]);

    // Teaching interest - profile
    Route::get("/teaching_interest", [TeachingInterestController::class, "index"]);
    Route::get("/teaching_interest/{id}", [TeachingInterestController::class, "show"]);
    Route::post("/teaching_interest", [TeachingInterestController::class, "store"]);
    Route::post("/teaching_interest/{id}", [TeachingInterestController::class, "update"]);
    Route::delete("/teaching_interest/{id}", [TeachingInterestController::class, "destroy"]);

    // Teaching domicile - profile
    Route::get("/teaching_domicile", [TeachingDomicileController::class, "index"]);
    Route::get("/teaching_domicile/{id}", [TeachingDomicileController::class, "show"]);
    Route::post("/teaching_domicile", [TeachingDomicileController::class, "store"]);
    Route::post("/teaching_domicile/{id}", [TeachingDomicileController::class, "update"]);
    Route::delete("/teaching_domicile/{id}", [TeachingDomicileController::class, "destroy"]);

    // Select 
    Route::post("/getkabupaten/{name}", [SelectController::class, "getkabupaten"]);
    Route::post("/getkecamatan/{name}", [SelectController::class, "getkecamatan"]);
    Route::post("/getmapel/{name}", [SelectController::class, "getmapel"]);

    // validasi - profile
    Route::post("/validasi", ValidasiController::class);

    // account management
    Route::post("/account/{id}", [AccountController::class, "management_account"]);
    Route::delete("/account/{id}", [AccountController::class, "destroy"]);
    Route::get("/account/verify", [AccountController::class, "account_verify"]);
    Route::get("/account/non_verify", [AccountController::class, "account_nonverify"]);
    Route::get("/account/active", [AccountController::class, "account_active"]);
    Route::get("/account/non_active", [AccountController::class, "account_nonactive"]);

    // berita (news)
    Route::post("/news", [NewsController::class, "store"]);
    Route::post("/news/{id}", [NewsController::class, "update"]);
    Route::delete("/news", [NewsController::class, "destroy"]);

    // category - (news)
    Route::get("/category", [CategoryController::class, "index"]);
    Route::get("/category/{id}", [CategoryController::class, "show"]);
    Route::post("/category", [CategoryController::class, "store"]);
    Route::post("/category/{id}", [CategoryController::class, "update"]);
    Route::delete("/category/{id}", [CategoryController::class, "destroy"]);

});

Route::get("/account", [AccountController::class, "index"]);

// menampilkan dan cari guru
Route::get("/menu_utama", [FindTeacherController::class, "guruRecomended"]);
Route::get("/cari_guru", [FindTeacherController::class, "cariGuru"]);
Route::get("/detail_guru/{id}", [FindTeacherController::class, "detailGuru"]);

// berita (news)
Route::get("/news", [NewsController::class, "index"]);
Route::get("/news/{id}", [NewsController::class, "show"]);

// subscribe
Route::get("/subscribe", [SubscribeController::class, "index"]);
Route::get("/subscribe/{id}", [SubscribeController::class, "show"]);
Route::post("/subscribe", [SubscribeController::class, "store"]);
Route::post("/subscribe/{id}", [SubscribeController::class, "update"]);
Route::delete("/subscribe/{id}", [SubscribeController::class, "destroy"]);