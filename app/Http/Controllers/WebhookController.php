<?php

namespace App\Http\Controllers;

use App\Models\CardOrder;
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
}
