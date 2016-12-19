<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;

use App\Agence;
use App\Etape;
use App\Travail;
use App\User;
use App\Notifications;

use App\Http\Requests;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class NotificationsController extends Controller
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($type, $id = 0)
    {
        // On recupère toute les agences
        $agences = Agence::with('users')->get();
        $user = User::findOrFail($id);
        // On retourne la vue adéquat
        return view('notif.add', ['agences' => $agences, 'type' => $type, 'id' => $id, 'user' => $user]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Si c'est une notification globale
        if ($request->type == 'global') {
            // On verifie les droits de l'utilisateur
            if (Auth::user()->statut_id == 1 || Auth::user()->statut_id == 2 || Auth::user()->statut_id == 3) {
                // On crée la notification 
                $notif = new Notifications;
                // On défini le sender de la notification
                $notif['sender'] = Auth::user()->id;
                // On défini le type de notifiation
                $notif['type'] = $request->type;
                // On défini le receveur de la notification comme 0
                $notif['to'] = 0;
                // On défini le message de la notification
                $notif['message'] = $request->message;
                // On sauvegarde le notification
                $notif->save();
                // Enfin on redirige l'utilisateur
                return redirect('/home')->with('success', 'Notification envoyée avec succès !');

            } else {
                // On redirige l'utilisateur avec une erreur
                return redirect('/home')->withError('Vous n\'avez pas les droits requis !');
            }
        } else {
            // On crée la notification 
            $notif = new Notifications;
            // On défini le sender de la notification
            $notif['sender'] = Auth::user()->id;
            // On défini le type de notifiation
            $notif['type'] = $request->type;
            // On défini le receveur de la notification
            $notif['to'] = $request->to;
            // On défini le message de la notification
            $notif['message'] = $request->message;
            // On sauvegarde le notification
            $notif->save();
            // Enfin on redirige l'utilisateur
            return redirect('/home')->with('success', 'Notification envoyée avec succès !');
        }
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showAll()
    {
        // On recupère les notifications
        $notifs = Notifications::get();
        // On recupère les utilisateurs
        $users = User::get();
        // Puis on retourne la vue adéquat
        return view('notif.show', ['notifs' => $notifs, 'users' => $users]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // On recupère les notifications
        $notifs = Notifications::findOrFail($id);
        // Puis on retourne la vue adéquat
        return view('notif.show', compact($notifs));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // On supprime la notification 
        Notifications::where('id', $id)->delete();
        // Puis on redirig l'utilisateur
        return redirect('show/notif/all')->withMessage('Notification supprimé avec succès !');
    }
}
