<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContact;

class PoPayment extends Model implements AuditableContact
{
    //
    use Auditable;

    public function purchase_order(){

        return $this->belongsTo(PoDetail::class,'id');
    }
}
