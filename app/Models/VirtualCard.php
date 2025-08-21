<?php

namespace App\Models;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\Model;

class VirtualCard extends Model
{
    protected $fillable = [
        'user_id',
        'card_number',
        'cardholder_name',
        'expiration_date',
        'cvv',
        'balance',
        'uuid',
        'status',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Encrypt card_number
    public function setCardNumberAttribute($value)
    {
        $this->attributes['card_number'] = Crypt::encryptString($value);
    }

    public function getCardNumberAttribute($value)
    {
        return Crypt::decryptString($value);
    }

    // Encrypt CVV
    public function setCvvAttribute($value)
    {
        $this->attributes['cvv'] = Crypt::encryptString($value);
    }

    public function getCvvAttribute($value)
    {
        return Crypt::decryptString($value);
    }

    public function getMaskedCardNumberAttribute()
    {
        try {
            $number = $this->card_number; // automatically decrypted
            return str_repeat('**** ', 3) . substr($number, -4);
        } catch (\Exception $e) {
            return '**** **** **** ****'; // fallback
        }
    }

    public function getMaskedCvvAttribute()
    {
        return str_repeat('*', strlen($this->cvv));
    }
}
