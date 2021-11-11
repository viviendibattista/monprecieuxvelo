<?php

namespace App\Http\Controllers;

use App\Membres;
use App\Parkings;
use Illuminate\Http\Request;
use App\Stationnements;


class StationnementsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($nb_statut = '')
    {
        if (auth()->guest()) {
            return view('welcome');
        }
        switch ($nb_statut) {
            case 1:
                $statut = 'en cours';
                break;
            case 2:
                $statut = 'à payer';
                break;
            case 3:
                $statut = 'réglé';
                break;
            case 4:
                $statut = '';
                break;
            default:
                $statut = '';
                break;
        }
        $stationnements = Stationnements::recupStationnements($statut);
        $membres = Membres::recupMembres();
        $parkings = Parkings::all();
        return view('gestion-stationnements', ['stationnements' => $stationnements, 'membres' => $membres, 'parkings' => $parkings, 'nb_statut' => $nb_statut]);
    }

    public function infosStationnement($id)
    {
        if (auth()->guest()) {
            return view('welcome');
        }
        $infos_stationnement = Stationnements::infosStationnement($id);
        return view('gestion-stationnements-infos', ['infosstationnement' => $infos_stationnement]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($nb_statut = '')
    {
        request()->validate([
            'date_debut' => ['required'],
            'heure_debut' => ['required'],
        ]);
        $data = ['idMembre' => request('idMembre'), 'date_debut' => request('date_debut'), 'heure_debut' => request('heure_debut'), 'idParking' => request('idParking')];
        Stationnements::ajoutStationnement($data);
        return redirect('/gestion-stationnements');
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
    public function edit($nb_statut = '')
    {
        request()->validate([
            'date_fin' => ['required'],
            'heure_fin' => ['required'],
        ]);
        $data = ['idService' => request('idService'), 'date_fin' => request('date_fin'), 'heure_fin' => request('heure_fin'), 'date_paiement' => request('date_paiement')];
        Stationnements::modifStationnement($data);
        return redirect('/gestion-stationnements');
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
