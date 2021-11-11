@extends('layout')

@section('contenu')
<div class="section">
    <h1 class="title is-1">Fiche de membre</h1>
    <p>{{ $infosmembre->nom }} {{ $infosmembre->prenom }} ({{ $infosmembre->email }})</p>
    <div class="section">
        <h1 class="title is-2">Détails des stationnements</h1>
        @if(!$stationnements->isEmpty())
        <table>
            <thead>
                <tr>
                    <th style="text-align:center">Stationnement</th>
                    <th style="text-align:center">Membre</th>
                    <th style="text-align:center">Date début</th>
                    <th style="text-align:center">Date fin</th>
                    <th style="text-align:center">Date paiement</th>
                    <th style="text-align:center">Parking</th>
                    <th style="text-align:center">Tarif</th>

                    <th style="text-align:center">Statut</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($stationnements as $s)
                <tr>

                    <td><a href="/gestion-stationnements/{{ $s->idService }}">Stationnement n° {{ $s->idService }}</a> </td>
                    <td> {{ $s->nom }} {{ $s->prenom }}</td>
                    <td> {{ $s->date_debut_format }}</td>
                    <td> {{ $s->date_fin_format }}</td>
                    <td> {{ $s->date_paiement_format }}</td>
                    <td> {{ $s->idParking }}</td>
                    <td> {{ $s->tarif }}</td>
                    <td> {{ $s->statut }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        Pas de stationnements
        @endif
    </div>
    <div class="section">
        <h1 class="title is-2">Détails des réparations</h1>
        @if(!$reparations->isEmpty())
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
        @else
        Pas de réparations
        @endif
    </div>
</div>
@endsection