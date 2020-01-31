<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContact;

class CaTransaction extends Model implements AuditableContact
{
    //
    use Auditable;

    public function transaction_customer(){

        return $this->belongsTo(Customer::class,'id');
    }
}
