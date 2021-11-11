<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Reparations extends Model
{
    protected $table = 'reparations';
    protected $connexion = 'mysql';
    public $timestamps = false;

    /**
     * Récupération de toutes les réparations
     */
    public static function recupReparations($statut = '')
    {
        if (!empty($statut)) {
            $reparations = DB::table('reparations')
                ->join('services', 'reparations.idService', '=', 'services.idService')
                ->join('utilisateurs', 'services.id', '=', 'utilisateurs.id')
                ->where('services.statut', '=', $statut)
                ->orderBy('services.idService', 'desc')
                ->get();
        } else {
            $reparations = DB::table('reparations')
                ->join('services', 'reparations.idService', '=', 'services.idService')
                ->join('utilisateurs', 'services.id', '=', 'utilisateurs.id')
                ->orderBy('services.idService', 'desc')
                ->get();
        }
        foreach ($reparations as $value) {
            $debutFormat = Carbon::parse($value->dateDebut);
            $value->date_debut_format = $debutFormat->format('d/m/Y H:i');
            if (!empty($value->dateFin)) {
                $finFormat = Carbon::parse($value->dateFin);
                $value->date_fin_format = $finFormat->format('d/m/Y H:i');
            } else {
                $value->date_fin_format = '';
            }
            if (!empty($value->duree)) {
                // Calcul du tarif
                $tarif_piece = Reparations::calculeTarifPieces($value->idService);
                $value->tarif = (10 * $value->duree) + $tarif_piece;
            } else {
                $value->tarif = '';
            }
            if (!empty($value->datePaiement)) {
                $paiementFormat = Carbon::parse($value->datePaiement);
                $value->date_paiement_format = $paiementFormat->format('d/m/Y');
            } else {
                $value->date_paiement_format = '';
            }
        }
        return $reparations;
    }

    /**
     * Récupération de toutes les réparations pour un membre
     */
    public static function recupReparationsMembre($id_membre)
    {
        $reparations = DB::table('reparations')
            ->join('services', 'reparations.idService', '=', 'services.idService')
            ->join('utilisateurs', 'services.id', '=', 'utilisateurs.id')
            ->where('utilisateurs.id', '=', $id_membre)
            ->orderBy('services.idService', 'desc')
            ->get();
        foreach ($reparations as $value) {
            $debutFormat = Carbon::parse($value->dateDebut);
            $value->date_debut_format = $debutFormat->format('d/m/Y H:i');
            if (!empty($value->dateFin)) {
                $finFormat = Carbon::parse($value->dateFin);
                $value->date_fin_format = $finFormat->format('d/m/Y H:i');
            } else {
                $value->date_fin_format = '';
            }
            if (!empty($value->duree)) {
                // Calcul du tarif
                $tarif_piece = Reparations::calculeTarifPieces($value->idService);
                $value->tarif = (10 * $value->duree) + $tarif_piece;
            } else {
                $value->tarif = '';
            }
            if (!empty($value->datePaiement)) {
                $paiementFormat = Carbon::parse($value->datePaiement);
                $value->date_paiement_format = $paiementFormat->format('d/m/Y');
            } else {
                $value->date_paiement_format = '';
            }
        }
        return $reparations;
    }

    /**
     * Récupére les infos d'une réparation avec l'id
     */
    public static function infosReparation($id)
    {
        $reparation = DB::table('reparations')
            ->join('services', 'reparations.idService', '=', 'services.idService')
            ->join('utilisateurs', 'services.id', '=', 'utilisateurs.id')
            ->where('services.idService', '=', $id)
            ->get();
        $debutFormat = Carbon::parse($reparation[0]->dateDebut);
        $reparation[0]->date_debut_format = $debutFormat->format('Y-m-d');
        $reparation[0]->heure_debut_format = $debutFormat->format('H:i');
        if (!empty($reparation[0]->dateFin)) {
            $finFormat = Carbon::parse($reparation[0]->dateFin);
            $reparation[0]->date_fin_format = $finFormat->format('Y-m-d');
            $reparation[0]->heure_fin_format = $finFormat->format('H:i');
        } else {
            $reparation[0]->date_fin_format = '';
            $reparation[0]->heure_fin_format = '';
        }
        return $reparation[0];
    }

    /**
     * Ajout d'une réparation
     */
    public static function ajoutReparation($data)
    {
        $date_debut = Carbon::parse($data['date_debut'] . ' ' . $data['heure_debut'] . ':00');
        $date_debut_format = $date_debut->format('Y-m-d H:i:s');
        DB::table('services')->insert(
            ['statut' => 'en cours', 'dateDebut' => $date_debut_format, 'id' => $data['idMembre']]
        );
        $id = DB::getPdo()->lastInsertId();
        DB::table('reparations')->insert(
            ['idService' => $id]
        );
    }

    /**
     * Modification d'une réparation
     */
    public static function modifReparation($data)
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
        DB::table('reparations')
            ->where('idService', $data['idService'])
            ->update(
                ['duree' => $data['duree'], 'details' => $data['details'], 'observations' => $data['observations']]
            );
        // Gestion des pièces
        foreach ($data['pieces'] as $id_piece => $nb) {
            // on update, sinon on insère
            $utiliser = DB::table('utiliser')
                ->where('idPiece', '=', $id_piece)
                ->where('idService', '=', $data['idService'])
                ->get();
            if (count($utiliser) > 0) {
                DB::table('utiliser')
                    ->where('idPiece', '=', $id_piece)
                    ->where('idService', '=', $data['idService'])
                    ->update(
                        ['quantite' => $nb]
                    );
            } else {
                if ($nb > 0) {
                    DB::table('utiliser')->insert(
                        ['idService' => $data['idService'], 'idPiece' => $id_piece, 'quantite' => $nb]
                    );
                    // Gestion des stocks
                    DB::table('piecesdetachees')
                        ->where('idPiece', '=', $id_piece)
                        ->increment('qteStock', -$nb);
                }
            }
        }
    }

    /**
     * Calcule le tarif d'une réparation en fonction des pièces utilisées
     */
    public static function calculeTarifPieces($idService)
    {
        $tarif = 0;
        $utiliser = DB::table('utiliser')
            ->join('piecesdetachees', 'piecesdetachees.idPiece', '=', 'utiliser.idPiece')
            ->where('utiliser.idService', '=', $idService)
            ->get();
        if (count($utiliser) > 0) {
            foreach ($utiliser as $value) {
                $tarif += ($value->prixUnitaire) * $value->quantite;
            }
        }
        return $tarif;
    }
}
