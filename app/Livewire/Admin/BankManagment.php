<?php

namespace App\Livewire\Admin;

use Flux\Flux;
use App\Models\Bank;
use Livewire\Component;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class BankManagment extends Component
{
    use WithFileUploads;
    public $code,$name,$image,$number,$status = true,$accountName;

    public $bank;
    public $search;
    protected function rules()
    {
        return [
            'name' => 'required|string',
            'code' => 'required|string',
            'number' => 'required|string',
            'accountName' => 'required|string',
            'status' => 'required|boolean',
            'image' => $this->bank ? 'nullable|image' : 'required|image'
        ];
    }

    public function submit()
    {
        $this->validate();

        $bank = $this->bank ?? new Bank();
        $bank->code = $this->code;
        $bank->name = $this->name;
        $bank->number = $this->number;
        $bank->status = $this->status;
        $bank->accountName = $this->accountName;
        if($this->image)
        {
            $bank->image = $this->image->store('banks','public');
        }
        if(!$this->bank)
        {
            $bank->uuid = Str::uuid();
        }
        $bank->save();
        $this->closeModal();
        LivewireAlert::title('Changes saved!')
        ->success()
        ->show();
    }

    public function edit($id)
    {
        $bank = Bank::findOrFail($id);
        $this->name = $bank->name;
        $this->code = $bank->code;
        $this->status = $bank->status == 1 ? true : false;
        $this->number = $bank->number;
        $this->accountName = $bank->accountName;
        $this->bank = $bank;
        $this->openModal();
    }


    public function openModal()
    {
         Flux::modal('modal-form')->show();
    }
    public function closeModal()
    {
        $this->reset();
         Flux::modal('modal-form')->close();
    }
    public function render()
    {
        $banks = Bank::whereAny(['name','code','number','accountName'],'like',$this->search.'%')->get();
        $data = [
            'banks' => $banks
        ];
        return view('livewire.admin.bank-managment',$data);
    }
}
