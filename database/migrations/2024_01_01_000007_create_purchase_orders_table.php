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
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->string('po_number')->unique();
            $table->unsignedBigInteger('tender_id');
            $table->unsignedBigInteger('bid_id');
            $table->unsignedBigInteger('mda_id');
            $table->unsignedBigInteger('vendor_id');
            $table->string('title');
            $table->text('description');
            $table->decimal('amount', 15, 2);
            $table->string('currency', 3)->default('NGN');
            $table->string('status')->default('draft');
            $table->date('issue_date')->nullable();
            $table->date('delivery_date')->nullable();
            $table->text('delivery_address')->nullable();
            $table->text('terms_conditions')->nullable();
            $table->json('line_items')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('approved_by')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->timestamps();

            // Foreign keys
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
        Schema::dropIfExists('purchase_orders');
    }
};
