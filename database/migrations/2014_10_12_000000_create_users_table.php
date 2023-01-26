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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string("nomor_hp");
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer("nilai")->default(1);
            $table->enum("status", ["active", "non_active"])->default("active");
            $table->enum("verification", ["verify", "non_verify"])->default("non_verify");
            $table->enum("hak_akses", ["user", "admin", "super_admin"])->default("user");
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
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
        Schema::dropIfExists('users');
    }
};
