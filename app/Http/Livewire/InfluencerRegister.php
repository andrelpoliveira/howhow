<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Agencia;

class InfluencerRegister extends Component
{


    public function render()
    {
        $agencia = Agencia::get();
        return view('livewire.Influencer.influencer-register', ['agencia'=>$agencia]);
    }
}
