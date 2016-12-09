<?php

namespace App\Http\Controllers;

use App\Agence;
use App\Poste;
use App\Statut;
use Illuminate\Contracts\Auth\Guard;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;

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
        return view('user.index', compact('user'));
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
        return view('user.profile', compact('user'));
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function editForm($id)
    {
        $user = User::findOrFail($id);
        $postes = Poste::all();
        $statuts = Statut::all();
        $agences = Agence::all();
        return view('user.edit', compact('user', 'postes', 'statuts', 'agences'));
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
}
