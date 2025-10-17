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
        Schema::create('company_info', function (Blueprint $table) {
            $table->id();
            $table->string('name', 150);
            $table->string('code', 32)->unique(); // e.g. "VC"
            $table->string('email', 128)->nullable();
            $table->string('phone', 32)->nullable();
            $table->string('address', 255)->nullable();
            $table->string('registration_no', 64)->nullable();
            $table->string('mpob_license_no', 32)->nullable();
            $table->date('mpob_expiry')->nullable();
            $table->string('mspo_cert_no', 64)->nullable();
            $table->date('mspo_expiry')->nullable();
            $table->enum('status', ['active', 'trialing', 'suspended', 'canceled'])->default('active');
            $table->string('logo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_info');
    }
};
