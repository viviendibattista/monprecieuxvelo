@extends('layout')

@section('contenu')
<div class="section">
    <h1 class="title is-1">Fiche de stationnement</h1>
    <p>Stationnement n° {{ $infosstationnement->idService }}</p>
    <form action='/gestion-stationnements-modif' method="POST" class="section">
        {{ csrf_field() }}
        <div class="field">
            <label class="label">Membre</label>
            <div class="control">
                <input type="hidden" name="idService" value="{{ $infosstationnement->idService }}">
                <input class="input" type="text" name="membre" value="{{ $infosstationnement->nom }} {{ $infosstationnement->prenom }}" readonly>
            </div>
        </div>
        <div class="field">
            <label class="label">Date début</label>
            <div class="control">
                <input class="input" type="date" name="date_debut" value="{{ $infosstationnement->date_debut_format }}" readonly>
            </div>
        </div>
        <div class="field">
            <label class="label">Heure début</label>
            <div class="control">
                <input class="input" type="text" name="heure_debut" value="{{ $infosstationnement->heure_debut_format }}" readonly>
            </div>
        </div>
        <div class="field">
            <label class="label">Parking</label>
            <div class="control">
                <input class="input" type="text" name="parking" value="{{ $infosstationnement->idParking }}" readonly>
            </div>
        </div>
        <div class="field">
            <label class="label">Date fin</label>
            <div class="control">
                <input class="input is-focused" type="date" name="date_fin" value="{{ $infosstationnement->date_fin_format }}">
            </div>
            @if($errors->has('date_fin'))
            <p class="help is-danger">{{ $errors->first('date_fin')  }}</p>
            @endif
        </div>
        <div class="field">
            <label class="label">Heure fin</label>
            <div class="control">
                <input class="input is-focused" type="time" name="heure_fin" value="{{ $infosstationnement->heure_fin_format }}">
            </div>
            @if($errors->has('heure_fin'))
            <p class="help is-danger">{{ $errors->first('heure_fin')  }}</p>
            @endif
        </div>
        <div class="field">
            <label class="label">Date paiement</label>
            <div class="control">
                <input class="input is-focused" type="date" name="date_paiement" value="{{ $infosstationnement->datePaiement }}">
            </div>
        </div>
        <div class="field">
            <div class="control">
                <button class="button is-link" type="submit">Enregistrer</button>
            </div>
        </div>
    </form>
</div>
@endsection