<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContact;

class CustomerProduct extends Model implements AuditableContact
{
    //


// implements AuditableContact
 use Auditable;
    
}
