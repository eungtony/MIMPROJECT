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
                    <div class="panel-heading">{{$taches->titre}}</div>

                    <div class="panel-body">

                        <a href="{{url()->previous()}}">Retour</a>

                        <h1>{{$taches->titre}}</h1>
                        <p>{{$taches->commentaire}}</p>
                        <p class="text-right">{{$taches->date}}</p>
                        <p class="text-right">{{$taches->user->name}}</p>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
