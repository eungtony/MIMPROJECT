<?php

namespace App\Http\Controllers;

use App\Categorie;
use App\TacheCommentaire;
use App\Travail;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;

class tacheController extends Controller
{
    /**
     * tacheController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show a task
     *
     * @param $ida
     * @param $pid
     * @param $id
     *
*@return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($ida, $pid, $id)
    {
        $taches = Travail::findOrFail($id);
        $taches->load('user', 'categorie');
        return view('tache.index', compact('taches'));
    }

    /**
     * View of the form to add a task
     *
     * @param $id
     * @param $idp
     *
*@return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function addForm($id, $idp)
    {
        $categories = Categorie::all();
        return view('tache.add', compact('id', 'idp', 'categories'));
    }

    /**
     * Method to add a task
     *
     * @param Requests\tacheRequest $request
     *
*@return \Illuminate\Http\RedirectResponse
     */
    public function add(Requests\tacheRequest $request)
    {
        $rq = $request->except('_token');
        $id = $request->only('projet_id');
        $ida = $request->only('agence_id');
        Travail::create($rq);
        return redirect()->route('projet', [$ida['agence_id'], $id['projet_id']])->with('success', 'La tâche a bien été ajoutée !');
    }

    /**
     * View of the form to edit a task
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editForm($id)
    {
        $taches = Travail::findOrFail($id);
        return view('tache.edit', compact('taches', 'id'));
    }

    /**
     * Method to edit a task
     *
     * @param $id
     * @param $pid
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit($id, $pid, Request $request)
    {
        $ida = Travail::findOrFail($id)->agence_id;
        $rq = $request->except('_token', 'fait');
        Travail::findOrFail($id)->update($rq);
        if (Input::get('fait') == "0") {
            Travail::findOrFail($id)->update(['fait' => 1]);
        } else {
            Travail::findOrFail($id)->update(['fait' => 0]);
        }
        return redirect()->route('projet', [$ida, $pid])->with('success', 'La tâche a bien été éditée !');
    }

    /**
     * Method to delete a task
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        Travail::findOrFail($id)->delete();
        return redirect()->route('home')->with('success', 'Le tâche a bien été supprimée !');
    }

    /**
     * Method to put a task as done
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function checkTask(Request $request)
    {
        $id = $request->only('id')['id'];
        $tache = Travail::findOrFail($id);
        $tache->update(['fait' => 1]);
        return back()->with('success', 'La tâche a été mis a à jour !');
    }


    /**
     * Method to put a task as done
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addCommentaire(Request $request)
    {
        $rq = $request->except('_token');
        TacheCommentaire::create($rq);
        return back()->with('success', 'Le commentaire a été ajouté !');
    }

    /**
     * Method to put a task as 'to make'
     *
     * @param Request $request
     *
*@return \Illuminate\Http\RedirectResponse
     */
    public function uncheckTask(Request $request)
    {
        $id = $request->only('id')['id'];
        $tache = Travail::findOrFail($id);
        $tache->update(['fait' => 0]);
        return back()->with('success', 'La tâche a été mise à jour !');
    }
}
