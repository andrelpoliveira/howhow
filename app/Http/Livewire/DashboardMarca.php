<?php

namespace App\Http\Livewire;

use App\Models\Marca;
use App\Models\User;
use App\Models\Campanhas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class DashboardMarca extends Component
{

    public function render()
    {
        $marca = Marca::get();
        $influencer = User::get();
        $campanha = Campanhas::all();

        return view('livewire.Marca.dashboard-marca',[
            'marca'=>$marca,
            'influencer'=>$influencer,
            'campanha' => $campanha
        ]);
    }
}
