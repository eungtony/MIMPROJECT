@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Welcome</div>

                    <div class="panel-body">
                        <h1>Bonjour {{$user->name}}</h1>
                        <h2>Vous faites parti de {{$user->agence->nom}}</h2>
                        <h3>{{$user->poste->nom}}</h3>
                        <h3>{{$user->statut->titre}}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
