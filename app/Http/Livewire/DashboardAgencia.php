<?php

namespace App\Http\Livewire;

use App\Models\Agencia;
use Livewire\Component;
use App\Models\User;


class DashboardAgencia extends Component
{
    public function render()
    {
        $influencer = User::get();
        $agencia = User::get();

        return view('livewire.Agencia.dashboard-agencia',
        [
            'influencer'=>$influencer,
            'agencia'=>$agencia,
        ]);
    }
}
