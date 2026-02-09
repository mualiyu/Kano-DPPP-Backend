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
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->string('contract_number')->unique();
            $table->unsignedBigInteger('purchase_order_id');
            $table->unsignedBigInteger('tender_id');
            $table->unsignedBigInteger('bid_id');
            $table->unsignedBigInteger('mda_id');
            $table->unsignedBigInteger('vendor_id');
            $table->string('title');
            $table->text('description');
            $table->decimal('contract_value', 15, 2);
            $table->string('currency', 3)->default('NGN');
            $table->string('status')->default('draft');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->integer('duration_days')->nullable();
            $table->text('scope_of_work')->nullable();
            $table->json('deliverables')->nullable();
            $table->json('payment_terms')->nullable();
            $table->decimal('performance_security_amount', 15, 2)->nullable();
            $table->string('performance_security_document')->nullable();
            $table->text('special_conditions')->nullable();
            $table->json('contract_documents')->nullable();
            $table->string('digital_signature_mda')->nullable();
            $table->string('digital_signature_vendor')->nullable();
            $table->timestamp('signed_at')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('approved_by')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->timestamps();

            // Foreign keys
            $table->foreign('purchase_order_id')->references('id')->on('purchase_orders');
            $table->foreign('tender_id')->references('id')->on('tenders');
            $table->foreign('bid_id')->references('id')->on('bids');
            $table->foreign('mda_id')->references('id')->on('mdas');
            $table->foreign('vendor_id')->references('id')->on('applicants');
            $table->foreign('created_by')->references('id')->on('users');
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
        Schema::dropIfExists('contracts');
    }
};
