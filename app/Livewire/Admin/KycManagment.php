<?php

namespace App\Livewire\Admin;

use App\Models\KYC;
use Livewire\Component;

class KycManagment extends Component
{
    public $search;
    public function render()
    {
        $kycs = KYC::whereAny(['fName','lName','email','phone'],'like',$this->search.'%')->latest()->get();
        $data = [
            'kycs' => $kycs
        ];
        return view('livewire.admin.kyc-managment',$data);
    }
}
