<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('biodatas', function (Blueprint $table) {
            
            $table->id()->unsigned();
            $table->string("foto_diri");
            $table->string("cv");
            $table->string("name");
            $table->string("tempat");
            $table->date("tanggal_lahir");
            $table->enum("jenis_kelamin", ["Pria", "Wanita"]);
            $table->string("email");
            $table->string("nomor_hp");
            $table->string("asal_ptn");
            $table->string("jurusan");
            $table->double("ipk")->unsigned();
            $table->string("provinsi");
            $table->string("kabupaten");
            $table->string("kecamatan");
            $table->text("alamat");
            $table->string("apply");
            $table->foreignId("user_id")->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('biodatas');
    }
};
