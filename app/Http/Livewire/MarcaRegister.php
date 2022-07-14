<?php

namespace App\Http\Livewire;

use App\Models\Marca;
use Livewire\Component;

class MarcaRegister extends Component
{
    public function render()
    {
        $marca = Marca::get();
        return view('livewire.Marca.marca-register', [
            'marca'=>$marca,
        ]);
    }
}
