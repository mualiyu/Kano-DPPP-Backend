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
        Schema::create('requisitions', function (Blueprint $table) {
            $table->id();
            $table->string('requisition_number')->unique();
            $table->unsignedBigInteger('mda_id');
            $table->unsignedBigInteger('created_by'); // MDA Officer
            $table->string('title');
            $table->text('description');
            $table->decimal('estimated_cost', 15, 2);
            $table->string('currency', 3)->default('NGN');
            $table->string('budget_line');
            $table->string('procurement_method');
            $table->string('priority')->default('medium');
            $table->string('status')->default('draft');
            $table->text('rejection_reason')->nullable();
            $table->unsignedBigInteger('hod_id')->nullable(); // Head of Department
            $table->unsignedBigInteger('perm_sec_id')->nullable(); // Permanent Secretary
            $table->timestamp('hod_approved_at')->nullable();
            $table->timestamp('perm_sec_approved_at')->nullable();
            $table->timestamp('procurement_board_approved_at')->nullable();
            $table->date('required_delivery_date')->nullable();
            $table->json('attachments')->nullable();
            $table->timestamps();

            // Foreign keys
            $table->foreign('mda_id')->references('id')->on('mdas');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('hod_id')->references('id')->on('users');
            $table->foreign('perm_sec_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('requisitions');
    }
};
