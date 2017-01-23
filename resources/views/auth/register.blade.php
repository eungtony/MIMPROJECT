@extends('layouts.login')

@section('content')
    <div class="login-page">
        <div class="container">
            @include('flash')
            <form class="form-login register-form" method="POST" action="{{route('add.user.action')}}">

                {{ csrf_field() }}

                <h2 class="form-login-heading">Inscription</h2>

                <div class="login-wrap">

                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <div class="col-md-12">
                            <input id="name" type="text" class="form-control register-input" name="name"
                                   value="{{ old('name') }}" placeholder="Nom / Pseudo">

                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <div class="col-md-12">
                            <input id="email" type="email" class="form-control register-input" name="email"
                                   value="{{ old('email') }}" placeholder="Adresse mail">

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <div class="col-md-12">
                            <input id="password" type="password" class="form-control register-input" name="password"
                                   placeholder="Mot de passse">

                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                        <div class="col-md-12">
                            <input id="password-confirm" type="password" class="form-control register-input"
                                   name="password_confirmation" placeholder="Confirmer le mot de passe">

                            @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <?php
                    $agences = \App\Agence::all();
                    $postes = \App\Poste::all();
                    $statuts = \App\Statut::all();
                    ?>

                    <div class="form-group">
                        <select class="form-control" name="agence_id">
                            @foreach($agences as $agence)
                                <option value="{{$agence->id}}">{{$agence->nom}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <select class="form-control" name="poste_id">
                            @foreach($postes as $poste)
                                <option value="{{$poste->id}}">{{$poste->nom}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <select class="form-control" name="statut_id">
                            @foreach($statuts as $statut)
                                <option value="{{$statut->id}}">{{$statut->titre}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-info register-button">
                                <i class="fa fa-btn fa-user"></i> Inscription
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
