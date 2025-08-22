<?php

namespace App\Service;

use Illuminate\Support\Facades\DB;

class CardTransaction
{
    /**
     * Create a new class instance.
     */
    protected $cardTransaction;
    public function __construct($cardTransaction)
    {
        $this->cardTransaction = $cardTransaction;
    }

    public function logTransaction()
    {
        $data = [
            'amount' => $this->cardTransaction['amount'],
            'currency' => $this->cardTransaction['currency'],
            'status' => $this->cardTransaction['status'],
            'reference' => $this->cardTransaction['reference'],
            'cardId' => $this->cardTransaction['cardId'],
            'companyId' => $this->cardTransaction['companyId'],
            'narrative' => $this->cardTransaction['narrative'] ?? null,
            'transactionId' => $this->cardTransaction['transactionId'] ?? null,
            'reason' => $this->cardTransaction['reason'] ?? null,
        ];

        DB::table('card_transactions')->insert($data);
        return true;
    }
}
