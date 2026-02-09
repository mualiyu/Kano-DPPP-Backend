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
        Schema::create('business_sub_categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('b_c_id');
            $table->string('name');
            $table->timestamps();

            $table->foreign('b_c_id')->references('id')->on('business_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('business_sub_categories');
    }
};
