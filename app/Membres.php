<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Membres extends Model
{
    protected $table = 'membres';
    protected $connexion = 'mysql';
    public $timestamps = false;

    /**
     * Récupération de tous les membres
     */
    public static function recupMembres()
    {
        $membres = DB::table('membres')
            ->join('utilisateurs', 'membres.id', '=', 'utilisateurs.id')
            ->orderBy('nom', 'asc')
            ->get();
        foreach ($membres as $value) {
            $nb_services = Membres::nbServicesAPayer($value->id);
            $value->nb_services = $nb_services;
        }
        return $membres;
    }

    /**
     * Ajouter un membre
     */
    public static function ajoutMembre($data)
    {
        DB::table('utilisateurs')->insert(
            ['nom' => $data['nom'], 'prenom' => $data['prenom']]
        );
        $id = DB::getPdo()->lastInsertId();
        DB::table('membres')->insert(
            ['id' => $id, 'email' => $data['email']]
        );
    }

    /**
     * Récupére les infos d'un membre avec l'id
     */
    public static function infosMembre($id)
    {
        $membre = DB::table('membres')
            ->join('utilisateurs', 'membres.id', '=', 'utilisateurs.id')
            ->where('membres.id', '=', $id)
            ->get();
        return $membre[0];
    }

    /**
     * Retourne le nombre de services a payer pour un membre
     */
    public static function nbServicesAPayer($id)
    {
        $requete = DB::table('services')
            ->select(DB::raw('COUNT(idService) as nb_services'))
            ->whereNull('datePaiement')
            ->where('id', '=', $id)
            ->get();
        return $requete[0]->nb_services;
    }
}
