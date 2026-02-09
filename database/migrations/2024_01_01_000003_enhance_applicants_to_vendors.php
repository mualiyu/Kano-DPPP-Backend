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
        Schema::table('applicants', function (Blueprint $table) {
            // Add comprehensive vendor fields
            $table->string('registration_number')->nullable()->after('name');
            $table->string('tin_number')->nullable()->after('registration_number');
            $table->string('bvn')->nullable()->after('tin_number');
            $table->string('tax_clearance_certificate')->nullable()->after('bvn');
            $table->string('business_license')->nullable()->after('tax_clearance_certificate');
            $table->string('company_registration_certificate')->nullable()->after('business_license');
            $table->decimal('financial_capacity', 15, 2)->nullable()->after('company_registration_certificate');
            $table->integer('years_in_business')->nullable()->after('financial_capacity');
            $table->json('certifications')->nullable()->after('years_in_business');
            $table->string('approval_status')->default('pending')->after('certifications');
            $table->text('rejection_reason')->nullable()->after('approval_status');
            $table->timestamp('approved_at')->nullable()->after('rejection_reason');
            $table->unsignedBigInteger('approved_by')->nullable()->after('approved_at');
            $table->decimal('performance_rating', 3, 2)->default(0.00)->after('approved_by');
            $table->string('vendor_category')->nullable()->after('performance_rating');
            $table->json('specializations')->nullable()->after('vendor_category');
            $table->string('contact_person')->nullable()->after('specializations');
            $table->string('contact_phone')->nullable()->after('contact_person');
            $table->string('contact_email')->nullable()->after('contact_phone');

            // Add foreign key for approval
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
        Schema::table('applicants', function (Blueprint $table) {
            $table->dropForeign(['approved_by']);
            $table->dropColumn([
                'registration_number',
                'tin_number',
                'bvn',
                'tax_clearance_certificate',
                'business_license',
                'company_registration_certificate',
                'financial_capacity',
                'years_in_business',
                'certifications',
                'approval_status',
                'rejection_reason',
                'approved_at',
                'approved_by',
                'performance_rating',
                'vendor_category',
                'specializations',
                'contact_person',
                'contact_phone',
                'contact_email'
            ]);
        });
    }
};
