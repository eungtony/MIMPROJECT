<?php

namespace App\Http\Controllers;

use App\Categorie;
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
     * @param $ida
     * @param $pid
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($ida, $pid, $id)
    {
        $taches = Travail::findOrFail($id);
        $taches->load('user', 'categorie');
        return view('tache.index', compact('taches'));
    }

    /**
     * @param $id
     * @param $idp
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function addForm($id, $idp)
    {
        $categories = Categorie::all();
        return view('tache.add', compact('id', 'idp', 'categories'));
    }

    /**
     * @param Requests\tacheRequest $request
     * @return \Illuminate\Http\RedirectResponse
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
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editForm($id)
    {
        $taches = Travail::findOrFail($id);
        return view('tache.edit', compact('taches', 'id'));
    }

    /**
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
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        Travail::findOrFail($id)->delete();
        return redirect()->route('home')->with('success', 'Le tâche a bien été supprimée !');
    }

    /**
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

    public function uncheckTask(Request $request)
    {
        $id = $request->only('id')['id'];
        $tache = Travail::findOrFail($id);
        $tache->update(['fait' => 0]);
        return back()->with('success', 'La tâche a été mise à jour !');
    }
}
