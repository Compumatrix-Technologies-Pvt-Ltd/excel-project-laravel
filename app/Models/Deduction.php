<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deduction extends Model
{
    protected $table = 'deductions';

    protected $fillable = ['date', 'period', 'supplier_id', 'type', 'amount'];


    public function supplier()
    {
        return $this->belongsTo(Suppliers::class, 'supplier_id');
    }
}
