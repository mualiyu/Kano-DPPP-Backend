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
        Schema::rename('applications', 'bids');

        Schema::table('bids', function (Blueprint $table) {
            // Rename columns
            $table->renameColumn('applicant_id', 'vendor_id');
            $table->renameColumn('job_id', 'tender_id');

            // Add comprehensive bid fields
            $table->string('bid_number')->unique()->after('id');
            $table->decimal('bid_amount', 15, 2)->nullable()->after('bid_number');
            $table->string('currency', 3)->default('NGN')->after('bid_amount');
            $table->integer('validity_period_days')->default(90)->after('currency');
            $table->timestamp('submission_date')->nullable()->after('validity_period_days');
            $table->string('status')->default('draft')->change();
            $table->decimal('technical_score', 5, 2)->nullable()->after('status');
            $table->decimal('financial_score', 5, 2)->nullable()->after('technical_score');
            $table->decimal('total_score', 5, 2)->nullable()->after('financial_score');
            $table->integer('rank')->nullable()->after('total_score');
            $table->text('evaluation_notes')->nullable()->after('rank');
            $table->text('rejection_reason')->nullable()->after('evaluation_notes');
            $table->json('bid_documents')->nullable()->after('rejection_reason');
            $table->decimal('bid_security_amount', 15, 2)->nullable()->after('bid_documents');
            $table->string('bid_security_document')->nullable()->after('bid_security_amount');

            // Add foreign key references
            $table->foreign('vendor_id')->references('id')->on('applicants');
            $table->foreign('tender_id')->references('id')->on('tenders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bids', function (Blueprint $table) {
            $table->dropForeign(['vendor_id']);
            $table->dropForeign(['tender_id']);

            $table->dropColumn([
                'bid_number',
                'bid_amount',
                'currency',
                'validity_period_days',
                'submission_date',
                'technical_score',
                'financial_score',
                'total_score',
                'rank',
                'evaluation_notes',
                'rejection_reason',
                'bid_documents',
                'bid_security_amount',
                'bid_security_document'
            ]);

            $table->renameColumn('vendor_id', 'applicant_id');
            $table->renameColumn('tender_id', 'job_id');
        });

        Schema::rename('bids', 'applications');
    }
};
