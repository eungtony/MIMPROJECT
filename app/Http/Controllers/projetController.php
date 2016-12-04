<?php

namespace App\Http\Controllers;

use App\Agence;
use App\Categorie;
use App\Etape;
use App\Projet;
use App\Travail;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;

class projetController extends Controller
{
    /**
     * projetController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param $id
     * @param $ida
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($id, $ida){
        $projet = Projet::findOrFail($ida);
        $projet->load('file', 'etape');
        $cdp_id = Agence::findOrFail($id)->user_id;
        $taches = Travail::where('projet_id', $ida)->where('fait', 0)->with('user', 'categorie')->get();
        $done = Travail::where('projet_id', $ida)->where('fait',1)->get()->count();
        $total = $taches->count();
        $users = User::where('agence_id', $id)->get();
        $etapes = Etape::all();
        $categories = Categorie::all();
        $total_etape = Etape::all()->count();
        return view('projet.index', compact('id', 'categories', 'ida', 'cdp_id', 'projet', 'taches', 'done', 'total', 'users', 'etapes', 'total_etape'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function addForm($id){
        return view('projet.add', compact('id'));
    }

    /**
     * @param Requests\projetRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function add(Requests\projetRequest $request){
        $rq = $request->except('_token');
        $id = $rq['agence_id'];
        Projet::create($rq);
        return redirect()->route('agence', [$id])->with('success', 'Le projet a été ajouté avec succès !');
    }

    /**
     * @param $id
     * @param $idp
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editForm($id, $idp){
        $projet = Projet::findOrFail($idp);
        $etapes = Etape::all();
        return view('projet.edit', compact('projet', 'id', 'idp', 'etapes'));
    }

    /**
     * @param $pid
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit($pid, Request $request){
        $rq = $request->except('_token');
        $agence_id = Projet::findOrFail($pid)->agence_id;
        Projet::findOrFail($pid)->update($rq);
        return redirect()->route('projet', [$agence_id, $pid])->with('success', 'Le projet a bien été modifié !');
    }

    /**
     * @param $ida
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($ida, $id)
    {
        Projet::destroy($id);
        return redirect()->route('agence', $ida)->with('success', 'Le projet a bien été supprimé !');
    }

    /************************************** FILE *******************************************/

    /**
     * @param $ida
     * @param $pid
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addFile($ida, $pid)
    {
        $path = base_path() . "/file/$ida/$pid";
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
            \App\File::create(['agence_id' => $ida, 'projet_id' => $pid, 'titre' => $titre, 'extension' => $extension, 'name' => $name]);
            return redirect()->route('projet', [$ida, $pid])->with('success', 'Le fichier a bien été uploadé !');
        } else {
            return redirect()->route('projet', [$ida, $pid])->with('success', 'Le fichier a bien été uploadé !');
        }
    }

    /**
     * @param $ida
     * @param $pid
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function editFile($ida, $pid, $id, Request $request)
    {
        $rq = $request->except('_token');
        \App\File::findOrFail($id)->update($rq);
        return redirect()->route('projet', [$ida, $pid])->with('success', 'Le fichier a bien été modifié !');
    }

    /**
     * @param $ida
     * @param $pid
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteFile($ida, $pid, $id)
    {
        $file = \App\File::findOrFail($id);
        $file_name = $file->name;
        $extension = $file->extension;
        $filename = base_path() . "/file/$ida/$pid/$file_name.$extension";
        if (File::exists($filename)) {
            File::delete($filename);
            \App\File::destroy($id);
        }
        return redirect()->route('projet', [$ida, $pid])->with('success', 'Le fichier a bien été supprimé !');
    }
}
