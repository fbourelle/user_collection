<form class="ui form" method="POST" action="{{ route('login') }}">
    {{ csrf_field() }}

    <div class="field">
        <label>Email</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
    </div>

    @if ($errors->has('email'))
        <div class="ui red message">{{ $errors->first('email') }}</div>
    @endif


    <div class="field">
        <label>Mot de passe</label>
        <input id="password" type="password" name="password" required>
    </div>

    @if ($errors->has('password'))
        <div class="ui red message">{{ $errors->first('password') }}</div>
    @endif

    <div class="field">
        <div class="ui checkbox">
            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
            <label>Se souvenir de moi</label>
        </div>
    </div>

    <button type="submit" class="ui button">
        Connexion
    </button>

    <a class="btn btn-link" href="{{ route('password.request') }}">
        Mot de passe oublié?
    </a>
</form>