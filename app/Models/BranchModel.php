<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BranchModel extends Model
{
    //
    protected $table = 'company_branches';

    protected $fillable = ['company_id', 'name', 'code', 'phone', 'address'];

}
