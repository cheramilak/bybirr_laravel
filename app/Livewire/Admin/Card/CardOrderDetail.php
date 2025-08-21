<?php

namespace App\Livewire\Admin\Card;

use App\Models\CardOrder;
use App\Service\CardCreateService;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Component;

class CardOrderDetail extends Component
{
    public $cardOrder;

    public function mount($uuid)
    {
        $this->cardOrder = CardOrder::where('uuid',$uuid)->firstOrFail();
    }

    public function create()
    {
        LivewireAlert::title('Create card')
            ->text('Are you sure you want to create new card?')
            ->question()
            ->withConfirmButton('Yes')
            ->withCancelButton('Cancel')
            ->onConfirm('orderCard', [])
            ->show();
    }

    public function orderCard($data)
    {
       $service = new CardCreateService($this->cardOrder->user_id,$this->cardOrder->transaction->amount);
       $card = $service->createcard();
       if($card)
       {
            $this->cardOrder->status = 'Approve';
            $this->cardOrder->save();
            LivewireAlert::title('Success')
            ->text('Operation completed successfully.')
            ->success()
            ->timer(3000) // Dismisses after 3 seconds
            ->show();
       }

    }
    public function render()
    {
        return view('livewire.admin.card.card-order-detail');
    }
}
