@extends('layout')

@section('contenu')
<div class="section">
    <h1 class="title is-1">Fiche de réparation</h1>
    <p>Réparation n° {{ $infosreparation->idService }}</p>
    <form action='/gestion-reparations-modif' method="POST" class="section">
        {{ csrf_field() }}
        <div class="field">
            <label class="label">Membre</label>
            <div class="control">
                <input type="hidden" name="idService" value="{{ $infosreparation->idService }}">
                <input class="input" type="text" name="membre" value="{{ $infosreparation->nom }} {{ $infosreparation->prenom }}" readonly>
            </div>
        </div>
        <div class="field">
            <label class="label">Date début</label>
            <div class="control">
                <input class="input" type="date" name="date_debut" value="{{ $infosreparation->date_debut_format }}" readonly>
            </div>
        </div>
        <div class="field">
            <label class="label">Heure début</label>
            <div class="control">
                <input class="input" type="text" name="heure_debut" value="{{ $infosreparation->heure_debut_format }}" readonly>
            </div>
        </div>
        <div class="field">
            <label class="label">Date fin</label>
            <div class="control">
                <input class="input is-focused" type="date" name="date_fin" value="{{ $infosreparation->date_fin_format }}">
            </div>
            @if($errors->has('date_fin'))
            <p class="help is-danger">{{ $errors->first('date_fin')  }}</p>
            @endif
        </div>
        <div class="field">
            <label class="label">Heure fin</label>
            <div class="control">
                <input class="input is-focused" type="time" name="heure_fin" value="{{ $infosreparation->heure_fin_format }}">
            </div>
            @if($errors->has('heure_fin'))
            <p class="help is-danger">{{ $errors->first('heure_fin')  }}</p>
            @endif
        </div>
        <div class="field">
            <label class="label">Date paiement</label>
            <div class="control">
                <input class="input is-focused" type="date" name="date_paiement" value="{{ $infosreparation->datePaiement }}">
            </div>
        </div>
        <div class="field">
            <label class="label">Durée</label>
            <div class="select">
                <select class="select is-focused" name="duree">
                    <option value="0">0</option>
                    <option value="0.5" @if ($infosreparation->duree==0.5) selected @endif>0.5</option>
                    <option value="1" @if ($infosreparation->duree==1) selected @endif>1</option>
                    <option value="1.5" @if ($infosreparation->duree==1.5) selected @endif>1.5</option>
                    <option value="2" @if ($infosreparation->duree==2) selected @endif>2</option>
                    <option value="2.5" @if ($infosreparation->duree==2.5) selected @endif>2.5</option>
                    <option value="3" @if ($infosreparation->duree==3) selected @endif>3</option>
                    <option value="3.5" @if ($infosreparation->duree==3.5) selected @endif>3.5</option>
                    <option value="4" @if ($infosreparation->duree==4) selected @endif>4</option>
                    <option value="4.5" @if ($infosreparation->duree==4.5) selected @endif>4.5</option>
                    <option value="5" @if ($infosreparation->duree==5) selected @endif>5</option>
                </select>
            </div>
        </div>
        <div class="field">
            <label class="label">Détails</label>
            <div class="control">
                <textarea class="textarea is-focused" name="details">{{ $infosreparation->details }}</textarea>
            </div>
        </div>
        <div class="field">
            <label class="label">Observations</label>
            <div class="control">
                <textarea class="textarea is-focused" name="observations">{{ $infosreparation->observations }}</textarea>
            </div>
        </div>
        <div class="field">
            <label class="label">Pièce(s) détachée(s)</label>
            @foreach($pieces as $p)
            {{ $p->designation }} : <input style="width:4em;" class="input is-focused is-small" type="number" name="{{ $p->idPiece }}" value="{{ $p->valeur }}">

            @endforeach
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