<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mill extends Model
{
    //
    protected $table = 'mills';

    protected $fillable = ['mill_id', 'name', 'mpob_lic_no'];

}
