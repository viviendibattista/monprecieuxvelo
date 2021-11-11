@extends('layout')

@section('contenu')
<div class="section">
    <h1 class="title is-1">Gestion des membres</h1>
    <table>
        <thead>
            <tr>
                <th style="text-align:center">Membre</th>
                <th style="text-align:center">Paiement(s) en attente</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($membres as $m)
            <tr>

                <td><a href="/gestion-membres/{{ $m->id }}">{{ $m->nom }} {{ $m->prenom }}</a> ({{ $m->email }})</td>
                <td>
                    @if($m->nb_services>0)
                    <i style="color: red;"> {{ $m->nb_services }} paiement(s) </i>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="section">
    <h1 class="title is-1">Ajouter un membre</h1>
    <form action='/gestion-membres-ajout' method="POST" class="section">
        {{ csrf_field() }}
        <div class="field">
            <label class="label">Nom</label>
            <div class="control">
                <input class="input" type="text" name="nom">
            </div>
            @if($errors->has('nom'))
            <p class="help is-danger">{{ $errors->first('nom')  }}</p>
            @endif
        </div>
        <div class="field">
            <label class="label">Prénom</label>
            <div class="control">
                <input class="input" type="text" name="prenom">
            </div>
            @if($errors->has('prenom'))
            <p class="help is-danger">{{ $errors->first('prenom')  }}</p>
            @endif
        </div>
        <div class="field">
            <label class="label">Adresse e-mail</label>
            <div class="control">
                <input class="input" type="email" name="email">
            </div>
            @if($errors->has('email'))
            <p class="help is-danger">{{ $errors->first('email')  }}</p>
            @endif
        </div>
        <div class="field">
            <div class="control">
                <button class="button is-link" type="submit">Ajouter</button>
            </div>
        </div>
    </form>
</div>
@endsection