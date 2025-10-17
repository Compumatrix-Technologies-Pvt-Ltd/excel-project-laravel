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
       Schema::create('ffb_transactions', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('company_id');
                $table->unsignedBigInteger('branch_id');
                $table->unsignedBigInteger('supplier_id');
                $table->enum('purchase_type', ['credit', 'cash'])->default('credit'); // Purchase Option
                $table->string('invoice_no', 32); // Inv. No. / Cash Bill
                $table->string('period', 8);      // e.g. "202505"

                $table->string('particulars', 100)->nullable();
                $table->decimal('weight_mt', 10, 2)->default(0);
                $table->decimal('price', 10, 2)->default(0);
                $table->decimal('incentive_rate', 10, 2)->default(0);
                $table->decimal('subsidy_amt', 10, 2)->default(0);
                $table->decimal('amt_before_ded', 12, 2)->default(0);
                // Deduction fields
                $table->decimal('debit_bal_bf', 12, 2)->default(0);
                $table->decimal('transport', 12, 2)->default(0);
                $table->decimal('advance', 12, 2)->default(0);
                $table->decimal('others', 12, 2)->default(0);
                $table->string('others_desc', 64)->nullable();
                $table->decimal('total_deductions', 12, 2)->default(0);
                // Payments
                $table->date('bill_date')->nullable();
                $table->decimal('net_pay', 12, 2)->default(0);
                $table->enum('pay_by', ['cash', 'cheque', 'bank'])->default('cash');
                $table->decimal('debit_bal_cf', 12, 2)->default(0);
                $table->text('remark')->nullable();
                $table->timestamps();

                $table->foreign('company_id')->references('id')->on('company_info')->onDelete('cascade');
                $table->foreign('branch_id')->references('id')->on('company_branches')->onDelete('cascade');
                $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
                // supplier_id should reference your suppliers table if exists
            });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ffb_transactions');
    }
};
