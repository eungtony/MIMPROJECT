<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Auth\Guard;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;

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
        $user->load('agence','poste', 'statut');
        return view('user.index', compact('user'));
    }

    public function user($id)
    {
        $user = User::findOrFail($id);
        $user->load('statut', 'poste', 'agence');
        return view('user.profile', compact('user'));
    }
}
