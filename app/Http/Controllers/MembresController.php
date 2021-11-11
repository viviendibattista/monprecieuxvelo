<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Membres;
use App\Reparations;
use App\Stationnements;


class MembresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->guest()) {
            return view('welcome');
        }
        $membres = Membres::recupMembres();
        return view('gestion-membres', ['membres' => $membres]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        request()->validate([
            'nom' => ['required'],
            'prenom' => ['required'],
            'email' => ['required', 'email'],
        ]);
        $data = ['nom' => request('nom'), 'prenom' => request('prenom'), 'email' => request('email')];
        Membres::ajoutMembre($data);
        return redirect('/gestion-membres');
    }

    public function infosMembre($id)
    {
        if (auth()->guest()) {
            return view('welcome');
        }
        $infos_membre = Membres::infosMembre($id);
        $stationnements = Stationnements::recupStationnementsMembre($id);
        $reparations = Reparations::recupReparationsMembre($id);
        return view('gestion-membres-infos', ['infosmembre' => $infos_membre, 'stationnements' => $stationnements, 'reparations' => $reparations]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }
}
