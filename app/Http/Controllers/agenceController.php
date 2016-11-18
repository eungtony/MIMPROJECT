<?php

namespace App\Http\Controllers;

use App\Agence;
use App\User;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;

use App\Http\Requests;

class agenceController extends Controller
{

    public function index($id){
        $agence = Agence::findOrFail($id);
        $agence->load('projets');
        $cdp_id = $agence->user_id;
        $cdp = User::findOrFail($cdp_id)->name;
        return view('agence.index', compact('id', 'agence', 'cdp', 'cdp_id'));
    }

    public function editForm($id){
        $agence = Agence::findOrFail($id);
        $users = User::where('agence_id', $id)->get();
        $cdp_id = $agence->user_id;
        return view('agence.edit', compact('id', 'agence', 'users', 'cdp_id'));
    }

    public function edit($id, Request $request){
        $rq = $request->except('_token');
        Agence::findOrFail($id)->update($rq);
        return redirect()->route('agence', [$id]);
    }
}
