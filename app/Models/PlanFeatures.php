<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlanFeatures extends Model
{
    //

    protected $table = 'plan_features';

    protected $fillable = ['plan_id', 'features'];

    public function plan()
    {
        return $this->belongsTo(Plans::class, 'plan_id', 'id');
    }
}
