<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reparations;
use App\Membres;
use App\Pieces;

class ReparationsController extends Controller
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
        $reparations = Reparations::recupReparations($statut);
        $membres = Membres::recupMembres();
        return view('gestion-reparations', ['reparations' => $reparations, 'membres' => $membres, 'nb_statut' => $nb_statut]);
    }

    public function infosReparation($id)
    {
        if (auth()->guest()) {
            return view('welcome');
        }
        $infos_reparation = Reparations::infosReparation($id);
        $pieces = Pieces::recupListe($id);
        return view('gestion-reparations-infos', ['infosreparation' => $infos_reparation, 'pieces' => $pieces]);
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
        $data = ['idMembre' => request('idMembre'), 'date_debut' => request('date_debut'), 'heure_debut' => request('heure_debut')];
        Reparations::ajoutReparation($data);
        return redirect('/gestion-reparations');
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
        $tab_pieces = array();
        $pieces = Pieces::listePieces();
        foreach ($pieces as $p) {
            $tab_pieces[$p->idPiece] = request($p->idPiece);
        }
        $data = ['idService' => request('idService'), 'date_fin' => request('date_fin'), 'heure_fin' => request('heure_fin'), 'date_paiement' => request('date_paiement'), 'duree' => request('duree'), 'details' => request('details'), 'observations' => request('observations'), 'pieces' => $tab_pieces];
        Reparations::modifReparation($data);
        return redirect('/gestion-reparations');
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
