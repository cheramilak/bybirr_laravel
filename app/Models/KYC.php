<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KYC extends Model
{
    protected $fillable = [
        'fName',
        'lName',
        'country',
        'idType',
        'idNumber',
        'phone',
        'city',
        'address',
        'zipCode',
        'line1',
        'houseNumber',
        'photo',
        'idFront',
        'idBack',
        'email',
        'bod',
        'status',
        'user_id',
        'reason',
        'uuid',
        'customerId'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
