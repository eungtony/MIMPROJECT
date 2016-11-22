@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Supervisor</div>

                    <div class="panel-body">

                        <h1>Ajouter une agence</h1>

                        <form action="{{route('add.agence')}}" method="POST">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="">
                                    Nom de l'agence
                                </label>
                                <input class="form-control" type="text" name="nom">
                            </div>
                            <div class="form-group">
                                <label for="">
                                    Choisissez le chef de projet
                                </label>
                                <select class="form-control" name="user_id" id="">
                                    @foreach($cdp_user as $user)
                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary">
                                    Ajouter cette agence
                                </button>
                            </div>
                        </form>

                        <hr>

                        <h1>Liste des agences</h1>

                        @foreach($agences as $agence)
                            <div class="col-md-3">
                                <h3>{{$agence->nom}}</h3>
                                @foreach($agence->users as $user)
                                    <p>
                                        <a href="{{route('profile', $user->id)}}">{{$user->name}}</a>
                                    </p>
                                @endforeach
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
