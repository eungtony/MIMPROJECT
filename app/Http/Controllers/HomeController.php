<?php

namespace App\Http\Controllers;

use App\Agence;
use App\Categorie;
use App\Devis;
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
    public function index(Request $request)
    {
        // On recupère la date d'ajourd'hui
        $now = Carbon::now();
        //
        $total_etape = Etape::all()->count();
        //
        $taches = Travail::where('user_id', $this->auth->user()->id)->get();

        if ($request->only('sort')['sort'] == 'date') {
            //
            $taches = Travail::where('user_id', $this->auth->user()->id)->orderBy('date', 'asc')->get();

        } elseif ($request->only('sort')['sort'] == 'category') {
            //
            $taches = Travail::where('user_id', $this->auth->user()->id)->orderBy('categorie_id', 'asc')->get();

        } elseif ($request->only('sort')['sort'] == 'done') {
            //
            $taches = Travail::where('user_id', $this->auth->user()->id)->orderBy('fait', 'desc')->get();
        }

        //
        $taches->load('projet', 'user', 'categorie');

        // Si l'utilisateur est de status 3 (...)
        if($this->auth->user()->statut_id == 3 || $this->auth->user()->statut_id == 4){
            //
            $agence_id = $this->auth->user()->agence_id;
            //
            $agence = Agence::findOrFail($agence_id);
            //
            $agence->load('file', 'users');
            //
            $cdp_id = $agence->user_id;
            //
            $cdp = User::findOrFail($cdp_id)->name;
            //
            $users = User::where('statut_id', 3)->get();
            //
            $etapes = Etape::all();
            //
            $categories = Categorie::all();
            //
            $messages = Message::where('agence_id', $agence_id)->get();
            //
            $projets = Projet::where('agence_id', $agence_id)->get();
            //
            $bankable = 0;

            foreach ($projets as $projet) {
                //
                $bankable = $bankable + $projet->encaisse;
            }

            //
            if (Auth::user()->version_used == 2) {
                //
                return view('layouts.version-2.dashboard', compact(
                    'id', 
                    'bankable', 
                    'messages', 
                    'projets', 
                    'agence', 
                    'etapes', 
                    'categories', 
                    'cdp', 
                    'cdp_id', 
                    'taches', 
                    'now', 
                    'total_etape', 
                    'users'
                ));
            } else {
                // On retourne la vue V1 avec tout les paramètres
                return view('home', compact(
                    'id', 
                    'bankable', 
                    'messages', 
                    'projets', 
                    'agence', 
                    'etapes', 
                    'categories', 
                    'cdp', 
                    'cdp_id', 
                    'taches', 
                    'now', 
                    'total_etape', 
                    'users'
                ));
            }
        }

        //
        $agences = Agence::all();
        //
        $agences->load('projets', 'users');
        //
        $facturable = 0;
        //
        $encaisse = 0;
        //
        $nb_projet = Projet::where('etape_id', '>', '0')->count();

        foreach ($agences as $agence) {
            foreach ($agence->projets as $projet) {
                $facturable = $facturable + $projet->facturable;
                $encaisse = $encaisse + $projet->encaisse;
            }
        }
        //
        $allTask = Travail::where('fait', 1)->orderBy('id', 'desc')->with('user')->take(20)->get();
        //
        $tasks = Travail::where('fait', 1)->orderBy('id', 'desc')->take(5)->get();
        //
        $tasks->load('categorie', 'projet');
        //
        $tresorerie = Tresorerie::orderBy('id', 'desc')->take(5)->get();
        //
        $tresoreries = Tresorerie::all();
        //
        $total_tres = 0;

        foreach ($tresoreries as $tresorery) {
            $total_tres = $total_tres + $tresorery->montant;
        }

        //
        $devisList = Devis::where('a_valider', 1)->where('valide', 0)->take(5)->with('projet')->get();
        //
        $allDevisList = Devis::where('a_valider', 1)->where('valide', 0)->with('projet')->get();
        // On retourne la vue avec tout les paramètres
        return view('welcome', compact(
            'agences', 
            'tasks', 
            'devisList', 
            'allDevisList', 
            'total_tres', 
            'allTask', 
            'tresorerie', 
            'taches', 
            'now', 
            'total_etape', 
            'facturable', 
            'encaisse', 
            'nb_projet'
        ));
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
        $livrets = Tresorerie::orderBy('id', 'desc')->paginate(10);
        //
        if (Auth::user()->version_used == 2) {
            //
            return view('layouts.version-2.tresorerie.livret', compact('livrets'));
        } else {
            //
            return view('tresorerie.livret', compact('livrets'));
        }
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
