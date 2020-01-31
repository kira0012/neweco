<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContact;

class JobOrder extends Model implements AuditableContact
{
    //
    use Auditable;

    public function job_category(){

        return $this->belongsTo(JoCategory::class,'cat_id');
    }

    public function job_transaction(){

        return $this->hasMany(JoPayment::class,'jo_id');
    }
}
