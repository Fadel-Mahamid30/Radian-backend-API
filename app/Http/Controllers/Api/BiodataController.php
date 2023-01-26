<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Stmt\TryCatch;
use App\Models\Biodata;
use App\Models\District;
use App\Models\Province;
use App\Models\Regency;
use App\Models\Activity;
use App\Models\Profile;

class BiodataController extends Controller
{
    public function showAll(){

        return response()->json([
            "data" => Biodata::all()
        ]);
    }

    public function store(Request $request){

        $validata = Validator::make($request->all(),[
            "foto_diri" => "required|max:2024|mimes:png,jpeg,jpg",
            "cv" => "required|max:2000|mimes:pdf",
            "name" => "required|max:255",
            "tempat" => "required|max:255",
            "tanggal_lahir" => "required",
            "jenis_kelamin" => "required|max:255",
            "email" => "email:dns|required|max:255",
            "nomor_hp" => "required|min:11|max:14",
            "asal_ptn" => "required|max:255",
            "jurusan" => "required|max:255",
            "ipk" => "required",
            "provinsi" => "required|max:255",
            "kabupaten" => "required|max:255",
            "kecamatan" => "required|max:255",
            "alamat" => "required",
            "apply" => "required|max:255",
            "aktivitas.*" => "required|max:255"
        ]);

        if(!$request->aktivitas){
            $validata = Validator::make($request->all(), [
                "aktivitas" => "required|max:255"
            ]);
        }

        $dataAktivitas = $request->aktivitas;
        if ($validata->fails()) {
            return response()->json($validata->errors(), 400);
        }

        if ($request->file("foto_diri") and $request->file("cv")){
            $request->foto_diri = $request->file("foto_diri")->store("Images");
            $request->cv = $request->file("cv")->store("CV");
        }

        try {

            $user_id = $request->user()->id;
            $data = Biodata::create([
                "foto_diri" => $request->foto_diri,
                "cv" => $request->cv,
                "name" => $request->name,
                "tempat" => $request->tempat,
                "tanggal_lahir" => $request->tanggal_lahir,
                "jenis_kelamin" => $request->jenis_kelamin,
                "email" => $request->email,
                "nomor_hp" => $request->nomor_hp,
                "asal_ptn" => $request->asal_ptn,
                "jurusan" => $request->jurusan, 
                "ipk" => $request->ipk,
                "provinsi" => $request->provinsi,
                "kabupaten" => $request->kabupaten,
                "kecamatan" => $request->kecamatan,
                "alamat" => $request->alamat,
                "apply" => $request->apply,
                "user_id" => $user_id
            ]);

            try {
                
                $biodata = Biodata::where("id", $data->id)->firstOrFail();
                for ($i=0; $i < count($dataAktivitas); $i++) { 
                    Activity::create([
                        "aktivitas" => $dataAktivitas[$i],
                        "biodata_id" => $biodata->id
                    ]);
                }


                $aktivitas = Activity::where("biodata_id", $biodata->id)->get();
                if ($aktivitas) {
                    return response()->json([
                        "data_biodata" => $data,
                        "data_activity" => $aktivitas,
                        "massage" => "Success Input Data"
                    ]);
                }

            } catch (QueryException $e) {

                Biodata::where("id", $data->id)->delete();

                if($request->foto_diri && $request->cv){
                    Storage::delete($request->foto_diri);
                    Storage::delete($request->cv);
                }
    
                return response()->json([
                    "massage" => "Failed".$e
                ], 400);

            }
            
        } catch (QueryException $e) {

            if($request->foto_diri && $request->cv){
                Storage::delete($request->foto_diri);
                Storage::delete($request->cv);
            }

            return response()->json([
                "massage" => "Failed".$e->errorInfo
            ], 400);

        }
    }

    public function show($id){

        $biodata = Biodata::findOrFail($id);
        $aktivitas = Activity::where("biodata_id", $id)->get();

        $x = [];
        foreach ($aktivitas as $row) {
            $x[] = $row->aktivitas;   
        }

        if ($aktivitas) {
            $dataBiodata = [
                "foto_diri" => $biodata->foto_diri,
                "cv" => $biodata->cv,
                "name" => $biodata->name,
                "tempat" => $biodata->tempat,
                "tanggal_lahir" => $biodata->tanggal_lahir,
                "jenis_kelamin" => $biodata->jenis_kelamin,
                "email" => $biodata->email,
                "nomor_hp" => $biodata->nomor_hp,
                "asal_ptn" => $biodata->asal_ptn,
                "jurusan" => $biodata->jurusan,
                "ipk" => $biodata->ipk,
                "provinsi_id" => $biodata->provinsi,
                "kabupaten_id" => $biodata->kabupaten,
                "kecamatan_id" => $biodata->kecamatan,
                "alamat" => $biodata->alamat,
                "aktivitas" => $x,
                "apply" => $biodata->apply,
                "user_id" => $biodata->user_id,
                "id" => $biodata->id
            ];

            return response()->json([
                "data" => $dataBiodata,
                "massage" => "Success Input Data"
            ]);

        }
    }

