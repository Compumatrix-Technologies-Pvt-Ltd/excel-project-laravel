<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->date('trx_date');
            $table->string('ticket_no')->unique();
            $table->string('trx_no')->unique()->nullable();
            $table->unsignedBigInteger('vehicle_id')->nullable();
            $table->foreign('vehicle_id')->references('id')->on('vehicles')->onDelete('cascade');
            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
            $table->unsignedBigInteger('mill_id')->nullable();
            $table->foreign('mill_id')->references('id')->on('mills')->onDelete('cascade');
            $table->string('weight')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
