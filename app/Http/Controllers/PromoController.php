<?php

namespace App\Http\Controllers;

use App\Agence;
use App\Promo;
use Illuminate\Http\Request;

use App\Http\Requests;

class PromoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->except('_token');
        Promo::create($data);
        return back()->with('success', 'La promotion a été ajouté !');
    }

    public function active(Request $request, $id)
    {
        $data = $request->except('_token');
        Promo::findOrFail($id)->update($data);
        return back()->with('success', 'La promotion a bien été activé !');
    }

    public function unactive(Request $request, $id)
    {
        $data = $request->except('_token');
        Promo::findOrFail($id)->update($data);
        return back()->with('success', 'La promotion a bien été désactivé !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->except('_token');
        $agence = Agence::findOrFail($id);
        $agence->update($data);
        return back()->with('success', 'La promotion de l\'agence a été changé avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
