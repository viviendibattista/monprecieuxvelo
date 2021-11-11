<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pieces extends Model
{
    protected $table = 'piecesdetachees';
    protected $connexion = 'mysql';
    public $timestamps = false;

    public static function recupListe($idService)
    {
        $pieces = DB::table('piecesdetachees')
            ->where('qteStock', '>', 0)
            ->orderBy('designation', 'asc')
            ->get();
        // Récupération des pièces utilisées pour le service
        $utiliser = DB::table('utiliser')
            ->where('idService', '=', $idService)
            ->get();
        foreach ($pieces as $piece) {
            $piece->valeur = 0;
            foreach ($utiliser as $u) {
                if ($u->idPiece == $piece->idPiece) {
                    $piece->valeur = $u->quantite;
                }
            }
        }
        return $pieces;
    }


    public static function listePieces()
    {
        $pieces = DB::table('piecesdetachees')
            ->where('qteStock', '>', 0)
            ->orderBy('designation', 'asc')
            ->get();
        return $pieces;
    }
}
