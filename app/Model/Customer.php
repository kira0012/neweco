<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContact;

class Customer extends Model implements AuditableContact
{
    //
    use Auditable;

    public function myfunds(){
        return $this->hasMany(CustomerFund::class,'customer_id');

    }

    public function ca_transaction(){

        return $this->hasMany(CaTransaction::class,'customer_id');
    }

    public function myorders(){

        return $this->hasMany(CustomerOrders::class,'customer_id');
    }

    
}
