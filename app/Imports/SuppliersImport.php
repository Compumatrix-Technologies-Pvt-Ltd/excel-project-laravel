<?php

namespace App\Imports;

use App\Models\Suppliers;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class SuppliersImport implements ToModel, WithHeadingRow
{
    public function headingRow(): int
    {
        return 1;
    }

    public function mapHeading($heading)
    {
        return trim(strtolower(str_replace(' ', '_', $heading)));
    }

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        if (auth()->user()->role === 'hq') {

            return new Suppliers([
                'supplier_id' => $row['supplier_id'] ?? null,
                'supplier_name' => $row['supplier_name'] ?? null,
                'address1' => $row['address_1'] ?? null,
                'address2' => $row['address_2'] ?? null,
                'telphone_1' => $row['telephone_1'] ?? null,
                'telphone_2' => $row['telephone_2'] ?? null,
                'email' => $row['email'] ?? null,
                'bank_id' => $row['bank_id'] ?? null,
                'bank_acc_no' => $row['bank_account_number'] ?? null,
                'user_id' => auth()->user()->id,
            ]);
        } else {
            $supplierType = strtolower(trim($row['supplier_type'] ?? ''));
            $type = match ($supplierType) {
                'credit' => 'A',
                'cash' => 'B',
            };

            $prefix = $row['prefix'] ?? 'VC';
            $supplierId = $row['Supplier Id'] ?? Suppliers::generateSupplierId($prefix, $type);

            return new Suppliers([
                'supplier_id' => $supplierId,
                'supplier_type' => $row['supplier_type'] ?? null,
                'supplier_name' => $row['supplier_name'] ?? null,
                'address1' => $row['address_1'] ?? null,
                'address2' => $row['address_2'] ?? null,
                'mpob_lic_no' => $row['mpob_lic_no'] ?? null,
                'mpob_exp_date' => $row['mpob_exp_date'] ?? null,
                'mspo_cert_no' => $row['mspo_cert_no'] ?? null,
                'mspo_exp_date' => $row['mspo_exp_date'] ?? null,
                'tin' => $row['tin'] ?? null,
                'subsidy_rate' => $row['subsidy_rate'] ?? null,
                'land_size' => $row['land_size'] ?? null,
                'latitude' => $row['latitude'] ?? null,
                'longitude' => $row['longitude'] ?? null,
                'email' => $row['email'] ?? null,
                'telphone_1' => $row['telphone_1'] ?? null,
                'telphone_2' => $row['telphone_2'] ?? null,
                'bank_id' => $row['bank_id'] ?? null,
                'bank_acc_no' => $row['bank_account_number'] ?? null,
                'remark' => $row['remark'] ?? null,
                'user_id' => auth()->id(),
            ]);
        }


    }
}
