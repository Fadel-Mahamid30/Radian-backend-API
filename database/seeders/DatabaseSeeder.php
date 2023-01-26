<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // user

        \App\Models\User::create([
            'name' => 'Tantan Ihsanudin',
            'email' => 'user01@gmail.com',
            "password" => Hash::make(123456789),
            "nomor_hp" => "08555555551"
        ]);

        \App\Models\User::create([
            'name' => 'Faisal Aris Stama',
            'email' => 'user02@gmail.com',
            "password" => Hash::make(123456789),
            "nomor_hp" => "08555555552"
        ]);

        \App\Models\User::create([
            'name' => 'Muhamammad Fahri',
            'email' => 'user03@gmail.com',
            "password" => Hash::make(123456789),
            "nomor_hp" => "08555555553"
        ]);

        \App\Models\User::create([
            'name' => 'Faisal Judihar',
            'email' => 'user04@gmail.com',
            "password" => Hash::make(123456789),
            "nomor_hp" => "08555555554"
        ]);

        \App\Models\User::create([
            'name' => 'Ahmad',
            'email' => 'user05@gmail.com',
            "password" => Hash::make(123456789),
            "nomor_hp" => "08555555555"
        ]);

        
        // biodata
        \App\Models\Biodata::create([
            "foto_diri" => "drfergrtgrthythnhjhhyujyuj",
            "cv" => "csdcdfvfgbghbnghnhjnhf",
            "name" => "Tantan Ihsanudin",
            "tempat" => "BOGOR",
            "tanggal_lahir" => "2000-11-08",
            "jenis_kelamin" => "Pria",
            "email" => "user01@gmail.com",
            "nomor_hp" => "08555555551",
            "asal_ptn" => "Universitas LP3I",
            "jurusan" => "Management Informatika",
            "ipk" => 3.5,
            "provinsi" => "JAWA BARAT",
            "kabupaten" => "KABUPATEN BOGOR",
            "kecamatan" => "KOPO",
            "alamat" => "kopo",
            "apply" => "Tutor",
            "user_id" => 1
        ]);

        \App\Models\Biodata::create([
            "foto_diri" => "drfergrtgrthythnhjhhyujyuj",
            "cv" => "csdcdfvfgbghbnghnhjnhf",
            "name" => "Faisal Aris Stama",
            "tempat" => "BOGOR",
            "tanggal_lahir" => "2001-09-05",
            "jenis_kelamin" => "Pria",
            "email" => "user02@gmail.com",
            "nomor_hp" => "08555555552",
            "asal_ptn" => "Universitas UI",
            "jurusan" => "Kedoteran",
            "ipk" => 3.8,
            "provinsi" => "JAWA BARAT",
            "kabupaten" => "KOTA DEPOK",
            "kecamatan" => "TAPOS",
            "alamat" => "Tapos",
            "apply" => "Tutor",
            "user_id" => 2
        ]);

        \App\Models\Biodata::create([
            "foto_diri" => "drfergrtgrthythnhjhhyujyuj",
            "cv" => "csdcdfvfgbghbnghnhjnhf",
            "name" => "Muhamammad Fahri",
            "tempat" => "JAKARTA",
            "tanggal_lahir" => "2001-07-04",
            "jenis_kelamin" => "Pria",
            "email" => "user03@gmail.com",
            "nomor_hp" => "08555555553",
            "asal_ptn" => "Universitas UNDIP",
            "jurusan" => "Sosial",
            "ipk" => 3.8,
            "provinsi" => "JAWA BARAT",
            "kabupaten" => "JAKARTA BARAT",
            "kecamatan" => "CENGKARENG",
            "alamat" => "kel. Cengkareng barat",
            "apply" => "Tutor",
            "user_id" => 3
        ]);

        \App\Models\Biodata::create([
            "foto_diri" => "drfergrtgrthythnhjhhyujyuj",
            "cv" => "csdcdfvfgbghbnghnhjnhf",
            "name" => "Faisal Judihar",
            "tempat" => "JAKARTA",
            "tanggal_lahir" => "2002-10-10",
            "jenis_kelamin" => "Pria",
            "email" => "user04@gmail.com",
            "nomor_hp" => "08555555554",
            "asal_ptn" => "Universitas UNP",
            "jurusan" => "Fisika",
            "ipk" => 3.8,
            "provinsi" => "JAWA BARAT",
            "kabupaten" => "JAKARTA PUSAT",
            "kecamatan" => "GAMBIR",
            "alamat" => "kel. Cideng",
            "apply" => "Tutor",
            "user_id" => 4
        ]);

        \App\Models\Biodata::create([
            "foto_diri" => "drfergrtgrthythnhjhhyujyuj",
            "cv" => "csdcdfvfgbghbnghnhjnhf",
            "name" => "Ahmad",
            "tempat" => "BOGOR",
            "tanggal_lahir" => "1999-05-02",
            "jenis_kelamin" => "Pria",
            "email" => "user05@gmail.com",
            "nomor_hp" => "08555555555",
            "asal_ptn" => "Universitas LP3I",
            "jurusan" => "Perkantoran",
            "ipk" => 3.8,
            "provinsi" => "JAWA BARAT",
            "kabupaten" => "KABUPATEN BOGOR",
            "kecamatan" => "CIBINONG",
            "alamat" => "kel. Lulut",
            "apply" => "Tutor",
            "user_id" => 5
        ]);

        // aktivitas

        // user 1
        \App\Models\Activity::create([
            "aktivitas" => "Mengajar",
            "biodata_id" => 1
        ]);
        \App\Models\Activity::create([
            "aktivitas" => "Tutor",
            "biodata_id" => 1
        ]);
        \App\Models\Activity::create([
            "aktivitas" => "Freshguard",
            "biodata_id" => 1
        ]);
        
        // user 2
        \App\Models\Activity::create([
            "aktivitas" => "Mengajar",
            "biodata_id" => 2
        ]);
        \App\Models\Activity::create([
            "aktivitas" => "Tutor",
            "biodata_id" => 2
        ]);
        \App\Models\Activity::create([
            "aktivitas" => "Freshguard",
            "biodata_id" => 2
        ]);

        // user 3
        \App\Models\Activity::create([
            "aktivitas" => "Mengajar",
            "biodata_id" => 3
        ]);
        \App\Models\Activity::create([
            "aktivitas" => "Tutor",
            "biodata_id" => 3
        ]);
        \App\Models\Activity::create([
            "aktivitas" => "Freshguard",
            "biodata_id" => 3
        ]);

        // user 4
        \App\Models\Activity::create([
            "aktivitas" => "Mengajar",
            "biodata_id" => 4
        ]);
        \App\Models\Activity::create([
            "aktivitas" => "Tutor",
            "biodata_id" => 4
        ]);
        \App\Models\Activity::create([
            "aktivitas" => "Freshguard",
            "biodata_id" => 4
        ]);

        // user 5
        \App\Models\Activity::create([
            "aktivitas" => "Mengajar",
            "biodata_id" => 5
        ]);
        \App\Models\Activity::create([
            "aktivitas" => "Tutor",
            "biodata_id" => 5
        ]);
        \App\Models\Activity::create([
            "aktivitas" => "Freshguard",
            "biodata_id" => 5
        ]);

        // Profile
        \App\Models\Profile::create([
            "harga" => 200000,
            "deskripsi_diri" => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Amet rem fuga dicta in voluptas aperiam asperiores! Dolores iste, reiciendis rem est, nihil porro inventore corrupti assumenda fuga possimus unde sint!",
            "user_id" => 1
        ]);
        
        \App\Models\Profile::create([
            "harga" => 250000,
            "deskripsi_diri" => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Amet rem fuga dicta in voluptas aperiam asperiores! Dolores iste, reiciendis rem est, nihil porro inventore corrupti assumenda fuga possimus unde sint!",
            "user_id" => 2
        ]);

        \App\Models\Profile::create([
            "harga" => 230000,
            "deskripsi_diri" => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Amet rem fuga dicta in voluptas aperiam asperiores! Dolores iste, reiciendis rem est, nihil porro inventore corrupti assumenda fuga possimus unde sint!",
            "user_id" => 3
        ]);

        \App\Models\Profile::create([
            "harga" => 280000,
            "deskripsi_diri" => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Amet rem fuga dicta in voluptas aperiam asperiores! Dolores iste, reiciendis rem est, nihil porro inventore corrupti assumenda fuga possimus unde sint!",
            "user_id" => 4
        ]);

        \App\Models\Profile::create([
            "harga" => 200000,
            "deskripsi_diri" => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Amet rem fuga dicta in voluptas aperiam asperiores! Dolores iste, reiciendis rem est, nihil porro inventore corrupti assumenda fuga possimus unde sint!",
            "user_id" => 5
        ]);

        // pengalaman
        \App\Models\Experience::create([
            "perusahaan" => "PT. Indocement",
            "mulai" => "2021-09-09",
            "sampai" => "2022-02-10",
            "deskripsi" => "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dicta ut dignissimos ea amet optio dolores excepturi sequi officia voluptates distinctio.",
            "profile_id" => 1
        ]);
        \App\Models\Experience::create([
            "perusahaan" => "PT. Recy",
            "mulai" => "2021-09-09",
            "sampai" => "2022-02-10",
            "deskripsi" => "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dicta ut dignissimos ea amet optio dolores excepturi sequi officia voluptates distinctio.",
            "profile_id" => 2
        ]);

        \App\Models\Experience::create([
            "perusahaan" => "SMP NAMBO",
            "mulai" => "2021-09-09",
            "sampai" => "2022-02-10",
            "deskripsi" => "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dicta ut dignissimos ea amet optio dolores excepturi sequi officia voluptates distinctio.",
            "profile_id" => 3
        ]);

        \App\Models\Experience::create([
            "perusahaan" => "PT. Indocement",
            "mulai" => "2021-09-09",
            "sampai" => "2022-02-10",
            "deskripsi" => "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dicta ut dignissimos ea amet optio dolores excepturi sequi officia voluptates distinctio.",
            "profile_id" => 4
        ]);

        \App\Models\Experience::create([
            "perusahaan" => "PT. AMP",
            "mulai" => "2021-09-09",
            "sampai" => "2022-02-10",
            "deskripsi" => "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dicta ut dignissimos ea amet optio dolores excepturi sequi officia voluptates distinctio.",
            "profile_id" => 5
        ]);


        // pendidikan
        \App\Models\Education::create([
            "universitas" => "Universitas LP3I",
            "mulai" => "2021-09-09",
            "sampai" => "2022-02-10",
            "deskripsi" => "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dicta ut dignissimos ea amet optio dolores excepturi sequi officia voluptates distinctio.",
            "profile_id" => 1
        ]);

        \App\Models\Education::create([
            "universitas" => "Universitas UI",
            "mulai" => "2021-09-09",
            "sampai" => "2022-02-10",
            "deskripsi" => "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dicta ut dignissimos ea amet optio dolores excepturi sequi officia voluptates distinctio.",
            "profile_id" => 2
        ]);

        \App\Models\Education::create([
            "universitas" => "Universitas UNDIP",
            "mulai" => "2021-09-09",
            "sampai" => "2022-02-10",
            "deskripsi" => "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dicta ut dignissimos ea amet optio dolores excepturi sequi officia voluptates distinctio.",
            "profile_id" => 3
        ]);

        \App\Models\Education::create([
            "universitas" => "Universitas UNP",
            "mulai" => "2021-09-09",
            "sampai" => "2022-02-10",
            "deskripsi" => "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dicta ut dignissimos ea amet optio dolores excepturi sequi officia voluptates distinctio.",
            "profile_id" => 4
        ]);

        \App\Models\Education::create([
            "universitas" => "Universitas LP3I",
            "mulai" => "2021-09-09",
            "sampai" => "2022-02-10",
            "deskripsi" => "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dicta ut dignissimos ea amet optio dolores excepturi sequi officia voluptates distinctio.",
            "profile_id" => 5
        ]);


        // minat belajar

        // user 1
        \App\Models\Teaching_interest::create([
            "tingkatan" => "TK", 
            "mata_pelajaran" => "TEMATIK",
            "profile_id" => 1
        ]);
        \App\Models\Teaching_interest::create([
            "tingkatan" => "SD", 
            "mata_pelajaran" => "PKN",
            "profile_id" => 1
        ]);
        \App\Models\Teaching_interest::create([
            "tingkatan" => "SMP", 
            "mata_pelajaran" => "IPA",
            "profile_id" => 1
        ]);

        // user 2
        \App\Models\Teaching_interest::create([
            "tingkatan" => "TK", 
            "mata_pelajaran" => "TEMATIK",
            "profile_id" => 2
        ]);
        \App\Models\Teaching_interest::create([
            "tingkatan" => "SD", 
            "mata_pelajaran" => "IPS",
            "profile_id" => 2
        ]);
        \App\Models\Teaching_interest::create([
            "tingkatan" => "SMP", 
            "mata_pelajaran" => "FISIKA",
            "profile_id" => 2
        ]);

        // user 3
        \App\Models\Teaching_interest::create([
            "tingkatan" => "TK", 
            "mata_pelajaran" => "TEMATIK",
            "profile_id" => 3
        ]);
        \App\Models\Teaching_interest::create([
            "tingkatan" => "SD", 
            "mata_pelajaran" => "AGAMA",
            "profile_id" => 3
        ]);
        \App\Models\Teaching_interest::create([
            "tingkatan" => "SMP", 
            "mata_pelajaran" => "MATEMATIKA",
            "profile_id" => 3
        ]);

        // user 4
        \App\Models\Teaching_interest::create([
            "tingkatan" => "TK", 
            "mata_pelajaran" => "TEMATIK",
            "profile_id" => 4
        ]);
        \App\Models\Teaching_interest::create([
            "tingkatan" => "SD", 
            "mata_pelajaran" => "IPA",
            "profile_id" => 4
        ]);
        \App\Models\Teaching_interest::create([
            "tingkatan" => "SMP", 
            "mata_pelajaran" => "MATEMATIKA",
            "profile_id" => 4
        ]);

        // user 5
        \App\Models\Teaching_interest::create([
            "tingkatan" => "TK", 
            "mata_pelajaran" => "TEMATIK",
            "profile_id" => 5
        ]);
        \App\Models\Teaching_interest::create([
            "tingkatan" => "SD", 
            "mata_pelajaran" => "SBK",
            "profile_id" => 5
        ]);
        \App\Models\Teaching_interest::create([
            "tingkatan" => "SMP", 
            "mata_pelajaran" => "KIMIA",
            "profile_id" => 5
        ]);

        // domisili mengajar

        // user 1
        \App\Models\Teaching_domicile::create([
            "provinsi" => "JAWA BARAT",
            "kabupaten" => "KABUPATEN BOGOR",
            "domisili" => "KOPO",
            "profile_id" => 1
        ]);
        \App\Models\Teaching_domicile::create([
            "provinsi" => "JAWA BARAT",
            "kabupaten" => "KABUPATEN BOGOR",
            "domisili" => "CITEUREUP",
            "profile_id" => 1
        ]);
        \App\Models\Teaching_domicile::create([
            "provinsi" => "JAWA BARAT",
            "kabupaten" => "KABUPATEN BOGOR",
            "domisili" => "CIBINONG",
            "profile_id" => 1
        ]);


        // user 2
        \App\Models\Teaching_domicile::create([
            "provinsi" => "JAWA BARAT",
            "kabupaten" => "KOTA DEPOK",
            "domisili" => "TAPOS",
            "profile_id" => 2
        ]);
        \App\Models\Teaching_domicile::create([
            "provinsi" => "JAWA BARAT",
            "kabupaten" => "KOTA DEPOK",
            "domisili" => "CILODONG",
            "profile_id" => 2
        ]);
        \App\Models\Teaching_domicile::create([
            "provinsi" => "JAWA BARAT",
            "kabupaten" => "KOTA DEPOK",
            "domisili" => "BEJI",
            "profile_id" => 2
        ]);

        // user 3
        \App\Models\Teaching_domicile::create([
            "provinsi" => "JAWA BARAT",
            "kabupaten" => "JAKARTA BARAT",
            "domisili" => "CENGKARENG",
            "profile_id" => 3
        ]);
        \App\Models\Teaching_domicile::create([
            "provinsi" => "JAWA BARAT",
            "kabupaten" => "JAKARTA BARAT",
            "domisili" => "TAMAN SARI",
            "profile_id" => 3
        ]);
        \App\Models\Teaching_domicile::create([
            "provinsi" => "JAWA BARAT",
            "kabupaten" => "JAKARTA BARAT",
            "domisili" => "TAMBORA",
            "profile_id" => 3
        ]);

        // user 4
        \App\Models\Teaching_domicile::create([
            "provinsi" => "JAWA BARAT",
            "kabupaten" => "JAKARTA PUSAT",
            "domisili" => "GAMBIR",
            "profile_id" => 4
        ]);
        \App\Models\Teaching_domicile::create([
            "provinsi" => "JAWA BARAT",
            "kabupaten" => "JAKARTA PUSAT",
            "domisili" => "JOHAR BARU",
            "profile_id" => 4
        ]);
        \App\Models\Teaching_domicile::create([
            "provinsi" => "JAWA BARAT",
            "kabupaten" => "JAKARTA PUSAT",
            "domisili" => "KEMAYORAN",
            "profile_id" => 4
        ]);

        // user 5
        \App\Models\Teaching_domicile::create([
            "provinsi" => "JAWA BARAT",
            "kabupaten" => "KABUPATEN BOGOR",
            "domisili" => "CIBINONG",
            "profile_id" => 5
        ]);
        \App\Models\Teaching_domicile::create([
            "provinsi" => "JAWA BARAT",
            "kabupaten" => "KABUPATEN BOGOR",
            "domisili" => "NAMBO",
            "profile_id" => 5
        ]);
        \App\Models\Teaching_domicile::create([
            "provinsi" => "JAWA BARAT",
            "kabupaten" => "KABUPATEN BOGOR",
            "domisili" => "CITEUREUP",
            "profile_id" => 5
        ]);
    }
}
