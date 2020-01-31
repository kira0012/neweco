<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContact;

class OrderPayment extends Model implements AuditableContact
{
    //
    use Auditable;

    public function order(){

        return $this->belongsTo(CustomerOrder::class,'id');
    }

    public function depositTobank(){

        return $this->belongsTo(BankAccount::class,'bank_id');
    }

    
}
