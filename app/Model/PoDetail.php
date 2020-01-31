<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContact;

class PoDetail extends Model implements AuditableContact
{
    //
    use Auditable;

    public function purchase_payments(){

        return $this->hasMany(PoPayment::class,'po_id');
    }
}
