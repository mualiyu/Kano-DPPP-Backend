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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('status');
            // $table->unsignedBigInteger('b_category_id');
            // $table->unsignedBigInteger('b_sub_c_id');
            $table->string('open_date');
            $table->string('close_date');
            $table->timestamps();

            // $table->foreign('b_category_i')->references('id')->on('business_categories');
            // $table->foreign('b_sub_c_id')->references('id')->on('business_sub_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jobs');
    }
};
