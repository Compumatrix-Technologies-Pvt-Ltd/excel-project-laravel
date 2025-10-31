<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    //

    protected $table = 'subscriptions';

    protected $fillable = ['plan_id', 'user_id','status','paid_amount','subscription_start_date','subscription_exp_date'];
}
