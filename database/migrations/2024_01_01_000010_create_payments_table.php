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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('payment_reference')->unique();
            $table->unsignedBigInteger('invoice_id');
            $table->unsignedBigInteger('contract_id');
            $table->unsignedBigInteger('vendor_id');
            $table->unsignedBigInteger('mda_id');
            $table->decimal('amount', 15, 2);
            $table->string('currency', 3)->default('NGN');
            $table->string('status')->default('pending');
            $table->string('payment_method')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('account_number')->nullable();
            $table->string('account_name')->nullable();
            $table->string('transaction_reference')->nullable();
            $table->date('payment_date')->nullable();
            $table->text('payment_notes')->nullable();
            $table->json('payment_documents')->nullable();
            $table->unsignedBigInteger('processed_by')->nullable();
            $table->timestamp('processed_at')->nullable();
            $table->unsignedBigInteger('approved_by')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->timestamps();

            // Foreign keys
            $table->foreign('invoice_id')->references('id')->on('invoices');
            $table->foreign('contract_id')->references('id')->on('contracts');
            $table->foreign('vendor_id')->references('id')->on('applicants');
            $table->foreign('mda_id')->references('id')->on('mdas');
            $table->foreign('processed_by')->references('id')->on('users');
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
        Schema::dropIfExists('payments');
    }
};
