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
        Schema::create('business_sub_category_job', function (Blueprint $table) {
            $table->unsignedBigInteger('business_sub_category_id');
            $table->unsignedBigInteger('Job_id');

            $table->foreign('business_sub_category_id')->references('id')->on('business_sub_categories')
                ->onDelete('cascade');
            $table->foreign('Job_id')->references('id')->on('jobs')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
