<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyInfoModel extends Model
{
    protected $table = 'company_info';
    protected $fillable = ['name', 'address', 'email', 'phone', 'logo', 'registration_no'];

    public function branches(){
        return $this->hasMany(BranchModel::class);
    }

    
}
