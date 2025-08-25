<?php

namespace App\Service;

use App\Models\User;
use Nette\Utils\Random;
use App\Models\VirtualCard;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;

class CardCreateService
{
    /**
     * Create a new class instance.
     */

    public $user, $amount;
    public function __construct()
    {
        // $this->user =  User::where('id',$userId)->first();
        // $this->amount = $amount;
    }

    public function createcard($user, $amount)
    {
        $card = VirtualCard::create([
            'user_id' => $user->id,
            'card_number' => Random::generate(16, '0-9'),
            'cardholder_name' => $user->first_name . ' ' . $user->last_name,
            'expiration_date' => '12/28',
            'cvv' => Random::generate(3, '0-9'),
            'balance' => $amount,
            'uuid' => Str::uuid(),
        ]);
        return $card;
    }

    public function createCardrequest($cardOrder, $amount)
    {
        $key = config('bitNob.test.api_secret');
        $kyc = $cardOrder->kyc;
        $data = [
            "customerEmail" => $kyc->email,
            "cardType" => 'VIRTUAL',
            "cardBrand" => "Visa Card",
            "firstName" => $kyc->fName,
            "lastName" => $kyc->lName,
            "reference" => $cardOrder->uuid,
            "amount" => $amount * 100,
        ];

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $key,
            'content-type: application/json',
            'accept: application/json'
        ])->post('https://sandboxapi.bitnob.co/api/v1/virtualcards/create', $data);

        if ($response->successful()) {
            $result = $response->json();  // Associative array
            $data = [
                'status' => true,
                'message' => $result['message'] ?? 'Unknown error occurred'
            ];
            return $data;
        } else {
            $result = $response->json();    // Raw response body for debugging
            $data = [
                'status' => false,
                'message' => $result['message'] ?? 'Unknown error occurred'
            ];
            return $data;
        }
    }

    function storeVirtualCard()
    {
        $key = config('bitNob.test.api_secret');
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $key,
            'content-type: application/json',
            'accept: application/json'
        ])->get('https://sandboxapi.bitnob.co/api/v1/virtualcards/cards/5a1e8f3a-686b-44bf-8452-d92640e172bc');

        if ($response->successful()) {
            $result = $response->json();  // Associative array


            $data = $result['data'];

            VirtualCard::create([
                'user_id'        => 1,
                'card_number'    => $data['cardNumber'],
                'cardholder_name' => $data['cardName'],
                'valid'          => $data['valid'], // already in MM/YYYY
                'cvv'            => $data['cvv2'],
                'balance'        => $data['balance'],
                'status'         => $data['status'],
                'expiry_date'    => \Carbon\Carbon::parse($data['expiry'])->toDateString(),
                'cardUserId'     => $data['cardUserId'],
                'customerId'     => $data['customerId'],
                'cardId'         => $data['id'],
                'billing_address' => json_encode($data['billingAddress']),
                'last4'          => $data['last4'],
                'uuid'           => $data['reference'], // using reference as unique identifier
            ]);

            $data = [
                'status' => true,
                'message' => $result['message'] ?? 'Unknown error occurred'
            ];
            return $data;
        } else {
            $result = $response->json();    // Raw response body for debugging
            $data = [
                'status' => false,
                'message' => $result['message'] ?? 'Unknown error occurred'
            ];
            return $data;
        }
    }
}
