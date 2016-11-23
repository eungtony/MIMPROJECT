<?php

namespace App\Http\Controllers;

use App\Categorie;
use App\Travail;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;

class tacheController extends Controller
{
    public function index($ida, $pid, $id)
    {
        $taches = Travail::findOrFail($id);
        $taches->load('user', 'categorie');
        return view('tache.index', compact('taches'));
    }

    public function addForm($id, $idp){
        $categories = Categorie::all();
        return view('tache.add', compact('id', 'idp', 'categories'));
    }

    public function add(Requests\tacheRequest $request){
        $rq = $request->except('_token');
        $id = $request->only('projet_id');
        $ida = $request->only('agence_id');
        Travail::create($rq);
        return redirect()->route('projet', [$ida['agence_id'], $id['projet_id']]);
    }

    public function editForm($id){
        $taches = Travail::findOrFail($id);
        return view('tache.edit', compact('taches', 'id'));
    }

    public function edit($id,$pid,Request $request){
        $ida = Travail::findOrFail($id)->agence_id;
        $rq = $request->except('_token', 'fait');
        Travail::findOrFail($id)->update($rq);
        if(Input::get('fait') == "0"){
            Travail::findOrFail($id)->update(['fait'=> 1]);
        }else{
            Travail::findOrFail($id)->update(['fait'=> 0]);
        }
        return redirect()->route('projet', [$ida, $pid]);
    }

    public function destroy($id){
        Travail::findOrFail($id)->delete();
        return redirect()->route('home');
    }
}
