<?php

namespace App;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable as BasicAuthenticatable;
use Illuminate\Support\Facades\DB;

class Employes extends Model implements Authenticatable
{
    use BasicAuthenticatable;

    protected $fillable = ['email', 'mdp'];

    public function getAuthPassword()
    {
        return $this->mdp;
    }

    public function getRememberTokenName()
    {
        return '';
    }

    /**
     * Récupére les infos d'un employe avec le mail
     */
    public static function infosEmployeMail($mail)
    {
        $employe = DB::table('employes')
            ->join('utilisateurs', 'employes.id', '=', 'utilisateurs.id')
            ->where('employes.email', '=', $mail)
            ->get();
        return $employe[0];
    }
}
