@extends('layout')

@section('contenu')
<div class="section">
    <h1 class="title is-1">Accueil</h1>
    <p>Bonjour {{ request()->session()->get('nom_prenom') }}, vous êtes bien connecté. </p>
</div>
@endsection