<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FFBTransactionsModel extends Model
{
    protected $table = 'ffb_transactions';

    protected $fillable = ['company_id', 'user_id', 'branch_id', 'supplier_id', 'purchase_type', 'invoice_no','period','particulars'];
    public function supplier()
    {
        return $this->belongsTo(Suppliers::class, 'supplier_id');
    }

}
