<?php

namespace App\Http\Controllers;

use App\Agence;
use App\Etape;
use App\Http\Requests;
use App\Travail;
use App\User;
use Carbon\Carbon;
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
        $now = Carbon::now();
        $total_etape = Etape::all()->count();
        if($this->auth->user()->statut_id == 3 || $this->auth->user()->statut_id == 4){
            $taches = Travail::where('user_id', $this->auth->user()->id)->where('fait', 0)->get();
            $taches->load('projet', 'user', 'categorie');
            $agence_id = $this->auth->user()->agence_id;
            $agence = Agence::findOrFail($agence_id);
            $agence->load('file', 'users');
            $cdp_id = $agence->user_id;
            $cdp = User::findOrFail($cdp_id)->name;
            return view('home', compact('id', 'agence', 'cdp', 'cdp_id', 'taches', 'now', 'total_etape'));
        }
        $agences = Agence::all();
        $taches = Travail::where('user_id', $this->auth->user()->id)->where('fait', 0)->get();
        $taches->load('projet', 'file');
        return view('welcome', compact('agences', 'taches', 'now', 'total_etape'));
    }
}
