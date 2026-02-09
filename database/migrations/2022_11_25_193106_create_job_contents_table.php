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
        Schema::create('job_contents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('job_id');
            $table->string('heading');
            $table->longText('content')->nullable();
            $table->string('num');
            $table->timestamps();

            $table->foreign('job_id')->references('id')->on('jobs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_contents');
    }
};
