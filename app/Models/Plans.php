<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plans extends Model
{
    //

    protected $table = 'plans';

    protected $fillable = ['plan_name', 'plan_sub_title', 'plan_price', 'status'];

    public function features()
    {
        return $this->hasMany(PlanFeatures::class, 'plan_id', 'id');
    }

}
