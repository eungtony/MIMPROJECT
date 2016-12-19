<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;

use App\Events;
use App\User;
use App\EventSubscriber;

class EventsController extends Controller
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
     * [index description]
     * @return [type] [description]
     */
	public function index()
	{
		// On recupère tout les évènements
		$events = Events::get();
		// On recupère tout les etudiants
		$users = User::get();
		// On recupère les inscris 
		$subscribers = EventSubscriber::get();
		// On retourne le vue
		return view('events.index', [
			'events' => $events, 
			'users' => $users, 
			'subscribers' => $subscribers
		]);
	}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
    	// On instancie l'évènement
    	$event = new Events;
    	// On renseigne les champs
    	$event['title'] 		= $request->title;
    	$event['description'] 	= $request->description;
    	$event['from'] 			= $request->from;
    	$event['date'] 			= $request->date;
    	// Puis on sauvegarde l'évenement
    	$event->save();
    	// Enfin on redirige l'utilisateur
    	return redirect('/home')->withMessage('Evenement créer avec succès !');
    }

    /**
     * Registration of a student to an event.
     * 
     * @param  int $event   id of the event
     * @param  int $student id of the student
     * @return \Illuminate\Http\Response
     */
    public function register($event, $student)
    {
    	// On verifie que l'utilisateur qui s'insscrit est
    	// bien le même que celui connecté
    	if ($student == Auth::user()->id) {
    		// On instancie l'objet
    		$subscriber = new EventSubscriber;
    		// On renseigne les champs 
    		$subscriber['event_id'] = $event;
    		$subscriber['subscriber_id'] = $student;
    		// On sauvegarde l'inscription
    		$subscriber->save();
    		// Puis on redirige l'utilisateur
    		return redirect('show/event')->withMessage('Vous avez bien été inscrit à cet évènement !');
    	}
    }

    /**
     * Unregistration of a student.
     * 
     * @param  int $event   id of the event
     * @param  int $student id of the student
     * @return \Illuminate\Http\Response
     */
    public function unregister($event, $student)
    {
    	// On verifie que l'utilisateur qui se déinsscrit est
    	// bien le même que celui connecté
    	if ($student == Auth::user()->id) {
    		// On supprime l'inscription
    		EventSubscriber::where([
    				['event_id', '=', $event],
    				['subscriber_id', '=', $student]
    			])->delete();
    		// Puis on redirige l'utilisateur
    		return redirect('show/event')->withMessage('Vous avez bien été déinscrit de cet évènement !');
    	}
    }

    /**
     * Delete the specified resource
     * 
     * @param  it $id id de l'evenement à supprimer
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
    	// On recupère l'event en question 
    	$event = Events::where('id', $id)->get();
    	// Si l'utilisateur est bien son créateur
    	if (Auth::user()->id == $event[0]->from) {
    		// On supprime les inscriptions à cet evenement
    		EventSubscriber::where('event_id', $id)->delete();
    		// On supprime l'event
    		Events::where('id', $id)->delete();
    		// Puis on redirigel'utilisateur
    		return redirect('show/event')->withMessage('Evenement supprimer avec succès !');
    	} else {
    		// Puis on redirigel'utilisateur
    		return redirect('show/event')->withError('Vous n\'avez pas les droits requis !');
    	}
    }
}
