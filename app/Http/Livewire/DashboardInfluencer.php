<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\{
    User,
    Agencia,
    Campanhas
};
use Faker\Provider\Base;
use Illuminate\Support\Facades\Auth;
use Livewire\Livewire;
use Symfony\Contracts\Service\Attribute\Required;

class DashboardInfluencer extends Component
{


        /* Main function */
    public function render()
    {
        $agencia = Agencia::get();
        $campanha = Campanhas::get();

        /* Search method */
        $search = request('search');

        if($search)
        {
            $influencers = User::where([
                ['name', 'like', '%'.$search.'%']
            ])->get();
        }
        else{
            $influencers = User::get();
        }

        return view('livewire.Influencer.dashboard-influencer', [

            'influencers'=>$influencers,
            'search'=>$search,
            'agencia'=>$agencia,
            'campanha'=>$campanha
        ]);
    }

}
