<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContact;

class CustomerOrder extends Model implements AuditableContact
{
  use Auditable;


  public function payments(){

    return $this->hasMany(OrderPayment::class,'drno');
  }

  public function customerinfo(){

    return $this->belongsTo(Customer::class,'id');
    //return $this->hasOne(Customer::class,'id');
  }
}
