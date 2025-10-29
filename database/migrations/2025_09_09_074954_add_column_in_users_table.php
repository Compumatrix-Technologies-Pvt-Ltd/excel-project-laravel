<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('company_id')->nullable()->constrained('company_info')->nullOnDelete()->after('id');
            $table->foreignId('parent_id')->nullable()->constrained('users')->nullOnDelete()->comment('Manager or parent')->after('company_id');
            $table->foreignId('branch_id')->nullable()->constrained('company_branches')->nullOnDelete()->after('parent_id');
            $table->timestamp('last_login_at')->nullable()->after('branch_id');
            $table->string('avatar')->nullable()->after('last_login_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
