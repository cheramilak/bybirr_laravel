<?php

namespace App\Livewire\Admin\Card;

use App\Models\CardOrder;
use Livewire\Component;

class CardOrderDetail extends Component
{
    public $cardOrder;

    public function mount($uuid)
    {
        $this->cardOrder = CardOrder::where('uuid',$uuid)->firstOrFail();
    }
    public function render()
    {
        return view('livewire.admin.card.card-order-detail');
    }
}