    public function update(Request $request, Biodata $id){

        $biodata = $id;
        $validata = Validator::make($request->all(),[
            "foto_diri" => "required|max:2024|mimes:png,jpeg,jpg",
            "cv" => "required|max:2000|mimes:pdf",
            "name" => "required|max:255",
            "tempat" => "required|max:255",
            "tanggal_lahir" => "required",
            "jenis_kelamin" => "required|max:255",
            "email" => "email:dns|required|max:255",
            "nomor_hp" => "required|min:11|max:14",
            "asal_ptn" => "required|max:255",
            "jurusan" => "required|max:255",
            "ipk" => "required",
            "provinsi" => "required|max:255",
            "kabupaten" => "required|max:255",
            "kecamatan" => "required|max:255",
            "alamat" => "required",
            "apply" => "required|max:255",
            "aktivitas.*" => "required|max:255"
        ]);

        if(!$request->aktivitasi){
            $validata = Validator::make($request->all(), [
                "aktivitas" => "required|max:255"
            ]);
        }

        $dataAktivitas = $request->aktivitas;
        if ($validata->fails()) {
            return response()->json($validata->errors(), 400);
        }

        if ($request->file("foto_diri") and $request->file("cv")){

            if($biodata->foto_diri && $biodata->cv){
                Storage::delete($biodata->foto_diri);
                Storage::delete($biodata->cv);
            }

            $request->foto_diri = $request->file("foto_diri")->store("Images");
            $request->cv = $request->file("cv")->store("CV");
        }

        try {
            
            $user_id = $request->user()->id;
            Biodata::where("id", $biodata->id)->update([
                "foto_diri" => $request->foto_diri,
                "cv" => $request->cv,
                "name" => $request->name,
                "tempat" => $request->tempat,
                "tanggal_lahir" => $request->tanggal_lahir,
                "jenis_kelamin" => $request->jenis_kelamin,
                "email" => $request->email,
                "nomor_hp" => $request->nomor_hp,
                "asal_ptn" => $request->asal_ptn,
                "jurusan" => $request->jurusan, 
                "ipk" => $request->ipk,
                "provinsi" => $request->provinsi,
                "kabupaten" => $request->kabupaten,
                "kecamatan" => $request->kecamatan,
                "alamat" => $request->alamat,
                "apply" => $request->apply,
                "user_id" => $user_id
            ]);

            $data_biodata = Biodata::find($id);

            // Mengedit data aktivitas
            $check = [];
            for ($i=0; $i < count($dataAktivitas); $i++) { 
                $x = Activity::where("biodata_id", $biodata->id)->where("aktivitas", $dataAktivitas[$i])->first();
                if($x){
                    $check[] = $x->aktivitas;
                }
            }
            
            if(count($check) == count($dataAktivitas)){
                return response()->json([
                    "data biodata" => $data_biodata,
                    "current activity" => $check,
                    "massage" => "Success edit data" 
                ]);
            } else {
                
                Activity::where("biodata_id", $biodata->id)->delete();
                for ($i=0; $i < count($dataAktivitas); $i++){
                    Activity::create([
                        "aktivitas" => $dataAktivitas[$i],
                        "biodata_id" => $biodata->id
                    ]);
                }

                return response()->json([
                    "data biodata" => $data_biodata,
                    "current activity" => $dataAktivitas,
                    "massage" => "Success edit data" 
                ]);
                
            }

        } catch (QueryException $e) {
            
            return response()->json([
                "massage" => "Failed" . $e
            ], 400);
        }
    }

    public function destroy($id)
    {
        $biodata = Biodata::findOrFail($id);
        
        if ($biodata->foto_diri && $biodata->cv) {
            Storage::delete($biodata->foto_diri);
            Storage::delete($biodata->cv);
        }

        Biodata::where("id", $biodata->id)->delete();

        return response()->json([
            "massage" => "Delete Success"
        ]);
    }

}
