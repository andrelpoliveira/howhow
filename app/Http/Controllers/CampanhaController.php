<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use App\Models\User;
use App\Models\Campanhas;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CampanhaController extends Controller
{
    public function insertform(){

        return view('livewire.Marca.marca-campanha');
    }

    public function render()
    {
        $marca = Marca::get();
        $influencer = User::get();
        $campanha = Campanhas::get();

        return view('livewire.Marca.dashboard-marca',[
            'marca'=>$marca,
            'influencer'=>$influencer,
            'campanha' => $campanha
        ]);
    }

    public function insert(Request $request) {
        $campaign_name = $request->input('campaign_name');
        $start_date = $request->input('start_date');
        $finish_date = $request->input('finish_date');
        $type = $request->input('type');
        $funds = $request->input('funds');
        $content = $request->input('content');
        $filter_category = $request->input('filter_category');
        $filter_engagement = $request->input('filter_engagement');
        $marca_id = Auth::user()->id;

        $data = array(
            "campaign_name" => $campaign_name,
            "start_date" => $start_date,
            "finish_date" => $finish_date,
            "type" => $type,
            "funds" => $funds,
            "content" => $content,
            "filter_category" => $filter_category,
            "filter_engagement" => $filter_engagement,
            "marca_id"=> $marca_id
        );

        DB::table('campanhas')->insert($data);
        return redirect()->route('marca.dashboard');
    }

}
