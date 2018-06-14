<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/semantic.css') }}" rel="stylesheet">
</head>
<body>

    <div class="ui fixed inverted menu">
        <div class="ui container">
            <div class="header item">
                {{ config('app.name') }}
            </div>

            @guest
                <a href="/login" class="item" title="Hello !">Connexion</a>
                <a href="/register" class="item" title="Welcome !">Inscription</a>
            @else
                <a href="/userslist" class="item" title="The users !"><i class="users icon"></i>Users</a>
                <a href="/logout" class="item" title="Goodbye !">Déconnexion</a>
            @endguest
            <div class="right menu">
              <diV class=" item">
                <img class="ui avatar image" src="https://avatars2.githubusercontent.com/u/37449153?s=460&v=4">
                <span>Done by <strong>Frédéric Bourelle</strong></span>
              </div>
            </div>
        </div>
    </div>

    <div id="main" class="ui container">
        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/semantic.js') }}"></script>
    @yield('scripts')
</body>
</html>
