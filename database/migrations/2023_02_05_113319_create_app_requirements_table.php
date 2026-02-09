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
        Schema::create('app_requirements', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type');
            $table->longText('value')->nullable();
            $table->unsignedBigInteger('job_id');
            $table->unsignedBigInteger('sys_id');
            $table->timestamps();

            $table->foreign('job_id')->references('id')->on('jobs');
            $table->foreign('sys_id')->references('id')->on('sys_requirements');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('app_requirements');
    }
};
