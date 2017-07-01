<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class TrollController extends Controller
{
	/**
	 * Renvoi la soundbox
	 * 
	 */
    public function issou()
    {
    	//
    	return view('layouts.version-2.troll.index');
    }
}
