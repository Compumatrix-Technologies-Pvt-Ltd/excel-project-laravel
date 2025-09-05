<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Suppliers extends Model
{
    protected $table = 'suppliers';

    protected $fillable = [
        'supplier_id',
        'supplier_type',
        'supplier_name',
        'address1',
        'address2',
        'mpob_lic_no',
        'mpob_exp_date',
        'mspo_cert_no',
        'mspo_exp_date',
        'tin',
        'subsidy_rate',
        'land_size',
        'latitude',
        'longitude',
        'email',
        'telphone_1',
        'telphone_2',
        'bank_id',
        'bank_acc_no',
        'remark',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
