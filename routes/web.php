<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Page d'accueil
Route::get('/', 'CompteController@accueil');

// Connexion et déconnexion
Route::get('/connexion', 'ConnexionController@formulaire');
Route::post('/connexion', 'ConnexionController@traitement');
Route::get('/deconnexion', 'ConnexionController@deconnexion');

// Gestion des membres
Route::get('/gestion-membres', 'MembresController@index');
Route::post('/gestion-membres-ajout', 'MembresController@create');
Route::get('/gestion-membres/{id}', 'MembresController@infosMembre');


// Gestion des stationnements
Route::get('/gestion-stationnements', 'StationnementsController@index');
Route::get('/gestion-stationnements/statut/{statut}', 'StationnementsController@index');
Route::post('/gestion-stationnements-ajout', 'StationnementsController@create');
Route::post('/gestion-stationnements-modif', 'StationnementsController@edit');
Route::get('/gestion-stationnements/{id}', 'StationnementsController@infosStationnement');



// Gestion des réparations
Route::get('/gestion-reparations', 'ReparationsController@index');
Route::get('/gestion-reparations/statut/{statut}', 'ReparationsController@index');
Route::post('/gestion-reparations-ajout', 'ReparationsController@create');
Route::post('/gestion-reparations-modif', 'ReparationsController@edit');
Route::get('/gestion-reparations/{id}', 'ReparationsController@infosReparation');
