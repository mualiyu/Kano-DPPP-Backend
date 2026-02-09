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
        Schema::table('users', function (Blueprint $table) {
            // Enhanced role system
            $table->string('role')->default('citizen')->change();

            // Additional user fields
            $table->string('employee_id')->nullable()->after('role');
            $table->string('department')->nullable()->after('employee_id');
            $table->string('position')->nullable()->after('department');
            $table->string('status')->default('active')->after('position');
            $table->timestamp('last_login_at')->nullable()->after('status');
            $table->json('permissions')->nullable()->after('last_login_at');
            $table->string('profile_image')->nullable()->after('permissions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'employee_id',
                'department',
                'position',
                'status',
                'last_login_at',
                'permissions',
                'profile_image'
            ]);
        });
    }
};
