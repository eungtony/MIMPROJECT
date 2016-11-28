@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Welcome</div>

                    <div class="panel-body">
                        <form action="{{route('user.edit', $user)}}" method="POST">
                            {{csrf_field()}}
                            <div class="form-group">
                                <input type="text" class="form-control" name="name" value="{{$user->name}}">
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" value="{{$user->email}}">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="new_password"
                                       placeholder="Le nouveau mot de passe">
                            </div>
                            <div class="form-group">
                                <select name="agence_id" class="form-control">
                                    @foreach($agences as $agence)
                                        <option value="{{$agence->id}}"
                                                @if($agence->id == $user->agence_id) selected @endif>{{$agence->nom}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <select name="poste_id" class="form-control">
                                    @foreach($postes as $poste)
                                        <option value="{{$poste->id}}"
                                                @if($poste->id == $user->poste_id) selected @endif>{{$poste->nom}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <select name="statut_id" class="form-control">
                                    @foreach($statuts as $statut)
                                        <option value="{{$statut->id}}"
                                                @if($statut->id == $user->statut_id) selected @endif>{{$statut->titre}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Modifier l'utilisateur</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection