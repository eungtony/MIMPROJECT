<?php

namespace App\Http\Controllers;

use App\Agence;
use App\Categorie;
use App\Etape;
use App\Http\Requests;
use App\Message;
use App\Projet;
use App\Travail;
use App\Tresorerie;
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
        $taches = Travail::where('user_id', $this->auth->user()->id)->where('fait', 0)->get();
        $taches->load('projet', 'user', 'categorie');
        if($this->auth->user()->statut_id == 3 || $this->auth->user()->statut_id == 4){
            $agence_id = $this->auth->user()->agence_id;
            $agence = Agence::findOrFail($agence_id);
            $agence->load('file', 'users');
            $cdp_id = $agence->user_id;
            $cdp = User::findOrFail($cdp_id)->name;
            $users = User::where('statut_id', 3)->get();
            $etapes = Etape::all();
            $categories = Categorie::all();
            $messages = Message::where('agence_id', $agence_id)->get();
            $projets = Projet::where('agence_id', $agence_id)->get();
            $bankable = 0;
            foreach ($projets as $projet) {
                $bankable = $bankable + $projet->encaisse;
            }
            return view('home', compact('id', 'bankable', 'messages', 'projets', 'agence', 'etapes', 'categories', 'cdp', 'cdp_id', 'taches', 'now', 'total_etape', 'users'));
        }
        $agences = Agence::all();
        $agences->load('projets', 'users');
        $facturable = 0;
        $encaisse = 0;
        $nb_projet = Projet::where('etape_id', '>', '0')->count();
        foreach ($agences as $agence) {
            foreach ($agence->projets as $projet) {
                $facturable = $facturable + $projet->facturable;
                $encaisse = $encaisse + $projet->encaisse;
            }
        }
        $tasks = Travail::where('fait', 1)->take(5)->get();
        $tasks->load('categorie', 'projet');
        $tresorerie = Tresorerie::all()->take(5);
        $tresoreries = Tresorerie::all();
        $total_tres = 0;
        foreach ($tresoreries as $tresorery) {
            $total_tres = $total_tres + $tresorery->montant;
        }
        return view('welcome', compact('agences', 'tasks', 'total_tres', 'tresorerie', 'taches', 'now', 'total_etape', 'facturable', 'encaisse', 'nb_projet'));
    }

    /**
     * Remove or add money into the tresorery
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addOrRemoveMoney(Request $request)
    {
        $rq = $request->except('_token');
        Tresorerie::create($rq);
        return redirect()->route('home')->with('success', 'La trésorerie a bien été modifiée !');
    }

    /**
     * View of the livret de compte
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function livret()
    {
        if ($this->auth->user()->statut_id != 1 || $this->auth->user()->statut_id != 2) {
            return redirect()->route('home')->with('error', 'Vous n\'avez pas le droite d\'accéder à cette page !');
        }
        $livrets = Tresorerie::orderBy('id', 'desc')->paginate(10);
        return view('tresorerie.livret', compact('livrets'));
    }

    /**
     * Method to edit an amount
     *
     * @param $id
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function editMontant($id, Request $request)
    {
        $rq = $request->except('_token');
        Tresorerie::findOrFail($id)->update($rq);
        return back()->with('success', 'Le montant a bien été modifié !');
    }

    /**
     * Method to delete an amount
     *
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteMontant($id)
    {
        Tresorerie::destroy($id);
        return back()->with('success', 'Le montant a bien été supprimé !');
    }
}
