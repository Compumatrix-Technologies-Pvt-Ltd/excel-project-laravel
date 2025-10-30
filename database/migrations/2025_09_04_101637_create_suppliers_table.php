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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('supplier_id')->unique();
            $table->string('supplier_type')->nullable();
            $table->string('supplier_name');
            $table->string('address1');
            $table->string('address2')->nullable();
            $table->string('mpob_lic_no')->nullable();
            $table->date('mpob_exp_date')->nullable();
            $table->string('mspo_cert_no')->nullable();
            $table->date('mspo_exp_date')->nullable();
            $table->string('tin')->nullable();
            $table->decimal('subsidy_rate', 8, 2)->nullable();
            $table->decimal('land_size', 10, 2)->nullable();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->string('email');
            $table->string('telphone_1')->nullable();
            $table->string('telphone_2')->nullable();
            $table->string('bank_acc_no');
            $table->text('remark')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};
