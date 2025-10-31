<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Suppliers extends Model
{
    protected $table = 'suppliers';

    protected $fillable = [
        'user_id',
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
    public function bankDetails()
    {
        return $this->belongsTo(Bank::class, 'bank_id');
    }

    public static function generateSupplierId($prefix, $type)
    {
        $lastSupplier = Suppliers::where('supplier_id', 'LIKE', $prefix . '-' . $type . '-%')
            ->orderBy('id', 'desc')
            ->first();

        if ($lastSupplier) {
            $parts = explode('-', $lastSupplier->supplier_id);
            $lastSequence = $parts[2] ?? $type . '000';
            $lastNumber = (int) substr($lastSequence, 1);
        } else {
            $lastNumber = 0;
        }

        $newNumber = $lastNumber + 1;

        $letter = $type;
        if ($newNumber > 99) {
            $letter = chr(ord($type) + 1);
            $newNumber = 1;

            if ($letter > 'Z') {
                $letter = 'Z';
                $newNumber = 99;
            }
        }

        $formatted = $letter . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

        return $prefix . '-' . $letter . '-' . $formatted;
    }
}
