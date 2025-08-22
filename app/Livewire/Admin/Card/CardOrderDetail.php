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
        $this->cardOrder = CardOrder::where('uuid', $uuid)->firstOrFail();
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

    public function ComplateCard()
    {
        LivewireAlert::title('Create card')
            ->text('Are you sure you want to create?')
            ->question()
            ->withConfirmButton('Yes')
            ->withCancelButton('Cancel')
            ->onConfirm('fatchCard', [])
            ->show();
    }

    public function fatchCard()
    {
        $service = new CardCreateService();
        $res = $service->storeVirtualCard($this->cardOrder);
        if ($res['status']) {
            $this->cardOrder->status = 'Completed';
            $this->cardOrder->reason = null;
            $this->cardOrder->save();
            LivewireAlert::title($res['message'] ?? 'Card created successfully')
                ->info()
                ->timer(6000) // Dismisses after 6 seconds
                ->show();
        } else {
            LivewireAlert::title('Error')
                ->text($res['message'] ?? 'Error creating card')
                ->error()
                ->timer(6000) // Dismisses after 6 seconds
                ->show();
        }
    }

    public function orderCard($data)
    {
        $service = new CardCreateService();
        $res = $service->createCardrequest($this->cardOrder, $this->cardOrder->transaction->amount);
        if ($res['status']) {
            $this->cardOrder->status = 'In Progress';
            $this->cardOrder->reason = null;
            $this->cardOrder->save();
            LivewireAlert::title($res['message'] ?? 'Card created successfully')
                ->info()
                ->timer(6000) // Dismisses after 6 seconds
                ->show();
        } else {
            LivewireAlert::title('Error')
                ->text($res['message'] ?? 'Error creating card')
                ->error()
                ->timer(6000) // Dismisses after 6 seconds
                ->show();
        }
    }
    public function render()
    {
        return view('livewire.admin.card.card-order-detail');
    }
}
