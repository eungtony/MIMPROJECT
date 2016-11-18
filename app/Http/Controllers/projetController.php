<?php

namespace App\Http\Controllers;

use App\Agence;
use App\Projet;
use App\Travail;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class projetController extends Controller
{
    public function index($id, $ida){
        $projet = Projet::findOrFail($ida);
        $cdp_id = Agence::findOrFail($id)->user_id;
        $taches = Travail::where('projet_id', $ida)->get();
        $taches->load('user');
        $done = Travail::where('projet_id', $ida)->where('fait',1)->get()->count();
        $total = $taches->count();
        $users = User::where('agence_id', $id)->get();
        return view('projet.index', compact('id','ida','cdp_id','projet', 'taches','done', 'total', 'users'));
    }

    public function addForm($id){
        return view('projet.add', compact('id'));
    }

    public function add(Requests\projetRequest $request){
        $rq = $request->except('_token');
        $id = $rq['agence_id'];
        Projet::create($rq);
        return redirect()->route('agence', [$id]);
    }

    public function editForm($id, $idp){
        $projet = Projet::findOrFail($idp);
        return view('projet.edit', compact('projet', 'id', 'idp'));
    }

    public function edit($pid, Request $request){
        $rq = $request->except('_token');
        $agence_id = Projet::findOrFail($pid)->agence_id;
        Projet::findOrFail($pid)->update($rq);
        return redirect()->route('projet', [$agence_id,$pid]);
    }
}
