<?php

namespace App\Livewire\Admin\Card;

use App\Models\CardOrder;
use Livewire\Component;

class CardOrderManagment extends Component
{
    public function render()
    {
        $cardOrders = CardOrder::latest()->get();

        $data = [
            'cardOrders' => $cardOrders
        ];

        return view('livewire.admin.card.card-order-managment',$data);
    }
}
