<?php

namespace App\Http\Controllers;

use App\Employes;
use App\Membres;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class ConnexionController extends Controller
{
    /**
     * Formulaire de connexion
     */
    public function formulaire()
    {
        return view('connexion');
    }

    /**
     * Traitement de la connexion
     */
    public function traitement()
    {
        request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $res = auth()->attempt([
            'email' => request('email'),
            'password' => request('password'),
        ]);

        if ($res) {
            // Stockage en variable session
            request()->session()->put('email', request('email'));
            $infos_e = Employes::infosEmployeMail(request('email'));
            $nom_prenom = $infos_e->prenom . ' ' . $infos_e->nom;
            request()->session()->put('nom_prenom', $nom_prenom);
            return redirect('/');
        }

        return back()->withInput()->withErrors([
            'email' => 'Vos identifiants sont incorrects',
        ]);
    }

    /**
     * Déconnexion
     */
    public function deconnexion()
    {
        auth()->logout();
        return redirect('/');
    }
}
