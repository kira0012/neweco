<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContact;

class JoPayment extends Model implements AuditableContact
{
    //
    use Auditable;

    public function jo_deposit(){

        return $this->belongsTo(BankAccount::class,'bank_id');
    }

    public function job_order(){

        return $this->belongsTo(JoOrder::class,'jo_id');
    }
}
