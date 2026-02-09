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
        Schema::rename('jobs', 'tenders');

        Schema::table('tenders', function (Blueprint $table) {
            // Add comprehensive tender fields
            $table->string('tender_number')->unique()->after('id');
            $table->unsignedBigInteger('requisition_id')->nullable()->after('tender_number');
            $table->unsignedBigInteger('mda_id')->after('requisition_id');
            $table->text('description')->nullable()->after('name');
            $table->decimal('estimated_value', 15, 2)->nullable()->after('description');
            $table->string('currency', 3)->default('NGN')->after('estimated_value');
            $table->string('tender_type')->after('currency');
            $table->string('status')->default('draft')->change();
            $table->timestamp('published_at')->nullable()->after('status');
            $table->timestamp('opening_date')->nullable()->after('published_at');
            $table->timestamp('closing_date')->nullable()->after('opening_date');
            $table->timestamp('evaluation_start_date')->nullable()->after('closing_date');
            $table->timestamp('evaluation_end_date')->nullable()->after('evaluation_start_date');
            $table->json('evaluation_criteria')->nullable()->after('evaluation_end_date');
            $table->decimal('bid_security_amount', 15, 2)->nullable()->after('evaluation_criteria');
            $table->decimal('performance_security_amount', 15, 2)->nullable()->after('bid_security_amount');
            $table->integer('contract_duration_days')->nullable()->after('performance_security_amount');
            $table->text('special_conditions')->nullable()->after('contract_duration_days');
            $table->json('required_documents')->nullable()->after('special_conditions');
            $table->unsignedBigInteger('created_by')->after('required_documents');
            $table->unsignedBigInteger('evaluation_committee_head')->nullable()->after('created_by');

            // Foreign keys
            $table->foreign('requisition_id')->references('id')->on('requisitions');
            $table->foreign('mda_id')->references('id')->on('mdas');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('evaluation_committee_head')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tenders', function (Blueprint $table) {
            $table->dropForeign(['requisition_id']);
            $table->dropForeign(['mda_id']);
            $table->dropForeign(['created_by']);
            $table->dropForeign(['evaluation_committee_head']);

            $table->dropColumn([
                'tender_number',
                'requisition_id',
                'mda_id',
                'description',
                'estimated_value',
                'currency',
                'tender_type',
                'published_at',
                'opening_date',
                'closing_date',
                'evaluation_start_date',
                'evaluation_end_date',
                'evaluation_criteria',
                'bid_security_amount',
                'performance_security_amount',
                'contract_duration_days',
                'special_conditions',
                'required_documents',
                'created_by',
                'evaluation_committee_head'
            ]);
        });

        Schema::rename('tenders', 'jobs');
    }
};
