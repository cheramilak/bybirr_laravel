<?php

namespace App\Http\Controllers;

use App\Models\CardOrder;
use App\Models\CardTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WebhookController extends Controller
{


    public function handleWebhook(Request $request)
    {
        $payload = $request->all();
        $event = $payload['event'] ?? null;

        switch ($event) {
            case 'virtualcard.created.failed':
                $this->handleCardCreationFailed($payload['data']);
                break;
            case 'virtualcard.created.success':
                $this->handleCardCreationSucceeded($payload['data']);
                break;

            case 'virtualcard.topup.success':
                $this->topupCard($payload['data']);
                break;
            case 'virtualcard.withdrawal.success':
                $this->withdrawalCard($payload['data']);
                break;
            case 'virtualcard.withdrawal.failed':
                $this->failedWithdrawalCard($payload['data']);
                break;
            case 'virtualcard.topup.success':
                $this->topupCard($payload['data']);
                break;
            case 'virtualcard.transaction.debit':
                $this->debitCard($payload['data']);
                break;
            case 'virtualcard.transaction.reversed':
                $this->reversedCard($payload['data']);
                break;
            case 'virtualcard.transaction.declined':
                $this->declinedCard($payload['data']);
                break;
            case 'virtualcard.transaction.authorization.failed':
                $this->authorizationFailedCard($payload['data']);
                break;
                // you can handle other events here
        }

        return response()->json(['status' => 'success']);
    }

    protected function handleCardCreationFailed(array $data)
    {
        // Log the error
        Log::error("Virtual Card creation failed", $data);
        Log::info("Virtual Card creation succeeded", $data);

        $ordercard = CardOrder::where('uuid', $data['reference'])->first();
        if ($ordercard) {
            $ordercard->status = 'Failed';
            $ordercard->reason = $data['reason'] ?? 'Unknown reason';
            $ordercard->save();
        }
    }

    protected function handleCardCreationSucceeded(array $data)
    {
        // Log the success
        Log::info("Virtual Card creation succeeded", $data);

        $ordercard = CardOrder::where('uuid', $data['reference'])->first();
        if ($ordercard) {
            $ordercard->status = 'Success';
            $ordercard->cardId = $data['id'];
            $ordercard->save();
        }
    }

    protected function topupCard(array $data)
    {
        $tran = CardTransaction::where('transactionId', $data['id'])->first() ?? new CardTransaction();
        $tran->amount = $data['amount'];
        $tran->status = $data['status'] ?? 'Processing';
        $tran->reference = $data['reference'];
        $tran->cardId = $data['cardId'];
        $tran->companyId = $data['companyId'];
        $tran->narrative = $data['narrative'] ?? null;
        $tran->transactionId = $data['id'] ?? null;
        $tran->reason = 'Top-up card';
        $tran->save();
    }

    protected function debitCard(array $data)
    {
        $tran = CardTransaction::where('transactionId', $data['id'])->first() ?? new CardTransaction();
        $tran->amount = $data['amount'];
        $tran->status = $data['status'] ?? 'Processing';
        $tran->reference = $data['reference'];
        $tran->cardId = $data['cardId'];
        $tran->companyId = $data['companyId'];
        $tran->narrative = $data['narrative'] ?? null;
        $tran->transactionId = $data['id'] ?? null;
        $tran->reason = 'Debit';
        $tran->save();
    }

    protected function withdrawalCard(array $data)
    {
        $tran = CardTransaction::where('transactionId', $data['id'])->first() ?? new CardTransaction();
        $tran->amount = $data['amount'];
        $tran->status = $data['status'] ?? 'Processing';
        $tran->reference = $data['reference'];
        $tran->cardId = $data['cardId'];
        $tran->companyId = $data['companyId'];
        $tran->narrative = $data['narrative'] ?? null;
        $tran->transactionId = $data['id'] ?? null;
        $tran->reason = 'Withdrawal';
        $tran->save();
    }

    protected function failedWithdrawalCard(array $data)
    {
        $tran = CardTransaction::where('transactionId', $data['id'])->first() ?? new CardTransaction();
        $tran->amount = $data['amount'];
        $tran->status = $data['status'] ?? 'Processing';
        $tran->reference = $data['reference'];
        $tran->cardId = $data['cardId'];
        $tran->companyId = $data['companyId'];
        $tran->narrative = $data['narrative'] ?? null;
        $tran->transactionId = $data['id'] ?? null;
        $tran->reason = 'Withdrawal';
        $tran->save();
    }

    protected function reversedCard(array $data)
    {
        $tran = CardTransaction::where('transactionId', $data['id'])->first() ?? new CardTransaction();
        $tran->amount = $data['amount'];
        $tran->status = $data['status'] ?? 'Processing';
        $tran->reference = $data['reference'];
        $tran->cardId = $data['cardId'];
        $tran->companyId = $data['companyId'];
        $tran->narrative = $data['narrative'] ?? null;
        $tran->transactionId = $data['id'] ?? null;
        $tran->reason = 'Reversed';
        $tran->save();
    }

    protected function declinedCard(array $data)
    {
        $tran = CardTransaction::where('transactionId', $data['id'])->first() ?? new CardTransaction();
        $tran->amount = $data['amount'];
        $tran->status = $data['status'] ?? 'Processing';
        $tran->reference = $data['reference'];
        $tran->cardId = $data['cardId'];
        $tran->companyId = $data['companyId'];
        $tran->narrative = $data['narrative'] ?? null;
        $tran->transactionId = $data['id'] ?? null;
        $tran->reason = $data['reason'] ?? null;
        $tran->save();
    }

    protected function authorizationFailedCard(array $data)
    {
        $tran = CardTransaction::where('transactionId', $data['id'])->first() ?? new CardTransaction();
        $tran->amount = $data['amount'];
        $tran->status = $data['status'] ?? 'Processing';
        $tran->reference = $data['reference'];
        $tran->cardId = $data['cardId'];
        $tran->companyId = $data['companyId'];
        $tran->narrative = $data['narrative'] ?? null;
        $tran->transactionId = $data['id'] ?? null;
        $tran->reason = $data['reason'] ?? null;
        $tran->save();
    }
}
