<?php

namespace App\Service;

use App\Models\User;
use Nette\Utils\Random;
use App\Models\VirtualCard;
use Illuminate\Support\Str;

class CardCreateService
{
    /**
     * Create a new class instance.
     */

    public $user,$amount;
    public function __construct($userId,$amount)
    {
        $this->user =  User::where('id',$userId)->first();
        $this->amount = $amount;
    }

    public function createcard()
    {
        $card = VirtualCard::create([
            'user_id' => $this->user->id,
            'card_number' => Random::generate(16,'0-9'),
            'cardholder_name' => $this->user->first_name .' '.$this->user->last_name,
            'expiration_date' => '12/28',
            'cvv' => Random::generate(3,'0-9'),
            'balance' => $this->amount,
            'uuid' => Str::uuid(),
        ]);
        return $card;
    }
}
