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
        Schema::create('company_branches', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id');
            $table->string('code', 32); // e.g. "HQ", "VC-2"
            $table->string('name', 100);
            $table->string('address', 255)->nullable();
            $table->string('lat', 32)->nullable();
            $table->string('lng', 32)->nullable();
            $table->string('phone', 32)->nullable();
            $table->enum('status', ['open', 'closed', 'suspended'])->default('open');
            $table->timestamps();

            $table->foreign('company_id')->references('id')->on('company_info')->onDelete('cascade');
            $table->unique(['company_id','code']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_branches');
    }
};
