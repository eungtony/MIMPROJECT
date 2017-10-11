<?php

namespace App\Http\Controllers;

use App\Agence;
use App\Categorie;
use App\Devis;
use App\Etape;
use App\HeuresTaches;
use App\Message;
use App\Projet;
use App\Promo;
use App\TacheCommentaire;
use App\Travail;
use App\User;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class agenceController extends Controller
{

    protected $auth;

    /**
     * agenceController constructor.
     * @param Guard $auth
     */
    public function __construct(Guard $auth)
    {
        $this->middleware('auth');
        $this->auth = $auth;
    }

    /**
     * Show agency index view
     *
     * @param $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request, $id)
    {
        $taches = Travail::where('user_id', $this->auth->user()->id)->orderBy('id', 'desc')->get();
        if ($request->only('sort')['sort'] == 'date') {
            $taches = Travail::where('user_id', $this->auth->user()->id)->orderBy('date', 'asc')->get();
        } elseif ($request->only('sort')['sort'] == 'category') {
            $taches = Travail::where('user_id', $this->auth->user()->id)->orderBy('categorie_id', 'asc')->get();
        } elseif ($request->only('sort')['sort'] == 'done') {
            $taches = Travail::where('user_id', $this->auth->user()->id)->orderBy('fait', 'desc')->get();
        }
        $agence = Agence::findOrFail($id);
        $cdp_id = $agence->user_id;
        $cdp = 'Aucun';
        if ($cdp_id != 0) {
            $cdp = User::findOrFail($cdp_id)->name;
        }
        $users = User::where('agence_id', $id)->get();
        $total_etape = Etape::all()->count();
        $now = \Carbon\Carbon::now();
        $etapes = Etape::all();
        $categories = Categorie::all();

        return view('layouts.version-2.agence.index', compact('id', 'etapes', 'categories', 'agence', 'cdp', 'cdp_id', 'users', 'total_etape', 'taches', 'now'));
    }

    public function show($id)
    {
        // On recupère l'agence en question
        $agence = Agence::findOrFail($id);
        // On recupère les membres de cette agence
        $members = User::where('agence_id', $id)->get();
        // Puis on retourne la vue adéquat
        return view('agence.show', ['agence' => $agence, 'members' => $members]);
    }

    /**
     * Show the supervisor administration panel
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function supervisor()
    {
        if ($this->auth->user()->statut_id == 1 || $this->auth->user()->statut_id == 2) {
            $cdp_user = User::where('poste_id', 1)->get();
            $agences = Agence::with('users')->get();
            $users = User::where('agence_id', NULL)->get();
            $promotions = Promo::with('agences')->get();

            return view('layouts.version-2.supervisor.supervisor', compact('cdp_user', 'agences', 'users', 'promotions'));

        } else {
            return redirect()->back()->with('error', 'Vous n\'avez pas accès à cette page !');
        }
    }

    /**
     * Method to add an agency
     *
     * @param Requests\agenceRequest $request
     *
     * @return mixed
     */
    public function add(Requests\agenceRequest $request)
    {
        $rq = $request->except('_token');
        Agence::create($rq);
        return back()->with('success', 'Agence créee');
    }

    /**
     * View to edit an agency
     *
     * @param $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editForm($id)
    {
        $agence = Agence::findOrFail($id);
        $users = User::where('agence_id', $id)->get();
        $cdp_id = $agence->user_id;
        return view('agence.edit', compact('id', 'agence', 'users', 'cdp_id'));
    }

    /**
     * Method to edit an agency
     *
     * @param $id
     * @param Request $request
     * @return mixed
     */
    public function edit($id, Request $request)
    {
        $rq = $request->except('_token');
        Agence::findOrFail($id)->update($rq);
        return redirect()->route('agence', [$id])->with('success', 'Votre agence a été modifié avec succès !');
    }

    /************************************** FILE *******************************************/

    /**
     * Method to add a new file to an agency
     *
     * @param $id
     * @return mixed
     */
    public function addFile($id)
    {
        $path = base_path() . "/file/$id";
        if (Input::hasFile('file') && Input::has('titre')) {
            if (!File::exists($path)) {
                File::makeDirectory($path, 0775, true);
            }
            $titre = Input::only('titre')['titre'];
            $file = Input::file('file')->getClientOriginalName();
            $extension = Input::file('file')->getClientOriginalExtension();
            $renameFile = $titre . '.' . $extension;
            $name_to_explode = Input::file('file')->getClientOriginalName();
            $explode_name = explode('.', $name_to_explode);
            $name = $explode_name[0];
            Input::file('file')->move($path, $renameFile); // uploading file to given path
            \App\File::create(['agence_id' => $id, 'titre' => $titre, 'extension' => $extension, 'name' => $titre]);
            return redirect()->route('agence', $id)->with('success', 'Le fichier a été uploadé avec succès !');
        } else {
            return redirect()->route('agence', $id)->with('success', 'Le fichier a été uploadé avec succès !');
        }
    }

    /**
     * Method to edit the name of a file
     *
     * @param $ida
     * @param $id
     * @param Request $request
     * @return mixed
     */
    public function editFile($ida, $id, Request $request)
    {
        $rq = $request->except('_token');
        \App\File::findOrFail($id)->update($rq);
        return redirect()->route('agence', [$ida])->with('success', 'Le fichier a été édité avec succès');
    }

    /**
     * Method to delete a file
     *
     * @param $ida
     * @param $id
     * @return mixed
     */
    public function deleteFile($ida, $id)
    {
        $file = \App\File::findOrFail($id);
        $file_name = $file->name;
        $extension = $file->extension;
        $filename = base_path() . "/file/$ida/$file_name.$extension";
        if (File::exists($filename)) {
            File::delete($filename);
            \App\File::destroy($id);
        }
        return redirect()->route('agence', [$ida])->with('success', 'Le fichier a bien été supprimé !');
    }

    /**
     * Method to send a message to an agency
     *
     * @param $ida
     * @param $id
     * @param Requests\messageRequest $request
     * @return mixed
     */
    public function addMessage($ida, $id, Requests\messageRequest $request)
    {
        $rq = $request->except('_token');
        Message::create($rq);
        return redirect()->route('home')->with('success', 'Votre message a bien été publié !');
    }

    /**
     * Method to edit a message
     *
     * @param $id
     * @param Request $request
     */
    public function editMessage($id, Request $request)
    {
        $rq = $request->except('_token');
        Message::findOrFail($id)->update($rq);
        return back()->with('success', 'Votre message a bien été édité !');
    }

    /**
     * Method to delete a message
     *
     * @param $ida
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteMessage($ida, $id)
    {
        Message::destroy($id);
        return back()->with('success', 'Le message a bien été supprimé !');
    }

    public function destroy($ida)
    {
        Agence::destroy($ida);
        $users = User::where('agence_id', $ida)->get();
        foreach ($users as $user) {
            User::findOrFail($user->id)->update(['agence_id' => NULL]);
        }
        $projets = Projet::where('agence_id', $ida)->get();
        foreach ($projets as $projet) {
            Projet::destroy($projet->id);
        }
        $taches = Travail::where('agence_id', $ida)->get();
        foreach ($taches as $tache) {
            Travail::destroy($tache->id);
        }
        $messages = Message::where('agence_id', $ida)->get();
        foreach ($messages as $message) {
            Message::destroy($message->id);
        }
        $tacheCommentaires = tacheCommentaire::where('agence_id', $ida)->get();
        foreach ($tacheCommentaires as $tc) {
            tacheCommentaire::destroy($tc->id);
        }
        $devis = Devis::where('agence_id', $ida)->get();
        foreach ($devis as $d) {
            Devis::destroy($d->id);
        }
        $heuresTaches = heuresTaches::where('agence_id', $ida)->get();
        foreach ($heuresTaches as $ht) {
            heuresTaches::destroy($ht->id);
        }

        return back()->with('success', 'Cette agence a bien été supprimé !');
    }

    public function updateCdP(Request $request, $id)
    {
        $rq = $request->except('_token');
        Agence::findOrFail($id)->update($rq);

        return back()->with('success', 'Le chef de projet a été ajouté !');
    }
}
