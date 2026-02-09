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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number')->unique();
            $table->unsignedBigInteger('contract_id');
            $table->unsignedBigInteger('vendor_id');
            $table->unsignedBigInteger('mda_id');
            $table->string('title');
            $table->text('description')->nullable();
            $table->decimal('amount', 15, 2);
            $table->string('currency', 3)->default('NGN');
            $table->string('status')->default('draft');
            $table->date('invoice_date');
            $table->date('due_date')->nullable();
            $table->json('line_items')->nullable();
            $table->decimal('tax_amount', 15, 2)->default(0);
            $table->decimal('total_amount', 15, 2);
            $table->json('supporting_documents')->nullable();
            $table->text('rejection_reason')->nullable();
            $table->unsignedBigInteger('submitted_by');
            $table->unsignedBigInteger('reviewed_by')->nullable();
            $table->timestamp('reviewed_at')->nullable();
            $table->unsignedBigInteger('approved_by')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->timestamps();

            // Foreign keys
            $table->foreign('contract_id')->references('id')->on('contracts');
            $table->foreign('vendor_id')->references('id')->on('applicants');
            $table->foreign('mda_id')->references('id')->on('mdas');
            $table->foreign('submitted_by')->references('id')->on('users');
            $table->foreign('reviewed_by')->references('id')->on('users');
            $table->foreign('approved_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
};
