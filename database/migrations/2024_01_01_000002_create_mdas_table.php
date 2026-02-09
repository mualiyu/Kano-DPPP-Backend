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
        Schema::create('mdas', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique(); // MDA code like "MOH", "EDU", etc.
            $table->string('type')->default('ministry'); // ministry, department, agency
            $table->text('description')->nullable();
            $table->string('head_name')->nullable();
            $table->string('head_title')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->decimal('annual_budget', 15, 2)->nullable();
            $table->string('status')->default('active');
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
        Schema::dropIfExists('mdas');
    }
};
