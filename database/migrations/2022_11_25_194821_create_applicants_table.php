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
        Schema::create('applicants', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('b_category_id')->nullable();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('photo');
            $table->string('cac_number')->nullable();
            $table->string('type');
            $table->string('ownership_type')->nullable();
            // $table->string('directors')->nullable();
            $table->string('vat_number')->nullable();
            $table->string('address')->nullable();
            $table->string('mobile')->nullable();
            $table->string('password')->nullable();
            $table->string('remember_token')->nullable();
            $table->string('email_verified_at')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();

            // $table->foreign('b_category_id')->references('id')->on('business_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('applicants');
    }
};
