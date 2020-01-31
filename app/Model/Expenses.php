<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContact;

class Expenses extends Model implements AuditableContact
{
    //
    use Auditable;

    public function category(){

        return $this->belongsTo(ExpenseCategory::class,'id');
    }
}
