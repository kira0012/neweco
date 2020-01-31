<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CustomerFund extends Model
{
    //

    public function customer(){

        return $this->belongsTo(Customer::class,'id');
    }

  
}
