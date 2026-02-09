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
        Schema::create('app_education', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('app_id');
            $table->string("type");
            $table->string("institute");
            $table->string("major");
            $table->string("start");
            $table->string("end")->nullable();
            $table->string("currently")->nullable();
            $table->timestamps();

            $table->foreign('app_id')->references('id')->on('applications');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('app_education');
    }
};
