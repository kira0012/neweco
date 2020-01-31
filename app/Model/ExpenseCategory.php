<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContact;

class ExpenseCategory extends Model implements AuditableContact
{
    //
    // use OwenIt\Auditing\Auditable;
// use OwenIt\Auditing\Contracts\Auditable as AuditableContact;
// 
 use Auditable;

    public function transactions()
    {

        return $this->hasMany(Expenses::class,'expense_id');
    }
}
