<?php
$user_id = Auth::user()->id;
$statut_id = Auth::user()->statut_id;
$ca_id = 1;
$projets = \App\Projet::where('agence_id', Auth::user()->agence_id)->take(5)->get();
?>
@extends('layouts.application')

@section('content')

    <div class="row mt">
        <div class="col-lg-9" style="margin-bottom: 15px;">
            <div class="content-panel">
                <h1 style="display: inline-block;">{{ $agence->nom }}</h1>
                @if($user_id == $cdp_id || $statut_id == $ca_id)
                    <a href="#agence{{$agence->id}}" class="btn btn-primary btn-xs"
                       data-toggle="collapse" aria-expanded="false"
                       aria-controls="#agence{{$agence->id}}" style="margin-bottom: 15px;">
                        <i class="fa fa-pencil"></i> Modifier l'Agence
                    </a>
                    <a href="#projet{{$agence->id}}" class="btn btn-success btn-xs"
                       data-toggle="collapse" aria-expanded="false"
                       aria-controls="#projet{{$agence->id}}" style="margin-bottom: 15px;">
                        <i class="fa fa-trash-o "></i> Ajouter un projet
                    </a>
                    <div class="collapse" id="projet{{$agence->id}}">
                        <form action="{{route('add.projet')}}" method="POST">
                            <input class="form-control" type="hidden" name="_token" value="{{ csrf_token() }}">

                            <input class="form-control" type="hidden" value="{{$agence->id}}" name="agence_id">

                            <div class="form-group">
                                <input class="form-control" type="text" name="nom" class="form-control"
                                       placeholder="Nom du projet">
                            </div>

                            <div class="form-group">
                                <textarea class="form-control" type="text" name="commentaire" class="form-control"
                                          placeholder="Description du projet"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="">Total heures requis</label><br>
                                <input class="form-control" type="number" name="total_heures">
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                    Ajouter le projet
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="collapse" id="agence{{$agence->id}}">
                        <form action="{{route('edit.agence', $agence->id)}}">

                            <div class="form-group">
                                <input class="form-control" type="text" name="nom" value="{{$agence->nom}}">
                            </div>

                            <h4>Sélectionnez le chef de l'agence</h4>

                            <div class="form-group">
                                <select name="user_id" class="form-control" value="{{$agence->user_id}}">
                                    @foreach($users as $user)
                                        <option value="{{$user->id}}"
                                                @if($user->id == $cdp_id) selected @endif>{{$user->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Modifier l'agence</button>
                            </div>

                        </form>
                    </div>
                @endif
            </div>
            <div class="content-panel">
                <!-- TELECHARGEMENT -->
                <h3>Fichiers disponible dans cette agence</h3>

                @if(!$agence->file->isEmpty())

                    @foreach($agence->file as $file)

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
                                <div class="form-group">
                                    <button class="btn btn-primary">Modifier</button>
                                </div>
                            </form>
                            <a href="{{route('file.delete', [$agence->id,$file->id])}}" class="btn btn-danger"
                               data-method="delete"
                               data-confirm="Voulez-vous supprimer ce fichier ?">Supprimer</a>
                        @endif
                    @endforeach

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
                            <!-- TELECHARGEMENT -->
            </div>
            @foreach($projets as $projet)
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
                    <!-- TABLEAU PROJETS -->
            <div style="margin-bottom: 15px;">
                <div class="content-panel">
                    <h1 style="display: inline-block;">
                        <a href="{{ route('projet', [$projet->agence_id, $projet->id]) }}">
                            {{ $projet->nom }}
                        </a>
                    </h1>
                    @if($user_id == $cdp_id || $statut_id == $ca_id)
                        <a class="btn btn-primary btn-xs" style="margin-bottom: 15px;margin-left: 20px;"
                           href="{{ route('edit.form.projet', [$projet->agence_id, $projet->id]) }}">
                            <i class="fa fa-pencil"></i>
                        </a>
                        <a class="btn btn-danger btn-xs" style="margin-bottom: 15px;"
                           href="{{ route('projet.destroy', [$agence->id, $projet->id]) }}" data-method="delete"
                           data-confirm="Voulez-vous réellement supprimer ce projet ?">
                            <i class="fa fa-trash-o "></i>
                        </a>
                    @endif
                    <hr>
                    <p><strong>Description :</strong> {{ $projet->commentaire }}</p>
                    <hr>
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
                </div>
                <div class="content-panel">
                    <table class="table table-striped table-advance table-hover">
                        <h4><i class="fa fa-angle-right"></i> Tâches</h4>
                        <hr>
                        <thead>
                        <tr>
                            <th><i class="fa fa-bullhorn"></i> Titre</th>
                            <th class="hidden-phone"><i class="fa fa-question-circle"></i> Commentaires</th>
                            <th><i class="fa fa-bookmark"></i> Catégorie</th>
                            <th><i class=" fa fa-edit"></i> Etat</th>
                            <th><i class=" fa fa-edit"></i> Date limite</th>
                            <th><i class=" fa fa-edit"></i> Personne assignée</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($travaux->isEmpty())
                            <tr>
                                <td><p class="text-danger">Ce projet ne possède pas de tâches !</p></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        @else
                            @foreach($travaux as $tache)
                                <tr>
                                    <td>
                                        <a href="{{route('index.tache', [$tache->agence_id, $tache->projet_id, $tache->id])}}">
                                            {{$tache->titre}}
                                        </a>
                                    </td>
                                    <td>
                                        {{$tache->commentaire}}
                                    </td>
                                    <td>
                                        {{$tache->categorie->titre}}
                                    </td>
                                    <td>
                                        @if($tache->fait == 1) Fait @else Non Fait @endif
                                    </td>
                                    <td>
                                        {{$tache->date}}
                                    </td>
                                    <td class="hidden-phone">
                                        @if($tache->user)
                                            {{$tache->user['name']}}
                                        @else
                                            Aucune personne assignée
                                        @endif
                                    </td>
                                    <td>
                                        @if($user_id == $cdp_id || $statut_id == $ca_id)
                                            <a href="" class="btn btn-success btn-xs"><i class="fa fa-check"></i></a>
                                            <a href="#tache{{$tache->id}}" class="btn btn-primary btn-xs"
                                               data-toggle="modal" aria-expanded="false"
                                               aria-controls="#tache{{$tache->id}}"><i class="fa fa-pencil"></i></a>
                                            <a href="{{ action('tacheController@destroy', $tache->id) }}"
                                               class="btn btn-danger btn-xs" data-method="delete"
                                               data-confirm="Souhaitez-vous réellement supprimer cette tâche ?"><i
                                                        class="fa fa-trash-o "></i></a>
                                        @endif
                                    </td>
                                        @if($user_id == $cdp_id || $statut_id == $ca_id)
                                        <div class="modal fade" id="tache{{$tache->id}}" role="dialog">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <form action="{{route('edit.tache', [$tache->id,$tache->projet_id])}}"
                                                              method="POST">
                                                            <input type="hidden" name="_token"
                                                                   value="{{ csrf_token() }}">

                                                            <div class="form-group">
                                                                <input class="form-control" type="text" name="titre"
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
                                                                <button class="btn btn-success" type="submit">
                                                                    Modifier cette tâche
                                                                </button>
                                                            </div>
                                                        </form>
                                                        </div>
                                                </div>
                                                </div>
                                            </div>
                                        @endif
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                    @if($user_id == $cdp_id || $statut_id == $ca_id)
                        <a class="btn btn-success btn-xs"
                           href="{{ route('form.add.tache', [$projet->agence_id, $projet->id]) }}"><i
                                    class="fa fa-check fa-fw"></i>Ajouter une tâche</a>
                    @endif
                </div><!-- /content-panel -->
            </div><!-- /col-md-12 -->
            <!-- TABLEAU PROJETS -->
            @endforeach
        </div>
        @include('sidebar')
    </div>
@endsection
