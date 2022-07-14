<?php

namespace App\Http\Livewire;

use Livewire\Component;

use Illuminate\Support\Facades\Hash;
use App\Actions\Fortify\PasswordValidationRules;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;

use App\Models\{
    Agencia,
    User,
    Marca,
    Campanhas
};

class DashboardAdmin extends Component
{
    public function render()
    {
        $campanha = Campanhas::with('marca')->get();
        $influencer = User::get();
        $agencia = Agencia::get();
        $marca = Marca::get();
        return view('livewire.Admin.dashboard-admin',
        [
            'influencer'=> $influencer,
            'agencia'=> $agencia,
            'marca'=> $marca,
            'campanha'=> $campanha
        ]);
    }

    public function createMarca(Request $request)
    {
        $request->validate([
            'cnpj'=> ['required', 'string', 'max:15'],
            'corporativename'=> ['required', 'string'],
            'brandname'=> ['required', 'string'],
            'branch'=> ['required', 'string', 'max:255'],
            'name'=> ['required', 'string', 'max:255'],
            'email'=> ['required', 'string'],
            'phone'=> ['required', 'string'],
            'password'=>$this->passwordRules(),
            'layout'=>[],
            'language'=>[],
        ]);

        $marca= Marca::create([
            'cnpj'=> $request->cnpj,
            'corporativename'=> $request->corporativename,
            'brandname'=> $request->brandname,
            'branch'=> $request->branch,
            'name'=> $request->name,
            'email'=> $request->email,
            'phone'=> $request->phone,
            'password'=> Hash::make($request->password),
            'layout'=> $request->layout,
            'language'=> $request->language,
        ]);
        event(new Registered($marca));
    } 

    public function createAgencia(Request $request)
    {
        $request->validate([
            'cnpj'=> ['required', 'string', 'max:15'],
            'corporativename'=> ['required', 'string'],
            'fantasyname'=> ['required', 'string'],
            'branch'=> ['required', 'string'],
            'name'=> ['required', 'string'],
            'email'=> ['required', 'string'],
            'phone'=> ['required', 'string'],
            'password'=> $this->passwordRules(),
            'layout'=> [],
            'language'=> [],
        ]);
        $agencia = Agencia::create([
            'cnpj'=> $request->cnpj,
            'corporativename'=> $request->corporativename,
            'fantasyname'=> $request->fantasyname,
            'branch'=> $request->branch,
            'name'=> $request->name,
            'email'=> $request->email,
            'phone'=> $request->phone,
            'password'=> Hash::make($request->password),
            'layout'=> $request->layout,
            'language'=> $request->language,
        ]);
        event(new Registered($agencia));
    }

    public function createInfluencer(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'birthdate'=> ['required', 'date'],
            'phone'=> ['required', 'string', 'max:15'],
            'genre'=> ['required', 'string'],
            'name'=> ['required', 'string', 'max:255'],
            'name_artistic'=> ['required', 'string', 'max:255'],
            'layout'=> [],
            'language'=> [],
            'agency'=> [],
            'instagram'=> [],
            'twitter'=> [],
            'tiktok'=> [],
            'kwai'=> [],
            'twitch'=> [],
            'facebook'=> [],
            'youtube'=> [],
            'nimo'=> [],
            'trovo'=> [],
        ]);
        $user = User::create([
            'email'=> $request->email,
            'password'=> Hash::make($request->password),
            'birthdate'=> $request->birthdate,
            'phone'=> $request->phone,
            'genre'=> $request->genre,
            'name'=> $request->nameinfluencer,
            'name_artistic'=> $request->nameartistic,
            'layout'=> $request->layout,
            'language'=> $request->language,
            'agency'=> $request->agency,
            'instagram'=>$request->instagram,
            'twitter'=> $request->twitter,
            'tiktok'=> $request->tiktok,
            'kwai'=> $request->kwai,
            'twitch'=> $request->twitch,
            'facebook'=> $request->facebook,
            'youtube'=> $request->youtube,
            'nimo'=> $request->nimo,
            'trovo'=> $request->trovo
        ]);
        event(new Registered($user));
    }
}
