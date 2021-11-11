<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Stationnements extends Model
{
    protected $table = 'stationnements';
    protected $connexion = 'mysql';
    public $timestamps = false;

    /**
     * Récupération de tous les stationnement
     */
    public static function recupStationnements($statut = '')
    {
        if (!empty($statut)) {
            $stationnements = DB::table('stationnements')
                ->join('services', 'stationnements.idService', '=', 'services.idService')
                ->join('utilisateurs', 'services.id', '=', 'utilisateurs.id')
                ->where('services.statut', '=', $statut)
                ->orderBy('services.idService', 'desc')
                ->get();
        } else {
            $stationnements = DB::table('stationnements')
                ->join('services', 'stationnements.idService', '=', 'services.idService')
                ->join('utilisateurs', 'services.id', '=', 'utilisateurs.id')
                ->orderBy('services.idService', 'desc')
                ->get();
        }
        foreach ($stationnements as $value) {
            $debutFormat = Carbon::parse($value->dateDebut);
            $value->date_debut_format = $debutFormat->format('d/m/Y H:i');
            if (!empty($value->dateFin)) {
                $finFormat = Carbon::parse($value->dateFin);
                $value->date_fin_format = $finFormat->format('d/m/Y H:i');
                // Calcul du tarif
                $totalDuration = $finFormat->diffInHours($debutFormat);
                $value->tarif = $totalDuration * 0.5;
            } else {
                $value->date_fin_format = '';
                $value->tarif = '';
            }
            if (!empty($value->datePaiement)) {
                $paiementFormat = Carbon::parse($value->datePaiement);
                $value->date_paiement_format = $paiementFormat->format('d/m/Y');
            } else {
                $value->date_paiement_format = '';
            }
        }
        return $stationnements;
    }

    /**
     * Récupération de tous les stationnement pour un membre
     */
    public static function recupStationnementsMembre($id_membre)
    {
        $stationnements = DB::table('stationnements')
            ->join('services', 'stationnements.idService', '=', 'services.idService')
            ->join('utilisateurs', 'services.id', '=', 'utilisateurs.id')
            ->where('utilisateurs.id', '=', $id_membre)
            ->orderBy('services.idService', 'desc')
            ->get();
        foreach ($stationnements as $value) {
            $debutFormat = Carbon::parse($value->dateDebut);
            $value->date_debut_format = $debutFormat->format('d/m/Y H:i');
            if (!empty($value->dateFin)) {
                $finFormat = Carbon::parse($value->dateFin);
                $value->date_fin_format = $finFormat->format('d/m/Y H:i');
                // Calcul du tarif
                $totalDuration = $finFormat->diffInHours($debutFormat);
                $value->tarif = $totalDuration * 0.5;
            } else {
                $value->date_fin_format = '';
                $value->tarif = '';
            }
            if (!empty($value->datePaiement)) {
                $paiementFormat = Carbon::parse($value->datePaiement);
                $value->date_paiement_format = $paiementFormat->format('d/m/Y');
            } else {
                $value->date_paiement_format = '';
            }
        }
        return $stationnements;
    }

    /**
     * Récupére les infos d'un stationnement avec l'id
     */
    public static function infosStationnement($id)
    {
        $stationnement = DB::table('stationnements')
            ->join('services', 'stationnements.idService', '=', 'services.idService')
            ->join('utilisateurs', 'services.id', '=', 'utilisateurs.id')
            ->where('services.idService', '=', $id)
            ->get();
        $debutFormat = Carbon::parse($stationnement[0]->dateDebut);
        $stationnement[0]->date_debut_format = $debutFormat->format('Y-m-d');
        $stationnement[0]->heure_debut_format = $debutFormat->format('H:i');
        if (!empty($stationnement[0]->dateFin)) {
            $finFormat = Carbon::parse($stationnement[0]->dateFin);
            $stationnement[0]->date_fin_format = $finFormat->format('Y-m-d');
            $stationnement[0]->heure_fin_format = $finFormat->format('H:i');
        } else {
            $stationnement[0]->date_fin_format = '';
            $stationnement[0]->heure_fin_format = '';
        }
        return $stationnement[0];
    }

    /**
     * Ajout d'un stationnement
     */
    public static function ajoutStationnement($data)
    {
        $date_debut = Carbon::parse($data['date_debut'] . ' ' . $data['heure_debut'] . ':00');
        $date_debut_format = $date_debut->format('Y-m-d H:i:s');
        DB::table('services')->insert(
            ['statut' => 'en cours', 'dateDebut' => $date_debut_format, 'id' => $data['idMembre']]
        );
        $id = DB::getPdo()->lastInsertId();
        DB::table('stationnements')->insert(
            ['idService' => $id, 'idParking' => $data['idParking']]
        );
    }

    /**
     * Modification d'un stationnement
     */
    public static function modifStationnement($data)
    {
        $date_fin = Carbon::parse($data['date_fin'] . ' ' . $data['heure_fin'] . ':00');
        $date_fin_format = $date_fin->format('Y-m-d H:i:s');
        $statut = "à payer";
        DB::table('services')
            ->where('idService', $data['idService'])
            ->update(
                ['statut' => $statut, 'dateFin' => $date_fin_format]
            );
        if (!empty($data['date_paiement'])) {
            $date_paiement = Carbon::parse($data['date_paiement']);
            $date_paiement_format = $date_paiement->format('Y-m-d');
            $statut = "réglé";
            DB::table('services')
                ->where('idService', $data['idService'])
                ->update(
                    ['statut' => $statut, 'datePaiement' => $date_paiement_format]
                );
        }
    }
}
