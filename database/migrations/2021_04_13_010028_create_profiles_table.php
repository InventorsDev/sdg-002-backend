<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained("users");
            $table->json("avatar");
            $table->string("phone_number")->nullable();
            $table->string("address")->nullable();
            $table->string("gender")->nullable();
            $table->string("doctor")->nullable();
            $table->string("blood_group")->nullable();
            $table->string("next_of_kin")->nullable();
            $table->date("date_of_birth")->nullable();
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
        Schema::dropIfExists('profiles');
    }
}
