@extends('layouts.version-2.layouts.app')

@section('title') Troyes Point Zéro - Administration @endsection

@section('content')
    <div class="row mt">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-body">

                    <a href="#addagence"
                       data-toggle="collapse" aria-expanded="false"
                       aria-controls="#addagence">
                        <button class="btn btn-success btn-md">Ajouter une agence</button>
                    </a>

                    <a href="#addpromo" data-toggle="collapse" aria-expanded="false"
                       aria-controls="#addpromo">
                        <button class="btn btn-success btn-md">Ajouter une promotion</button>
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
                                    Choisir la promotion
                                </label>
                                <select class="form-control" name="promo_id" id="">
                                    @foreach($promotions as $promotion)
                                        <option value="{{$promotion->id}}">{{$promotion->annee}}</option>
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

                    <!-- Formulaire ajout de promo -->

                    <div class="collapse" id="addpromo">
                        <form action="{{route('add.promo')}}" method="POST">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="">
                                    Années de la promotion
                                </label>
                                <input class="form-control" type="text" name="annee">
                            </div>
                            <div class="form-group">
                                <label for="">
                                    Activer la promotion
                                </label>
                                <select class="form-control" name="active" id="">
                                    <option value="1">Oui</option>
                                    <option value="0">Non</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary">
                                    Ajouter cette promotion
                                </button>
                            </div>
                        </form>
                    </div>

                    <hr>
                    <h1>Promotions</h1>

                    @foreach($promotions as $promotion)
                        <div class="col-md-12">
                            <h2>
                                <a href="#promo{{$promotion->id}}"
                                   data-toggle="collapse" aria-expanded="false"
                                   aria-controls="#promo{{$promotion->id}}">
                                    {{$promotion->annee}}@if($promotion->active == 1) <strong>Promotion
                                        active</strong>@endif
                                </a>
                            </h2>
                            <div class="collapse" id="promo{{$promotion->id}}">
                                @if($promotion->active == 1)
                                    <form action="{{route('unactive.promo', $promotion->id)}}" method="POST">
                                        {{csrf_field()}}
                                        <input type="hidden" name="active" value="0">
                                        <button type="submit" class="btn btn-danger">Désactiver la promotion</button>
                                    </form>
                                @else
                                    <form action="{{route('active.promo', $promotion->id)}}" method="POST">
                                        {{csrf_field()}}
                                        <input type="hidden" name="active" value="1">
                                        <button type="submit" class="btn btn-success">Activer la promotion</button>
                                    </form>
                                @endif
                                @foreach($agences as $agence)
                                    @if($promotion->id == $agence->promo_id)
                                        <div class="col-md-3">
                                            <h3>{{$agence->nom}}</h3>
                                            <a href="{{route('agence', $agence->id)}}">
                                                <i class="fa fa-pencil-square-o"></i>
                                            </a>
                                            <a href="{{action('agenceController@destroy', $agence->id)}}"
                                               data-method="delete"
                                               data-confirm="Souhaitez-vous réellement supprimer cette agence ?">
                                                <i class="fa fa-trash-o"></i>
                                            </a>
                                            <form action="{{route('edit.promo', $agence->id)}}" method="POST">
                                                {{csrf_field()}}
                                                <select name="promo_id" id="">
                                                    @foreach($promotions as $prom)
                                                        <option value="{{$prom->id}}"
                                                                @if($agence->promo_id == $prom->id) selected @endif>{{$prom->annee}}</option>
                                                    @endforeach
                                                </select>
                                                <button type="submit" class="btn btn-primary">Changer</button>
                                            </form>
                                            <hr>
                                            <p>Ajouter/Modifier un CdP</p>
                                            <form action="{{route('cdp.agence', $agence->id)}}" method="POST">
                                                {{csrf_field()}}
                                                <select name="user_id" id="cdp-form">
                                                    @foreach($activeCdp as $cdp)
                                                        <option value="{{$cdp->id}}"
                                                                @if($agence->user_id == $cdp->id) selected @endif>
                                                            {{$cdp->name}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @if($agence->user_id == 0)
                                                    <button type="submit" class="btn btn-primary">Ajouter</button>
                                                @else
                                                    <button type="submit" class="btn btn-info">Changer</button>
                                                @endif
                                            </form>
                                            <hr>
                                            @foreach($agence->users as $user)
                                                <p>
                                                    @if($user->id == $agence->user_id)
                                                        <span>CdP - </span>
                                                    @endif
                                                    <a href="{{route('edit.user', $user->id)}}">{{$user->name}}</a>
                                                    <a href="{{action('userController@destroy', $user->id)}}"
                                                       data-method="delete"
                                                       data-confirm="Souhaitez-vous réellement supprimer cet utilisateur ?"
                                                    >
                                                        <i class="fa fa-trash-o"></i>
                                                    </a>
                                                </p>
                                            @endforeach
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endforeach

                    <div class="row mt">
                        <div class="col-md-12">
                            <hr>
                            <h1>Membres sans agence</h1>
                            @if($users->isEmpty())
                                <p class="alert alert-danger">
                                    Tous les membres possèdent une agence !
                                </p>
                            @else
                                @foreach($users as $user)
                                    <h3>
                                        <a href="{{route('edit.user', $user->id)}}">{{ $user->name }}</a>
                                        <a href="{{action('userController@destroy', $user->id)}}"
                                           data-method="delete"
                                           data-confirm="Souhaitez-vous réellement supprimer cet utilisateur ?"
                                        >
                                            <i class="fa fa-trash-o"></i>
                                        </a>
                                    </h3>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
