<?php

namespace App\Livewire\Admin;

use App\Models\KYC;
use Livewire\Component;

class KycDetail extends Component
{
    public $kyc;
    public function mount($uuid)
    {
        $this->kyc = KYC::where('uuid',$uuid)->firstOrFail();
    }
    public function render()
    {
        return view('livewire.admin.kyc-detail');
    }
}
