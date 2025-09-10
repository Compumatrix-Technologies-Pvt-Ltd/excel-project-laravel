<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{

    public function supplier(){
        return $this->belongsTo(Suppliers::class,'supplier_id');
    }
    public function vehicle(){
        return $this->belongsTo(Vehicle::class,'vehicle_id');
    }
    public function mill(){
        return $this->belongsTo(Mill::class,'mill_id');
    }
    
}
