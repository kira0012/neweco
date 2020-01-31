<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContact;

class BankAccount extends Model implements AuditableContact
{
    //
    use Auditable;

    public function banktransaction()
    {
        return $this->hasMany(BankTransaction::class,'bank_id');
    }

    public function payment_deposit(){

        return $this->hasMany(OrderPayment::class,'bank_id');
    }

    public function jopayment_deposit(){

        return $this->hasMany(OrderPayment::class,'bank_id');
    }


}
