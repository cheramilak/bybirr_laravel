<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CardOrder;
use App\Models\KYC;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CardController extends Controller
{
    public function orderCard(Request $request)
    {
        $validation = Validator::make($request->all(),
        [
            'image' => 'required|image',
            'amount' => 'required|numeric',
            'bankId' => 'required|integer',
            'transactionId' => 'required|string',
        ]);

        if($validation->fails())
        {
            return $this->validationError($validation->error()->first());
        }
        $transaction = new Transaction();
        $transaction->amount = $request->amount;
        $transaction->rate = 125;
        $transaction->image = $request->image->store('transactions','public');
        $transaction->transactionId = $request->transactionId;
        $transaction->user_id = Auth::user()->id;
        $transaction->bank_id = $request->bankId;
        $transaction->uuid = Str::uuid();
        $transaction->status = 'Pending';
        $transaction->save();

        $cardOrder = new CardOrder();
        $cardOrder->transaction_id = $transaction->id;
        $cardOrder->user_id = Auth::user()->id;
        $cardOrder->kyc_id = KYC::where('user_id',Auth::user()->id)->first();
        $cardOrder->status = 'Pending';
        $cardOrder->uuid = Str::uuid();
        $cardOrder->save();

        return $this->success(null,);
    }
}
