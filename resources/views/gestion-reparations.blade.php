@extends('layout')

@section('contenu')
<div class="section">
    <h1 class="title is-1">Gestion des réparations</h1>
    Afficher les statuts :
    <div class="select is-small">
        <select id="statut" onchange="javascript:location.href = '/gestion-reparations/statut/'+this.value;">
            <option value="4">tous</option>
            <option value="1" @if ($nb_statut==1) selected @endif>en cours</option>
            <option value="2" @if ($nb_statut==2) selected @endif>à payer</option>
            <option value="3" @if ($nb_statut==3) selected @endif>réglé</option>
        </select>
    </div>
    <br><br>
    <table>
        <thead>
            <tr>
                <th style="text-align:center">Stationnement</th>
                <th style="text-align:center">Membre</th>
                <th style="text-align:center">Date début</th>
                <th style="text-align:center">Date fin</th>
                <th style="text-align:center">Date paiement</th>
                <th style="text-align:center">Durée</th>
                <th style="text-align:center">Détails</th>
                <th style="text-align:center">Observations</th>
                <th style="text-align:center">Tarif</th>
                <th style="text-align:center">Statut</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reparations as $r)
            <tr>

                <td><a href="/gestion-reparations/{{ $r->idService }}">Réparation n° {{ $r->idService }}</a> </td>
                <td> {{ $r->nom }} {{ $r->prenom }}</td>
                <td> {{ $r->date_debut_format }}</td>
                <td> {{ $r->date_fin_format }}</td>
                <td> {{ $r->date_paiement_format }}</td>
                <td> {{ $r->duree }}</td>
                <td> {{ $r->details }}</td>
                <td> {{ $r->observations }}</td>
                <td> {{ $r->tarif }}</td>
                <td> {{ $r->statut }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="section">
    <h1 class="title is-1">Ajouter une réparation</h1>
    <form action='/gestion-reparations-ajout' method="POST" class="section">
        {{ csrf_field() }}
        <div class="field">
            <label class="label">Membre</label>
            <div class="select">
                <select class="select" name="idMembre">
                    @foreach($membres as $m)
                    <option value="{{ $m->id }}">{{ $m->nom }} {{ $m->prenom }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="field">
            <label class="label">Date début</label>
            <div class="control">
                <input class="input" type="date" name="date_debut">
            </div>
            @if($errors->has('date_debut'))
            <p class="help is-danger">{{ $errors->first('date_debut')  }}</p>
            @endif
        </div>
        <div class="field">
            <label class="label">Heure début</label>
            <div class="control">
                <input class="input" type="time" name="heure_debut">
            </div>
            @if($errors->has('heure_debut'))
            <p class="help is-danger">{{ $errors->first('heure_debut')  }}</p>
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