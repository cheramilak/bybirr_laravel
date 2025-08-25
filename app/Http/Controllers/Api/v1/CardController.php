<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\CardOrder;
use App\Models\KYC;
use App\Models\TransactionRate;
use App\Models\VirtualCard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;


class CardController extends Controller
{
    public function getCurrentRate()
    {
        $rate = TransactionRate::find(1);
        $banks = Bank::where('status', 1)->get();

        $data = [
            'banks' => $banks,
            'rate' => $rate
        ];

        return $this->success($data);
    }
    public function orderCard(Request $request)
    {
        $validation = Validator::make(
            $request->all(),
            [
                'image' => 'required|image',
                'amount' => 'required|numeric',
                'bankId' => 'required|integer',
                'rate' => 'required|numeric',
                'transactionId' => 'required|string|unique:transactions,transactionId',
            ]
        );

        if ($validation->fails()) {
            return $this->validationError($validation->errors()->first());
        }
        $transaction = new Transaction();
        $transaction->amount = $request->amount;
        $transaction->rate = $request->rate;
        $transaction->image = $request->image->store('transactions', 'public');
        $transaction->transactionId = $request->transactionId;
        $transaction->user_id = Auth::user()->id;
        $transaction->bank_id = $request->bankId;
        $transaction->uuid = Str::uuid();
        $transaction->status = 'Pending';
        $transaction->type = 'Card order';
        $transaction->save();


        $cardOrder = new CardOrder();
        $cardOrder->transaction_id = $transaction->id;
        $cardOrder->user_id = Auth::user()->id;
        $cardOrder->kyc_id = KYC::where('user_id', Auth::user()->id)->first()->id;
        $cardOrder->status = 'Pending';
        $cardOrder->uuid = Str::uuid();
        $cardOrder->save();
        return $this->success(null,);
    }

    public function getCards()
    {
        $cards = VirtualCard::where('user_id', Auth::user()->id)->get();

        $data = [
            'cards' => $cards
        ];
        return $this->success($data);
    }

    public function getCardDetails($cardId)
    {
        $card = VirtualCard::where('cardId', $cardId)->where('user_id', Auth::user()->id)->first();
        if (!$card) {
            return $this->error('Card not found');
        }
        $data = $this->fatchCardDetails($card->cardId);
        if($data['status'] == false){
            return $this->error($data,'Something went wrong, please try again later');
        }
        
        return $this->success($data['data']);
    }

    public function freezCard($cardId)
    {
        $card = VirtualCard::where('cardId', $cardId)->where('user_id', Auth::user()->id)->first();
        if (!$card) {
            return $this->error('Card not found');
        }
        $data = $this->cardFreez($card->cardId);
        if($data['status'] == false){
            return $this->error('Something went wrong, please try again later');
        }
        $card->status = 'frozen';
        $card->save();
        
        return $this->success($data['data']);
    }

    public function unFreezCard($cardId)
    {
        $card = VirtualCard::where('cardId', $cardId)->where('user_id', Auth::user()->id)->first();
        if (!$card) {
            return $this->error('Card not found');
        }
        $data = $this->cardUnFreez($card->cardId);
        if($data['status'] == false){
            return $this->error($data,'Something went wrong, please try again later');
        }
        $card->status = 'active';
        $card->save();
        
        return $this->success($data['data']);
    }





    public function fatchCardDetails($cardId)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . config('bitNob.test.api_secret'),
            'content-type: application/json',
            'accept: application/json'
        ])->get('https://sandboxapi.bitnob.co/api/v1/virtualcards/cards/'.$cardId,);

        if ($response->successful()) {
            $result = $response->json();  // Associative array
            
            return $result;
        } else {
            $data = [
                'status' => false,
            ];
            return $data;
        }
    }

    public function getCardTransactions($cardId)
    {
        $card = VirtualCard::where('cardId', $cardId)->where('user_id', Auth::user()->id)->first();
        if (!$card) {
            return $this->error('Card not found');
        }
        $data = $this->fatchCardTransactions($card->cardId);
        if($data['status'] == false){
            return $this->error('Something went wrong, please try again later');
        }
        return $this->success($data['data']);
    }

    protected function fatchCardTransactions($cardId)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . config('bitNob.test.api_secret'),
            'content-type: application/json',
            'accept: application/json'
        ])->get('https://sandboxapi.bitnob.co/api/v1/virtualcards/cards/'.$cardId.'/transactions',);
        if ($response->successful()) {
            $result = $response->json();  // Associative array
            return $result;
        } else {

           $data = [
                'status' => false,
            ];
            return $data;
        }
    }

    

    protected function cardFreez($cardId)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . config('bitNob.test.api_secret'),
            'content-type: application/json',
            'accept: application/json'
        ])->post('https://sandboxapi.bitnob.co/api/v1/virtualcards/freeze',[
        'cardId' => $cardId
        ]);
        if ($response->successful()) {
            $result = $response->json();  // Associative array
            return $result;
        } else {

           $data = [
                'status' => false,
            ];
            return $data;
        }
    }

    protected function cardUnFreez($cardId)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . config('bitNob.test.api_secret'),
            'content-type: application/json',
            'accept: application/json'
        ])->post('https://sandboxapi.bitnob.co/api/v1/virtualcards/unfreeze',[
        'cardId' => $cardId
        ]);
        if ($response->successful()) {
            $result = $response->json();  // Associative array
            return $result;
        } else {

           $data = [
                'status' => false,
            ];
            return $data;
        }
    }
}
