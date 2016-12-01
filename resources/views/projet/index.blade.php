<?php
$user_id = Auth::user()->id;
$statut_id = Auth::user()->statut_id;
$ca_id = 1;
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
?>
@extends('layouts.application')

@section('content')

    <div class="row mt">
        <div class="col-lg-9" style="margin-bottom: 15px;">
            <div class="content-panel">
                <h1>
                    {{$projet->nom}}
                    @if($user_id == $cdp_id || $statut_id == $ca_id)
                        <a href="#edit{{$projet->id}}" data-toggle="modal" data-target="#edit{{$projet->id}}"
                           class="btn btn-primary">
                            Modifier
                        </a>
                        @include('projet.edit')
                        <a href="{{route('projet.destroy', [$projet->projet_id, $projet->id])}}"
                           class="btn btn-danger"
                           data-method="delete"
                           data-confirm="Voulez-vous réellement supprimer ce projet ?">Supprimer ce projet</a>
                    @endif
                </h1>

                <h3>
                    {{$projet->commentaire}}
                </h3>

                <p>
                    {{$projet->heures_faites}} heures /{{$projet->total_heures}} heures
                </p>

                <p>
                    {{$projet->encaisse}} € / {{$projet->facturable}} €
                </p>

                @if(!$projet->file->isEmpty())

                    @foreach($projet->file as $file)
                        <p>
                            <a href="{{app_path()}}/{{$projet->agence_id}}/{{$projet->projet_id}}/{{$file->name}}.{{$file->extension}}"
                               download="{{$file->titre}}">
                                {{$file->titre}}</a>
                            @include('projet.file')
                            @if($user_id == $cdp_id || $statut_id == $ca_id)
                                <a href="{{route('file.delete.projet', [$file->agence_id,$file->projet_id,$file->id])}}"
                                   class="btn btn-danger"
                                   data-method="delete"
                                   data-confirm="Voulez-vous supprimer ce fichier ?">Supprimer</a>
                        @endif
                    @endforeach
                    <hr>
                @else
                    <p class="bg-danger">
                        Aucun fichier présent.
                    </p>
                @endif
                @if($user_id == $cdp_id || $statut_id == $ca_id)
                    <a href="#upload" class="btn btn-primary" data-toggle="collapse" data-target="#upload">Téléverser un
                        fichier</a>
                    <div class="collapse" id="upload">
                        <form action="{{route('file.projet', [$projet->agence_id, $projet->id])}}"
                              enctype="multipart/form-data"
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
                    </div>
                @endif
                <hr>
                <h3>Progression du projet</h3>
                <div class="progress">
                    <div class="progress-bar progress-bar-success progress-bar-striped"
                         role="progressbar" aria-valuenow="{{$pc_projet}}" aria-valuemin="0"
                         aria-valuemax="100" style="width:{{$pc_projet}}%">
                    </div>
                </div>
                @if($projet->etape_id !== 0)
                    @foreach($etapes as $etape)
                        <p
                                @if($etape->id == $projet->etape_id) class="label label-success" @endif
                        @if($etape->id < $projet->etape_id) class="label label-primary" style="opacity:0.2;"
                                @endif
                                @if($etape->id > $projet->etape_id) class="label label-danger"
                                style="opacity:0.2;" @endif>
                            {{$etape->etape}}
                        </p>
                    @endforeach
                @else
                    <p class="bg-danger">
                        Projet non commencé
                    </p>
                @endif
                <h3>Progression dans les tâches</h3>
                @if($projet->etape_id > 0)
                    <div class="progress">
                        <div class="progress-bar progress-bar-success progress-bar-striped"
                             role="progressbar" aria-valuenow="{{$pc}}" aria-valuemin="0"
                             aria-valuemax="100" style="width:{{$pc}}%">
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

                <h1>
                    Tâches ({{$done}}/{{$total}})
                    @if($user_id == $cdp_id || $statut_id == $ca_id)
                        <a href="#addtask{{$projet->id}}" data-toggle="modal" data-target="#addtask{{$projet->id}}"
                           class="btn btn-warning">Ajouter une tache</a>
                    @endif
                </h1>

                <table class="table">
                    <thead>
                    <th>Titre</th>
                    <th>Commentaire</th>
                    <th>Date limite</th>
                    <th>Personne assignée</th>
                    <th>Catégorie</th>
                    <th>Etat</th>
                    </thead>

                    <tbody>

                    @foreach($taches as $tache)
                        @include('tache.add')
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
                                {{$tache->date}}
                            </td>
                            <td>
                                @if($tache->user)
                                    {{$tache->user->name}}
                                @else
                                    Aucune personne assignée
                                @endif
                            </td>
                            <td>
                                {{$tache->categorie->titre}}
                            </td>
                            <td>
                                @if($tache->fait == 1) Fait @else Non Fait @endif
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

                        @if($user_id == $cdp_id || $statut_id == $ca_id)
                            <div class="collapse" id="tache{{$tache->id}}">
                                <div class="well">
                                    <form action="{{route('edit.tache', [$tache->id, $tache->projet_id])}}"
                                          method="POST">
                                        <input type="hidden" name="_token"
                                               value="{{ csrf_token() }}">

                                        <div class="form-group">
                                            <input class="form-control" type="text" name="titre"
                                                   value="{{$tache->titre}}">
                                        </div>
                                        <div class="form-group">
                                                        <textarea class="form-control" name="commentaire" id=""
                                                                  cols="30" rows="2">{{$tache->commentaire}}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Date</label><br>
                                            <input type="text" id="datepicker" name="date"
                                                   value="{{$tache->date}}" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="checkbox-inline">
                                                <input type="checkbox" name="fait" id="fait"
                                                       value="{{$tache->fait}}"
                                                       @if($tache->fait == 1) checked @endif>
                                                Etat de la tâche
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <select name="user_id" class="form-control">
                                                @foreach($users as $u)
                                                    <option value="{{$u->id}}"
                                                            @if($u->id == $tache->user_id) selected @endif >{{$u->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <button class="btn btn-success" type="submit">
                                                Modifier cette tâche
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @include('sidebar')
    </div>

@endsection