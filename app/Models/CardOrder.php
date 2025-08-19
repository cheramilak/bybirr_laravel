<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CardOrder extends Model
{
    //

    public function kyc(){
        return $this->belongsTo(KYC::class,'kyc_id');
    }

    public function transaction(){
        return $this->belongsTo(Transaction::class,'transaction_id');
    }
}
