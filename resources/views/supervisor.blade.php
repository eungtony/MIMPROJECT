@extends('layouts.application')

@section('content')
    <div class="row mt">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-body">

                    <a href="#addagence"
                       data-toggle="collapse" aria-expanded="false"
                       aria-controls="#addagence">
                        <h1>Ajouter une agence</h1>
                    </a>

                    <div class="collapse" id="addagence">
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
                    </div>

                    <hr>
                        <h1>Liste des agences</h1>
                        @foreach($agences as $agence)
                            <div class="col-md-3">
                                <h3>{{$agence->nom}}</h3>
                                @foreach($agence->users as $user)
                                    <p>
                                        <a href="{{route('edit.user', $user->id)}}">{{$user->name}}</a>
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
