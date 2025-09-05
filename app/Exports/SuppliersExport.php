<?php

namespace App\Exports;

use App\Models\Suppliers;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\Auth;

class SuppliersExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        $user = Auth::user();

        if ($user->role === 'hq') {
            return Suppliers::select(
                'supplier_id',
                'supplier_name',
                'address1',
                'address2',
                'telphone_1',
                'telphone_2',
                'email',
                'bank_id',
                'bank_acc_no',
                'user_id'
            )->where('user_id', $user->id)->get();
        } else {
            return Suppliers::select(
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
                'user_id'
            )->where('user_id', $user->id)->get();
        }
    }

    public function headings(): array
    {
        $user = Auth::user();

        if ($user->role === 'hq') {
            return [
                'Supplier ID',
                'Supplier Name',
                'Address 1',
                'Address 2',
                'Telephone 1',
                'Telephone 2',
                'Email',
                'Bank ID',
                'Bank Account No',
                'User ID',
            ];
        } else {
            return [
                'Supplier ID',
                'Supplier Type',
                'Supplier Name',
                'Address 1',
                'Address 2',
                'MPOB Lic No',
                'MPOB Exp Date',
                'MSPO Cert No',
                'MSPO Exp Date',
                'TIN',
                'Subsidy Rate',
                'Land Size',
                'Latitude',
                'Longitude',
                'Email',
                'Telephone 1',
                'Telephone 2',
                'Bank ID',
                'Bank Account No',
                'Remark',
                'User ID',
            ];
        }
    }
}
