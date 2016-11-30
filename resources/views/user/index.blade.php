@extends('layouts.application')

@section('content')
    <h3><i class="fa fa-angle-right"></i> Bienvenue {{$user->name}}</h3>
    <div class="rowmt">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-md-4 col-sm-4 mb">
                    <div class="stock card">
                        <div class="stock-chart">
                            <div id="chart"></div>
                        </div>
                        <div class="stock current-price">
                            <div class="row">
                                <div class="info col-sm-6 col-xs-6"><abbr>Votre contribution</abbr>
                                    <time>Depuis {{ $user->created_at }}</time>
                                </div>
                                <div class="changes col-sm-6 col-xs-6">
                                    <div class="value up"><i class="fa fa-caret-up hidden-sm hidden-xs"></i> 10.00€
                                    </div>
                                    <div class="change hidden-sm hidden-xs">+5€ (100%)</div>
                                </div>
                            </div>
                        </div>
                        <div class="summary">
                            <strong>1</strong> <span>Projet réalisé !</span>
                        </div>
                    </div>
                </div>
                <! -- /col-md-4 -->
                <div class="col-lg-5 col-md-5 col-sm-5 mb">
                    <!-- WHITE PANEL - TOP USER -->
                    <div class="white-panel pn">
                        <div class="white-header">
                            <h5><strong>PROFIL</strong></h5>
                        </div>
                        <p><img src="{{ asset('img/ui-zac.jpg') }}" class="img-circle" width="50"></p>
                        <p><b>{{$user->name}}</b></p>
                        <div class="row">
                            <div class="col-md-4">
                                <p class="small mt">AGENCE</p>
                                <p>{{$user->agence->nom}}</p>
                            </div>
                            <div class="col-md-4">
                                <p class="small mt">POSTE</p>
                                <p>{{$user->poste->nom}}</p>
                            </div>
                            <div class="col-md-4">
                                <p class="small mt">STATUT</p>
                                <p>{{$user->statut->titre}}</p>
                            </div>
                        </div>
                    </div>
                </div><!-- /col-md-4 -->
                @include('sidebar')
            </div>
        </div>
    </div>
@endsection
