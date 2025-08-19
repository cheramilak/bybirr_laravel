<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UserManagment extends Component
{
    use WithPagination;
    public $search;
    public function render()
    {
        $users = User::whereAny(['first_name','last_name','email'],'like',$this->search.'%')->where('type','User')->get();
        $data = [
            'users' => $users
        ];
        return view('livewire.admin.user-managment',$data);
    }
}
