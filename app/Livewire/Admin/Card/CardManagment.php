<?php

namespace App\Livewire\Admin\Card;

use App\Models\VirtualCard;
use Livewire\Component;

class CardManagment extends Component
{
    public function render()
    {
        $cards = VirtualCard::latest()->get();
        $data = [
            'cards' => $cards
        ];
        return view('livewire.admin.card.card-managment',$data);
    }
}
