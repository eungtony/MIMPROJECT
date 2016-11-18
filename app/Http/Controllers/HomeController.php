<?php

namespace App\Http\Controllers;

use App\Agence;
use App\Http\Requests;
use App\Travail;
use App\User;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
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
        if($this->auth->user()->statut_id == 3 || $this->auth->user()->statut_id == 4){
            $taches = Travail::where('user_id', $this->auth->user()->id)->where('fait', 0)->get();
            $taches->load('projet');
            $agence_id = $this->auth->user()->agence_id;
            $agence = Agence::findOrFail($agence_id);
            $agence->load('projets');
            $cdp_id = $agence->user_id;
            $cdp = User::findOrFail($cdp_id)->name;
            return view('home', compact('id', 'agence', 'cdp', 'cdp_id', 'taches'));
        }
        $agences = Agence::all();
        $agences->load('projets');
        $taches = Travail::where('user_id', $this->auth->user()->id)->where('fait', 0)->get();
        $taches->load('projet');
        return view('welcome', compact('agences', 'taches'));
    }
}
