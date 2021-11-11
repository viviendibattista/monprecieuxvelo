@extends('layout')

@section('contenu')
<div class="title m-b-md">
    <br><br><br><br>
    Mon Précieux Vélo
</div>
Bonjour et bienvenue sur l'application Mon Précieux Vélo, connectez-vous pour commencer.
<br><br>
<form action="/connexion">
    <button class="button is-link">Se connecter</button>
</form>
@endsection