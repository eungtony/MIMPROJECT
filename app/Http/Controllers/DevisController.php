<?php

namespace App\Http\Controllers;

use App\Devis;
use App\devis_taches;
use Illuminate\Http\Request;

use App\Http\Requests;

class DevisController extends Controller
{
    public function addDevis($agence_id, $projet_id, $user_id)
    {
        $data = ['agence_id' => $agence_id, 'projet_id' => $projet_id, 'user_id' => $user_id];
        Devis::create($data);
        return back()->with('success', 'Le devis a bien été créee ! Vous pouvez désormais le remplir !');
    }

    public function addTask(Requests\devisRequest $request, $agence_id, $projet_id, $devis_id)
    {
        $rq = $request->except('_token');
        $rq['projet_id'] = $projet_id;
        $rq['devis_id'] = $devis_id;
        devis_taches::create($rq);
        $url = route('projet', [$agence_id, $projet_id]) . '#devis';
        return redirect($url)->with('success', 'La tâche a bien été ajouté au devis !');
    }

    public function deleteTask($agence_id, $projet_id, $devis_id)
    {
        devis_taches::destroy($devis_id);
        $url = route('projet', [$agence_id, $projet_id]) . '#devis';
        return redirect($url)->with('success', 'La tâche a bien été supprimé du devis !');
    }

    public function editTask(Request $request, $agence_id, $projet_id, $devis_id)
    {
        $data = $request->except('_token');
        devis_taches::findOrFail($devis_id)->update($data);
        $url = route('projet', [$agence_id, $projet_id]) . '#devis';
        return redirect($url)->with('success', 'La tâche a bien été supprimé du devis !');
    }

    public function valideDevis($devis_id)
    {
        $devis = Devis::findOrFail($devis_id);
        $devis->update(['valide' => 1]);
        return back()->with('success', 'Le devis a bien été validé !');
    }

    public function devalideDevis($devis_id)
    {
        $devis = Devis::findOrFail($devis_id);
        $devis->update(['valide' => 0]);
        return back()->with('success', 'Le devis a bien été dévalidé !');
    }
}
