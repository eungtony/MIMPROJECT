<?php

namespace App\Http\Controllers;

use App\Agence;
use App\Etape;
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

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    public function index($id)
    {
        $agence = Agence::findOrFail($id);
        $agence->load('projets');
        $cdp_id = $agence->user_id;
        $cdp = User::findOrFail($cdp_id)->name;
        $users = User::where('agence_id', $id)->get();
        $total_etape = Etape::all()->count();
        return view('agence.index', compact('id', 'agence', 'cdp', 'cdp_id', 'users', 'total_etape'));
    }

    public function supervisor()
    {
        if ($this->auth->user()->statut_id == 1) {
            $cdp_user = User::where('poste_id', 1)->get();
            $agences = Agence::with('users')->get();
            return view('supervisor', compact('cdp_user', 'agences'));
        } else {
            return redirect()->back();
        }
    }

    public function add(Requests\agenceRequest $request)
    {
        $rq = $request->except('_token');
        Agence::create($rq);
        return redirect()->route('home');
    }

    public function editForm($id)
    {
        $agence = Agence::findOrFail($id);
        $users = User::where('agence_id', $id)->get();
        $cdp_id = $agence->user_id;
        return view('agence.edit', compact('id', 'agence', 'users', 'cdp_id'));
    }

    public function edit($id, Request $request)
    {
        $rq = $request->except('_token');
        Agence::findOrFail($id)->update($rq);
        return redirect()->route('agence', [$id])->with('success', 'Votre agence a été modifié avec succès !');
    }

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

    public function editFile($ida, $id, Request $request)
    {
        $rq = $request->except('_token');
        \App\File::findOrFail($ida)->update($rq);
        return redirect()->route('agence', [$id])->with('success', 'Le fichier a été édité avec succès');
    }

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
}
