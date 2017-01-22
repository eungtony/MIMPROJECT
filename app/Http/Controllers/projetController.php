<?php

namespace App\Http\Controllers;

use App\Agence;
use App\Categorie;
use App\Etape;
use App\Projet;
use App\Projet_agence;
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
     * View of a project
     *
     * @param $id
     * @param $ida
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request, $ida, $id)
    {
        $projet = Projet::findOrFail($id);
        $projet->load('file', 'etape');
        $cdp_id = Agence::findOrFail($ida)->user_id;
        $taches = Travail::where('projet_id', $id)->orderBy('id', 'desc')->with('user', 'categorie')->get();
        if ($request->only('sort')['sort'] == 'date') {
            $taches = Travail::where('projet_id', $id)->orderBy('date', 'asc')->get();
        } elseif ($request->only('sort')['sort'] == 'category') {
            $taches = Travail::where('projet_id', $id)->orderBy('categorie_id', 'asc')->get();
        } elseif ($request->only('sort')['sort'] == 'done') {
            $taches = Travail::where('projet_id', $id)->orderBy('fait', 'asc')->get();
        }
        $done = Travail::where('projet_id', $id)->where('fait', 1)->get()->count();
        $total = $taches->count();
        $users = User::where('agence_id', $ida)->get();
        $etapes = Etape::all();
        $categories = Categorie::all();
        $total_etape = Etape::all()->count();
        return view('projet.index', compact('id', 'categories', 'ida', 'cdp_id', 'projet', 'taches', 'done', 'total', 'users', 'etapes', 'total_etape'));
    }

    /**
     * View of the form to add a project
     *
     * @param $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function addForm($id)
    {
        return view('projet.add', compact('id'));
    }

    /**
     * Method to add a project
     *
     * @param Requests\projetRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function add(Requests\projetRequest $request)
    {
        if ($request->has('bureau')) {
            $rq = $request->except('_token', 'bureau');
            Projet::create($rq);
            return back()->with('success', 'Le projet a bien été ajouté !');
        }
        $rq = $request->except('_token');
        $id = $rq['agence_id'];
        Projet::create($rq);
        return redirect()->route('agence', [$id])->with('success', 'Le projet a été ajouté avec succès !');
    }

    /**
     * View of the form to edit the project
     *
     * @param $id
     * @param $idp
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editForm($id, $idp)
    {
        $projet = Projet::findOrFail($idp);
        $etapes = Etape::all();
        return view('projet.edit', compact('projet', 'id', 'idp', 'etapes'));
    }

    /**
     * Method to edit a project
     *
     * @param $pid
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit($pid, Request $request)
    {
        $rq = $request->except('_token');
        $agence_id = Projet::findOrFail($pid)->agence_id;
        Projet::findOrFail($pid)->update($rq);
        return redirect()->route('projet', [$agence_id, $pid])->with('success', 'Le projet a bien été modifié !');
    }

    /**
     * Method to destroy a project
     *
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
     * Method to add a file in a project
     *
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
     * Method to edit the name of a file
     *
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
     * Method to delete a file
     *
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

    /**
     * Add your agency in a free project shortlist
     *
     * @param $projet_id
     * @param $agence_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addProjetAgence($projet_id, $agence_id)
    {
        $agence_nom = Agence::findOrFail($agence_id)->nom;
        $data = [
            'projet_id' => $projet_id,
            'agence_id' => $agence_id,
            'nom_agence' => $agence_nom
        ];
        Projet_agence::create($data);
        return back()->with('success', 'Vous avez bien proposé votre agence pour ce projet !');
    }

    /**
     * Delete your agency in the free project shortlist
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteProjetAgence($id)
    {
        Projet_agence::destroy($id);
        return back()->with('success', 'Vous vous êtes désisté de ce projet !');
    }

    /**
     * Attribute a project to an agency
     *
     * @param Request $request
     * @param $projet_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function attributeProject(Request $request, $projet_id)
    {
        $data = $request->except('_token');
        $projet = Projet::findOrFail($projet_id);
        $projet->update($data);
        return back()->with('success', 'Le projet a bien été attribué !');
    }

    /**
     * edit a project without agency
     *
     * @param Request $request
     * @param $projet_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function editFreeProject(Request $request, $projet_id)
    {
        $data = $request->except('_token');
        $projet = Projet::findOrFail($projet_id);
        $projet->update($data);
        return back()->with('success', 'Le projet a été modifié !');
    }
}
