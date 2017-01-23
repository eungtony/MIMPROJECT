@extends('layouts.login')

@section('content')
    <div id="login-page">
        <div class="container">

            <form class="form-login" method="POST" action="{{ url('/login') }}">

                {{ csrf_field() }}

                <h2 class="form-login-heading">Connexion</h2>

                <div class="login-wrap">
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}"
                           placeholder="Adresse mail">

                    @if ($errors->has('email'))
                        <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif

                    <br>

                    <input id="password" type="password" class="form-control" name="password"
                           placeholder="Mot de passe">

                    @if ($errors->has('password'))
                        <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif

                    <label class="checkbox">
                    <span class="pull-right">
                        <a data-toggle="modal" href="{{ url('/password/reset') }}"> Mot de passe oublié?</a>

                    </span>
                    </label>

                    <button class="btn btn-theme btn-block" type="submit">
                        <i class="fa fa-lock"></i> Connexion
                    </button>

                </div>

            </form>

        </div>
    </div>
@endsection
