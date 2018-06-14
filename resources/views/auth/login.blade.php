@extends('layouts.app')

@section('content')

    <div class="ui centered grid">

        <div class="eight wide column">



          <!-- <p>Votre premier exercice vous introduiras à VueJS, en vous faisant réaliser un formulaire d'authentification!</p>

          <p>La base de donnée contient déjà un utilisateur: admin@mygooder.com : yoloyetiswag</p>

          <p>Gérez uniquement la création d'un formulaire avec SemanticUI au sein de VueJ</p>

          <p>Faites pointer le formulaire vers l'URL suivante: {!! route('login') !!}</p>

          <p>Vous trouverez la version HTML du formulaire dans le dossier: <pre>resources/views/forms</pre></p>

          <p>Bon courage! 👯‍</p> -->

          <h1>Connexion</h1>

          <div id="app">

            <login
            csrf="{!! csrf_token() !!}"
            url-login="{!! route('login') !!}"
            password-request="{!! route('password.request') !!}"
            >
            </login>

          </div>

        </div>

    </div>

@endsection
