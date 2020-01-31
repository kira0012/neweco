<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContact;

class BankTransaction extends Model implements AuditableContact
{
    //

// use OwenIt\Auditing\Auditable;
// use OwenIt\Auditing\Contracts\Auditable as AuditableContact;
// implements AuditableContact
// use Auditable;
use Auditable;

        public function bankaccount(){

            return $this->belongsTo(BankAccount::class);
        }
}
