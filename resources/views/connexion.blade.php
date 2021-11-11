@extends('layout')

@section('contenu')
<form action='/connexion' method="POST" class="section">
    {{ csrf_field() }}

    <div class="field">
        <label class="label">Adresse e-mail</label>
        <div class="control">
            <input class="input" type="email" name="email" value="{{ old('email') }}">
        </div>
        @if($errors->has('email'))
        <p class="help is-danger">{{ $errors->first('email')  }}</p>
        @endif
    </div>

    <div class="field">
        <label class="label">Mot de passe</label>
        <div class="control">
            <input class="input" type="password" name="password">
        </div>
        @if($errors->has('password'))
        <p class="help is-danger">{{ $errors->first('password')  }}</p>
        @endif
    </div>

    <div class="field">
        <div class="control">
            <button class="button is-link" type="submit">Se connecter</button>
        </div>
    </div>
</form>
@endsection