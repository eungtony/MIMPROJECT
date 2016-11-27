<?php
$user_id = Auth::user()->id;
$statut_id = Auth::user()->statut_id;
$ca_id = 1;
?>
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-primary">
                    <div class="panel-heading">{{$agence->titre}}</div>

                    <div class="panel-body">

                        <a href="{{url()->previous()}}">Retour</a>
                        <div class="row">
                            <div class="col-md-6">
                                <h3>Membres</h3>
                                @foreach($users as $user)
                                    <p>{{$user->name}}</p>
                                @endforeach
                            </div>
                            <div class="col-md-6">
                                <h1 class="text-right">{{$agence->nom}}</h1>
                                <h3 class="text-right">{{$cdp}}</h3>
                                @if($user_id == $cdp_id || $statut_id == $ca_id)
                                    <a href="{{route('edit.form.agence', $agence->id)}}" class="btn btn-primary">Modifier
                                        l'agence</a>
                                    <a href="{{route('form.add.projet', $agence->id)}}" class="btn btn-success">
                                        Ajouter un projet
                                    </a>
                                @endif
                            </div>
                        </div>

                        <h1>Fichiers disponible dans cette agence</h1>

                        @if(!$agence->file->isEmpty())

                            @foreach($agence->file as $file)

                                <p>
                                    <a href="{{app_path()}}/{{$agence->id}}/{{$file->name}}.{{$file->extension}}"
                                       download="{{$file->titre}}">
                                        {{$file->titre}}</a>
                                @if($user_id == $cdp_id || $statut_id == $ca_id)
                                    <hr>
                                    <form action="{{route('file.edit', [$agence->id,$file->id])}}" method="post">
                                        {{csrf_field()}}
                                        <div class="form-group">
                                            <input class="form-control" type="text" name="titre"
                                                   value="{{$file->titre}}">
                                        </div>
                                        <button class="btn btn-primary">Modifier</button>
                                    </form>
                                    <a href="{{route('file.delete', [$agence->id,$file->id])}}" class="btn btn-danger"
                                       data-method="delete"
                                       data-confirm="Voulez-vous supprimer ce fichier ?">Supprimer</a>                                </p>
                                @endif
                            @endforeach

                            <hr>

                        @else

                            <p class="bg-danger">
                                Aucun fichier présent.
                            </p>

                        @endif

                        @if($user_id == $cdp_id || $statut_id == $ca_id)
                            <form action="{{route('file.agence', $agence->id)}}" enctype="multipart/form-data"
                                  method="POST">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label for="">Nommer votre fichier</label>
                                    <input class="form-control" type="text" name="titre">
                                </div>
                                <div class="form-group">
                                    <label for="">Téleverser un fichier</label>
                                    <input type="file" name="file" class="form-control">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">
                                        Téleverser
                                    </button>
                                </div>
                            </form>
                        @endif

                        @foreach($agence->projets as $projet)

                            <?php
                            $travaux = \App\Travail::where('projet_id', $projet->id)->get();
                            $travaux->load('user');
                            $users = \App\User::where('agence_id', $projet->agence_id)->get();
                            $done = \App\Travail::where('projet_id', $projet->id)->where('fait', 1)->get()->count();
                            $total = \App\Travail::where('projet_id', $projet->id)->get()->count();
                            $pc = 0;
                            $pc_projet = 0;
                            if ($total_etape > 0) {
                                $pc_projet = 100 * $projet->etape_id / $total_etape;
                            }
                            if ($total > 0) {
                                $pc = 100 * $done / $total;
                            }
                            $etape = "Le projet n'a pas encore commencé";
                            if ($projet->etape_id > 0) {
                                $etape = \App\Etape::findOrFail($projet->etape_id);
                            }
                            ?>
                            <h1>
                                <a href="{{route('projet', [$projet->agence_id, $projet->id])}}">
                                    {{$projet->nom}}
                                </a>
                                @if($user_id == $cdp_id || $statut_id == $ca_id)
                                    <a href="{{route('edit.form.projet', [$projet->agence_id, $projet->id])}}"
                                       class="btn btn-primary">Modifier ce
                                        projet</a>
                                    <a href="{{route('projet.destroy', [$agence->id, $projet->id])}}"
                                       class="btn btn-danger"
                                       data-method="delete"
                                       data-confirm="Voulez-vous réellement supprimer ce projet ?">Supprimer ce
                                        projet</a>
                                @endif
                            </h1>
                            <p>
                                {{$projet->commentaire}}
                            </p>

                            <hr>
                            <h3>Progression du projet
                                @if($projet->etape_id > 0)
                                    <span class="label label-success" style="font-size:10px;">
                                    {!! $etape->etape !!}
                                        @else
                                            <span class="label label-warning" style="font-size:10px;">
                                    {{ $etape }}
                                                @endif
                            </span>
                            </h3>
                            <div class="progress">
                                <div class="progress-bar progress-bar-success progress-bar-striped"
                                     role="progressbar" aria-valuenow="{{$pc_projet}}" aria-valuemin="0"
                                     aria-valuemax="100" style="width: {{$pc_projet}}%">
                                </div>
                            </div>
                            <h3>Progression dans les tâches</h3>
                            @if($projet->etape_id > 0)
                                <div class="progress">
                                    <div class="progress-bar progress-bar-success progress-bar-striped"
                                         role="progressbar" aria-valuenow="{{$pc}}" aria-valuemin="0"
                                         aria-valuemax="100" style="width: {{$pc}}%">
                                    </div>
                                </div>
                            @else
                                <div class="progress">
                                    <div class="progress-bar progress-bar-danger progress-bar-striped"
                                         role="progressbar" aria-valuenow="100" aria-valuemin="0"
                                         aria-valuemax="100" style="width: {{$pc}}%">
                                    </div>
                                </div>
                            @endif

                            <hr>

                            <h1>Taches
                                @if($user_id == $cdp_id || $statut_id == $ca_id)
                                    <a href="{{route('form.add.tache', [$projet->agence_id, $projet->id])}}"
                                       class="btn btn-warning">Ajouter une tache</a>
                                @endif
                            </h1>
                            @if($travaux->isEmpty())
                                <p class="bg-danger">
                                    Ce projet ne possède pas de tâche !
                                </p>
                            @else

                                <table class="table">
                                    <thead>
                                    <th>Titre</th>
                                    <th>Commentaire</th>
                                    <th>Etat</th>
                                    <th>Personne assignée</th>
                                    @if($user_id == $cdp_id || $statut_id == $ca_id)
                                        <th>Modifier</th>
                                        <th>Supprimer</th>
                                    @endif
                                    </thead>

                                    <tbody>

                                    @foreach($travaux as $tache)

                                        <tr @if($tache->fait == 1) class="bg-success" @endif>
                                            <td>
                                                <a href="{{route('index.tache', [$tache->agence_id, $tache->projet_id, $tache->id])}}">
                                                    {{$tache->titre}}
                                                </a>
                                            </td>
                                            <td>
                                                {{$tache->commentaire}}
                                            </td>
                                            <td>
                                                @if($tache->fait == 1) Fait @else Non Fait @endif
                                            </td>
                                            <td>
                                                @if($tache->user)
                                                    {{$tache->user['name']}}
                                                @else
                                                    Aucune personne assignée
                                                @endif
                                            </td>
                                            @if($user_id == $cdp_id || $statut_id == $ca_id)
                                                <td>
                                                    <a href="#tache{{$tache->id}}" class="btn btn-primary"
                                                       data-toggle="collapse" aria-expanded="false"
                                                       aria-controls="#tache{{$tache->id}}">Modifier</a>
                                                </td>
                                                <td>
                                                    <a href="{{action('tacheController@destroy', $tache->id)}}"
                                                       data-method="delete"
                                                       data-confirm="Souhaitez-vous réellement supprimer cette tâche ?"
                                                       class="btn btn-danger">Supprimer</a>
                                                </td>
                                            @endif
                                        </tr>

                                        <td>
                                            @if($user_id == $cdp_id || $statut_id == $ca_id)
                                                <div class="collapse" id="tache{{$tache->id}}">
                                                    <div class="well">
                                                        <form action="{{route('edit.tache', [$tache->id,$tache->projet_id])}}"
                                                              method="POST">
                                                            <input type="hidden" name="_token"
                                                                   value="{{ csrf_token() }}">

                                                            <div class="form-group">
                                                                <input class="form-control" type="text"
                                                                       name="titre"
                                                                       value="{{$tache->titre}}">
                                                            </div>
                                                            <div class="form-group">
                                                            <textarea class="form-control" name="commentaire" id=""
                                                                      cols="30"
                                                                      rows="2">{{$tache->commentaire}}</textarea>
                                                            </div>
                                                            <label for="" class="checkbox-inline">
                                                                <input type="checkbox" name="fait"
                                                                       value="{{$tache->fait}}"
                                                                       @if($tache->fait == 1) checked @endif>
                                                                Etat de la tâche
                                                            </label>
                                                            <hr>
                                                            <div class="form-group">
                                                                <select name="user_id" class="form-control">
                                                                    @foreach($users as $u)
                                                                        <option value="{{$u->id}}"
                                                                                @if($u->id == $tache->user_id) selected @endif >{{$u->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <button class="btn btn-success"
                                                                        type="submit">
                                                                    Modifier cette tâche
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            @endif

                                        </td>

                                    @endforeach

                                    </tbody>

                                </table>

                            @endif

                            <hr>
                            <hr>
                            <hr>

                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
