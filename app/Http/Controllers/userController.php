<?php

namespace App\Http\Controllers;

use App\Agence;
use App\Http\Controllers\Auth\AuthController;
use App\Poste;
use App\Statut;
use Illuminate\Contracts\Auth\Guard;
use App\User;
use App\Travail;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;

class userController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = $this->auth->user()->id;
        $user = User::findOrFail($id);
        $user->load('agence', 'poste', 'statut');
        $taches = Travail::where('user_id', Auth::user()->id)
            ->with('projet', 'categorie')
            ->where('fait', 0)
            ->get();
        $now = \Carbon\Carbon::now();

        return view('layouts.version-2.users.profile', compact('user', 'taches', 'now'));
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function user($id)
    {
        $user = User::findOrFail($id);
        $user->load('statut', 'poste', 'agence');
        $taches = Travail::where('user_id', $id)
            ->with('projet', 'categorie')
            ->where('fait', 0)
            ->get();
        $now = \Carbon\Carbon::now();

        return view('layouts.version-2.users.profile', compact('user', 'taches', 'now'));
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function editForm($id)
    {
        if ($this->auth->user()->statut_id == 1 || $this->auth->user()->statut_id == 2) {
            $user = User::findOrFail($id);
            $postes = Poste::all();
            $statuts = Statut::all();
            $agences = Agence::all();
            return view('user.edit', compact('user', 'postes', 'statuts', 'agences'));
        } else {
            return back()->with('error', 'Vous n\'avez pas accès à cette page !');
        }
    }

    /**
     * @param $id
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */

    public function edit($id, Request $request)
    {
        $rq = $request->except('_token', 'new_password');
        if (!$request->has('new_password')) {
            User::findOrFail($id)->update($rq);
            return redirect()->route('profile', $id)->with('success', 'Le profil a été modifié avec succès ! (le mot de passe n\'a pas été modifié)');
        }
        $apw = $request->new_password;
        $cpw = bcrypt($apw);
        User::findOrFail($id)->update(['password' => $cpw]);
        User::findOrFail($id)->update($rq);
        return redirect()->route('profile', $id)->with('success', 'Le profil a été modifié avec succès !');
    }

    public function editParameters(Request $request, $id)
    {
        if (Auth::user()->id == $id) {
            // On stocke le nouveau pseudo
            $name = $request->pseudo;
            // On stocke le nouveau statut
            $statut = $request->statut;
            // On stocke le nouveau poste
            $poste = $request->poste;
            // On update le profil
            User::where('id', $id)->update([
                'name' => $name,
                'statut_id' => $statut,
                'poste_id' => $poste
            ]);
            // Puis on redirige l'utilisateur
            return redirect('/user')->withMessage('Paramètres de compte mis à jour avec succès !');
        }
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */

    public function editAvatar($id)
    {
        $path = public_path() . "/avatars";
        if (!Input::hasFile('avatar')) {
            return redirect()->route('home')->with('success', 'Vous n\'avez pas upload d\'avatar !');
        }
        $extension = Input::file('avatar')->getClientOriginalExtension();
        Input::file('avatar')->move($path, $id . '.' . $extension); // uploading file to given path
        User::findOrFail($id)->update(['extension' => $extension, 'avatar' => 1]);
        return redirect()->route('home')->with('success', 'Votre avatar a été modifé avec succès !');
    }

    public function editDescription(Request $request, $id)
    {
        // On verifie que la description changer est
        // bien celle de l'utilisateur en cour
        if (Auth::user()->id == $id) {
            // On stocke la nouvelle description
            $description = $request->description;
            // Puis on update la description
            User::where('id', $id)->update(['description' => $description]);
            // Puis on redirige l'utilisateur
            return redirect('/user');
        } else {
            // On déconnecte l'utilisateur
            Auth::logout();
            // Puis on le redirige
            return redirect('/');
        }
    }

    public function validation()
    {
        // Si l'utilisateur courant est le supervisor
        // Ou est memebre du bureau
        if (Auth::user()->statut_id == 1 || Auth::user()->statut_id == 2) {
            //
            $users = User::get();
            //
            return view('user.valid', ['users' => $users]);
        } else {
            //
            Auth::logout();
            //
            return redirect('/home');
        }
    }

    public function valid(Request $request, $id)
    {
        // Si l'utilisateur courant est le supervisor
        // Ou est memebre du bureau
        if (Auth::user()->statut_id == 1 || Auth::user()->statut_id == 2) {
            //
            User::where('id', $id)->update(['is_valid' => 1]);
            //
            return redirect('/users/validation')->withMessage('Compte validé !');
        } else {
            //
            Auth::logout();
            //
            return redirect('/home');
        }
    }

    public function unvalid(Request $request, $id)
    {
        // Si l'utilisateur courant est le supervisor
        // Ou est memebre du bureau
        if (Auth::user()->statut_id == 1 || Auth::user()->statut_id == 2) {
            //
            User::where('id', $id)->update(['is_valid' => 0]);
            //
            return redirect('/users/validation')->withMessage('Compte validé !');
        } else {
            //
            Auth::logout();
            //
            return redirect('/home');
        }
    }

    public function add()
    {
        $statut_id = $this->auth->user()->statut_id;
        $admin_id = 1;
        $bureau_id = 2;
        if ($statut_id == $admin_id || $statut_id == $bureau_id) {
            return view('auth.register');
        } else {
            return back()->with('error', 'Vous n\'avez pas accès à cette page !');
        }
    }

    public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'poste_id' => $data['poste_id'],
            'statut_id' => $data['statut_id'],
        ]);
    }

    public function addAction(Requests\userRequest $request)
    {
        $data = $request->except('_token');
        $this->create($data);
        return back()->with('success', 'Le compte a été crée avec succès !');
    }

    public function destroy($user_id)
    {
        User::destroy($user_id);
        return redirect('/supervisor')->with('success', 'L\'utilisateur a bien été supprimé !');
    }
}
