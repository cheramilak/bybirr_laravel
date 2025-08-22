<?php

namespace App\Livewire\Admin;

use App\Models\KYC;
use Livewire\Component;
use App\Service\KycService;
use Flux\Flux;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

class KycDetail extends Component
{
    public $kyc;
    public function mount($uuid)
    {
        $this->kyc = KYC::where('uuid', $uuid)->firstOrFail();
    }

    public function submitKyc()
    {
        $kycService = new KycService($this->kyc);
        $response = $kycService->addKyc();
        if ($response['status']) {
            $this->kyc->status = 'Approved';
            $this->kyc->customerId = $response['customerId'];
            $this->kyc->reason = null;
            $this->kyc->save();
            LivewireAlert::title('KYC Submission')
                ->text($response['message'])
                ->timer(6000) // Dismisses after 3 seconds
                ->show();
        } else {
            LivewireAlert::title('Error')
                ->text($response['message'])
                ->error()
                ->timer(6000) // Dismisses after 6 seconds
                ->show();
            return;
        }
    }

    public $reason;
    public function rejectKyc()
    {
        $this->validate(
            [
                'reason' => 'required|string|max:255',
            ]
        );

        $this->kyc->status = 'Rejected';
        $this->kyc->reason = $this->reason;
        $this->kyc->save();
        Flux::modal('modal-reject')->close();
        LivewireAlert::title('KYC Rejection')
            ->text('The KYC has been rejected.')
            ->error()
            ->timer(6000) // Dismisses after 6 seconds
            ->show();
    }

    public function render()
    {
        return view('livewire.admin.kyc-detail');
    }
}
