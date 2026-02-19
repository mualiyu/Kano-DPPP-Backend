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
        // Update job_contents table
        Schema::table('job_contents', function (Blueprint $table) {
            $table->dropForeign(['job_id']);
        });
        
        Schema::table('job_contents', function (Blueprint $table) {
            $table->renameColumn('job_id', 'tender_id');
        });
        
        Schema::table('job_contents', function (Blueprint $table) {
            $table->foreign('tender_id')->references('id')->on('tenders');
        });

        // Update job_milestones table
        Schema::table('job_milestones', function (Blueprint $table) {
            $table->dropForeign(['job_id']);
        });
        
        Schema::table('job_milestones', function (Blueprint $table) {
            $table->renameColumn('job_id', 'tender_id');
        });
        
        Schema::table('job_milestones', function (Blueprint $table) {
            $table->foreign('tender_id')->references('id')->on('tenders');
        });

        // Update job_documents table
        Schema::table('job_documents', function (Blueprint $table) {
            $table->dropForeign(['job_id']);
        });
        
        Schema::table('job_documents', function (Blueprint $table) {
            $table->renameColumn('job_id', 'tender_id');
        });
        
        Schema::table('job_documents', function (Blueprint $table) {
            $table->foreign('tender_id')->references('id')->on('tenders');
        });

        // Update job_reportings table
        Schema::table('job_reportings', function (Blueprint $table) {
            $table->dropForeign(['job_id']);
        });
        
        Schema::table('job_reportings', function (Blueprint $table) {
            $table->renameColumn('job_id', 'tender_id');
        });
        
        Schema::table('job_reportings', function (Blueprint $table) {
            $table->foreign('tender_id')->references('id')->on('tenders');
        });

        // Update job_requirements table
        Schema::table('job_requirements', function (Blueprint $table) {
            $table->dropForeign(['job_id']);
        });
        
        Schema::table('job_requirements', function (Blueprint $table) {
            $table->renameColumn('job_id', 'tender_id');
        });
        
        Schema::table('job_requirements', function (Blueprint $table) {
            $table->foreign('tender_id')->references('id')->on('tenders');
        });

        // Update app_requirements table
        Schema::table('app_requirements', function (Blueprint $table) {
            $table->dropForeign(['job_id']);
        });
        
        Schema::table('app_requirements', function (Blueprint $table) {
            $table->renameColumn('job_id', 'tender_id');
        });
        
        Schema::table('app_requirements', function (Blueprint $table) {
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
        // Revert job_contents table
        Schema::table('job_contents', function (Blueprint $table) {
            $table->dropForeign(['tender_id']);
        });
        
        Schema::table('job_contents', function (Blueprint $table) {
            $table->renameColumn('tender_id', 'job_id');
        });
        
        Schema::table('job_contents', function (Blueprint $table) {
            $table->foreign('job_id')->references('id')->on('jobs');
        });

        // Revert job_milestones table
        Schema::table('job_milestones', function (Blueprint $table) {
            $table->dropForeign(['tender_id']);
        });
        
        Schema::table('job_milestones', function (Blueprint $table) {
            $table->renameColumn('tender_id', 'job_id');
        });
        
        Schema::table('job_milestones', function (Blueprint $table) {
            $table->foreign('job_id')->references('id')->on('jobs');
        });

        // Revert job_documents table
        Schema::table('job_documents', function (Blueprint $table) {
            $table->dropForeign(['tender_id']);
        });
        
        Schema::table('job_documents', function (Blueprint $table) {
            $table->renameColumn('tender_id', 'job_id');
        });
        
        Schema::table('job_documents', function (Blueprint $table) {
            $table->foreign('job_id')->references('id')->on('jobs');
        });

        // Revert job_reportings table
        Schema::table('job_reportings', function (Blueprint $table) {
            $table->dropForeign(['tender_id']);
        });
        
        Schema::table('job_reportings', function (Blueprint $table) {
            $table->renameColumn('tender_id', 'job_id');
        });
        
        Schema::table('job_reportings', function (Blueprint $table) {
            $table->foreign('job_id')->references('id')->on('jobs');
        });

        // Revert job_requirements table
        Schema::table('job_requirements', function (Blueprint $table) {
            $table->dropForeign(['tender_id']);
        });
        
        Schema::table('job_requirements', function (Blueprint $table) {
            $table->renameColumn('tender_id', 'job_id');
        });
        
        Schema::table('job_requirements', function (Blueprint $table) {
            $table->foreign('job_id')->references('id')->on('jobs');
        });

        // Revert app_requirements table
        Schema::table('app_requirements', function (Blueprint $table) {
            $table->dropForeign(['tender_id']);
        });
        
        Schema::table('app_requirements', function (Blueprint $table) {
            $table->renameColumn('tender_id', 'job_id');
        });
        
        Schema::table('app_requirements', function (Blueprint $table) {
            $table->foreign('job_id')->references('id')->on('jobs');
        });
    }
};
