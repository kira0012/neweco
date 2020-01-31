<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContact;

class ChequeRequest extends Model implements AuditableContact
{
    //
    use Auditable;
}
