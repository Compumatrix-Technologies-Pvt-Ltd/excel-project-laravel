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
        Schema::table('mills', function (Blueprint $table) {
            $table->unsignedBigInteger('company_id')->after('id');
            $table->unsignedBigInteger('user_id')->after('company_id');

            
            $table->foreign('company_id')->references('id')->on('company_info')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mills', function (Blueprint $table) {
            //
        });
    }
};
