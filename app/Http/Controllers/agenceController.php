<?php

namespace App\Http\Controllers;

use App\Agence;
use App\Categorie;
use App\Etape;
use App\Message;
use App\Travail;
use App\User;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

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
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($id)
    {
        $agence = Agence::findOrFail($id);
        $cdp_id = $agence->user_id;
        $cdp = User::findOrFail($cdp_id)->name;
        $users = User::where('agence_id', $id)->get();
        $total_etape = Etape::all()->count();
        $taches = Travail::where('user_id', $this->auth->user()->id)->where('fait', 0)->get();
        $now = \Carbon\Carbon::now();
        $etapes = Etape::all();
        $categories = Categorie::all();
        return view('agence.index', compact('id', 'etapes', 'categories', 'agence', 'cdp', 'cdp_id', 'users', 'total_etape', 'taches', 'now'));
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function supervisor()
    {
        if ($this->auth->user()->statut_id == 1) {
            $cdp_user = User::where('poste_id', 1)->get();
            $agences = Agence::with('users')->get();
            return view('supervisor', compact('cdp_user', 'agences'));
        } else {
            return redirect()->back()->with('error', 'Vous n\'avez pas accès à cette page !');
        }
    }

    /**
     * @param Requests\agenceRequest $request
     * @return mixed
     */
    public function add(Requests\agenceRequest $request)
    {
        $rq = $request->except('_token');
        Agence::create($rq);
        return redirect()->route('home');
    }

    /**
     * @param $id
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
            $name_to_explode = Input::file('file')->getClientOriginalName();
            $explode_name = explode('.', $name_to_explode);
            $name = $explode_name[0];
            Input::file('file')->move($path, $file); // uploading file to given path
            \App\File::create(['agence_id' => $id, 'titre' => $titre, 'extension' => $extension, 'name' => $name]);
            return redirect()->route('agence', $id)->with('success', 'Le fichier a été uploadé avec succès !');
        } else {
            return redirect()->route('agence', $id)->with('success', 'Le fichier a été uploadé avec succès !');
        }
    }

    /**
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
     * @param $ida
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteMessage($ida, $id)
    {
        Message::destroy($id);
        return back()->with('success', 'Le message a bien été supprimé !');
    }
}
