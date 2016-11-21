<?php
$user_id = Auth::user()->id;
$statut_id = Auth::user()->statut_id;
$ca_id = 1;
$b_id = 2;
?>
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">{{$projet->nom}}</div>

                    <div class="panel-body">
                        <a href="{{url()->previous()}}">Retour</a>
                        <h1>
                            {{$projet->nom}}
                            @if($user_id == $cdp_id || $statut_id == $ca_id || $statut_id == $b_id)
                                <a href="{{route('edit.form.projet', [$projet->agence_id,$projet->id])}}"
                                   class="btn btn-primary">
                                    Modifier
                                </a>
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

                        @if($projet->etape_id !== 0)
                            @foreach($etapes as $etape)
                                <p
                                        @if($etape->id == $projet->etape_id) style="color:forestgreen" @endif
                                @if($etape->id < $projet->etape_id) style="color:lightgray" @endif
                                        @if($etape->id > $projet->etape_id) style="color:red" @endif>
                                    {{$etape->etape}}
                                </p>
                            @endforeach
                        @else
                            <p class="bg-danger">
                                Projet non commencé
                            </p>
                        @endif

                        <hr>

                        <h1>
                            Tâches ({{$done}}/{{$total}})
                            @if($user_id == $cdp_id || $statut_id == $ca_id || $statut_id == $b_id)
                                <a href="{{route('form.add.tache', [$projet->agence_id, $projet->id])}}"
                                   class="btn btn-warning">Ajouter une tache</a>
                            @endif
                        </h1>

                        <table class="table">
                            <thead>
                            <th>Titre</th>
                            <th>Commentaire</th>
                            <th>Date limite</th>
                            <th>Personne assignée</th>
                            <th>Etat</th>
                            </thead>

                            <tbody>

                            @foreach($taches as $tache)
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
                                        @if($tache->fait == 1) Fait @else Non Fait @endif
                                    </td>
                                    @if($user_id == $cdp_id || $statut_id == $ca_id || $statut_id == $b_id)
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

                                @if($user_id == $cdp_id || $statut_id == $ca_id || $statut_id == $b_id)
                                    <tr>
                                        <td>
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
                                                        <label for="" class="checkbox-inline">
                                                            <input type="checkbox" name="fait" id="fait"
                                                                   value="{{$tache->fait}}"
                                                                   @if($tache->fait == 1) checked @endif>
                                                            Etat de la tâche
                                                        </label>
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
                                        </td>
                                    </tr>
                                @endif

                            @endforeach

                            </tbody>

                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
