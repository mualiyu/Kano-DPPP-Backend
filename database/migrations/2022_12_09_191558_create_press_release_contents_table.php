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
        Schema::create('press_release_contents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('press_release_id');
            $table->longText('heading')->nullable();
            $table->longText('content')->nullable();
            $table->longText('image')->nullable();
            $table->timestamps();

            $table->foreign('press_release_id')->references('id')->on('press_releases');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('press_release_contents');
    }
};
