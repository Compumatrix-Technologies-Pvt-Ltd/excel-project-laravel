<?php

namespace App\Imports;

use App\Models\Suppliers;
use Maatwebsite\Excel\Concerns\ToModel;

class SuppliersImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        if (auth()->user()->role === 'hq') {
            dd("here");
            $supplierId = $row['supplier_id'] ?? null;

            return new Suppliers([
                'supplier_id' => $supplierId,
                'supplier_type' => $row['supplier_type'] ?? null,
                'supplier_name' => $row['supplier_name'] ?? null,
                'address1' => $row['address1'] ?? null,
                'address2' => $row['address2'] ?? null,
                'telphone_1' => $row['telphone_1'] ?? null,
                'telphone_2' => $row['telphone_2'] ?? null,
                'email' => $row['email'] ?? null,
                'bank_id' => $row['bank_id'] ?? null,
                'bank_acc_no' => $row['bank_acc_no'] ?? null,
                'user_id' => auth()->id(),
            ]);
        } else {
            $prefix = $row['prefix'] ?? 'VC';
            $type = strtoupper(substr($row['supplier_type'], 0, 1));
            $supplierId = $row['supplier_id'] ?? Suppliers::generateSupplierId($prefix, $type);

            return new Suppliers([
                'supplier_id' => $supplierId,
                'supplier_type' => $row['supplier_type'] ?? null,
                'supplier_name' => $row['supplier_name'] ?? null,
                'address1' => $row['address1'] ?? null,
                'address2' => $row['address2'] ?? null,
                'mpob_lic_no' => $row['mpob_lic_no'] ?? null,
                'mpob_exp_date' => $row['mpob_exp_date'] ?? null,
                'mspo_cert_no' => $row['mspo_cert_no'] ?? null,
                'mspo_exp_date' => $row['mspo_exp_date'] ?? null,
                'tin' => $row['tin'] ?? null,
                'subsidy_rate' => $row['subsidy_rate'] ?? null,
                'land_size' => $row['land_size'] ?? null,
                'latitude' => $row['latitude'] ?? null,
                'longitude' => $row['longitude'] ?? null,
                'telphone_1' => $row['telphone_1'] ?? null,
                'telphone_2' => $row['telphone_2'] ?? null,
                'email' => $row['email'] ?? null,
                'bank_id' => $row['bank_id'] ?? null,
                'bank_acc_no' => $row['bank_acc_no'] ?? null,
                'remark' => $row['remark'] ?? null,
                'user_id' => auth()->id(),
            ]);
        }

    }
}
