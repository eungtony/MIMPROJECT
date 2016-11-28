<?php

namespace App\Http\Controllers;

use App\Agence;
use App\Poste;
use App\Statut;
use Illuminate\Contracts\Auth\Guard;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class userController extends Controller
{
    protected $auth;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->middleware('auth');
        $this->auth = $auth;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = $this->auth->user()->id;
        $user = User::findOrFail($id);
        $user->load('agence', 'poste', 'statut');
        return view('user.index', compact('user'));
    }

    public function user($id)
    {
        $user = User::findOrFail($id);
        $user->load('statut', 'poste', 'agence');
        return view('user.profile', compact('user'));
    }

    public function editForm($id)
    {
        $user = User::findOrFail($id);
        $postes = Poste::all();
        $statuts = Statut::all();
        $agences = Agence::all();
        return view('user.edit', compact('user', 'postes', 'statuts', 'agences'));
    }

    public function edit($id, Request $request)
    {
        $user = User::findOrFail($id);
        $rq = $request->except('_token', 'password', 'new_password');
        $apw = $request->new_password;
        $cpw = bcrypt($apw);
        User::findOrFail($id)->update(['password' => $cpw]);
        User::findOrFail($id)->update($rq);
        return redirect()->route('profile', $id)->with('success', 'Le profil a été modifié avec succès !');
    }

}
