<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    //

    public function bank()
    {
        return $this->belongsTo(Bank::class,'bank_id');
    }
}
