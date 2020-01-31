<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContact;

class JoCategory extends Model implements AuditableContact
{
    //
    use Auditable;

    public function job_orders(){

        return $this->hasMany(JobOrder::class,'cat_id');
    }
}
