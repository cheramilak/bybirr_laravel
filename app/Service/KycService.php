<?php

namespace App\Service;

use Illuminate\Support\Facades\Http;

class KycService
{
    /**
     * Create a new class instance.
     */
    protected $kyc;
    protected $key;
    public function __construct($kyc)
    {
        $this->kyc = $kyc;
        $this->key = config('bitNob.test.api_secret');
    }

    public  function addKyc()
    {
        $data = [
            "customerEmail" => $this->kyc->email,
            "idNumber" => $this->kyc->idNumber,
            "idType" => $this->kyc->idType,
            "firstName" => $this->kyc->fName,
            "lastName" => $this->kyc->lName,
            "phoneNumber" => $this->kyc->phone,
            "city" => $this->kyc->city,
            "state" => $this->kyc->state,
            "country" => $this->kyc->country,
            "zipCode" => $this->kyc->zipCode,
            "line1" => $this->kyc->line1,
            "houseName" => $this->kyc->houseName,
            "idImage" => $this->kyc->idFront,
            "userPhoto" => $this->kyc->photo,
            "dateOfBirth" => $this->kyc->bod
        ];

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->key,
            'content-type: application/json',
            'accept: application/json'
        ])->post('https://sandboxapi.bitnob.co/api/v1/virtualcards/registercarduser', $data);
        if ($response->successful()) {
            $result = $response->json();  // Associative array
            // return $result['data'];    // Or whatever key you're looking for
            $data = [
                'status' => true,
                'customerId' => $result['data']['customerId'] ?? null,
                'message' => $result['message'] ?? null
            ];
            return $data;
        } else {
            // Handle error response
            $data = [
                'status' => false,
                'message' => $response->json()['message'] ?? 'Unknown error occurred'
            ];
            return $data;
        }
        // return $response;
    }
}
