<?php

namespace App\Livewire\Admin;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AdminPanel extends Component
{
    public function render()
    {
        $user=Auth::user();
        return view('livewire.admin.admin-panel',compact('user'));
    }
}
