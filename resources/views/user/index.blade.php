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
                            <span>
                                <a href="#avatar" class="btn btn-primary btn-xs" data-toggle="modal"
                                   data-target="#avatar">
                                    Changer mon avatar
                                </a>
                            </span>
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
                    <hr>
                </div><!-- /col-md-4 -->
                @include('sidebar')
            </div>
        </div>
    </div>

    <!-- MODAL -->
    <div class="modal fade" id="avatar" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    Modifier mon avatar
                </div>
                <div class="modal-body text-center">

                    <h3>Votre avatar</h3>
                    <hr>
                    @if(Auth::user()->avatar == 0)
                        <img src="{{ asset('avatars/user.png') }}" alt="default" class="img-circle" width="60">
                    @else
                        <img src="{{ asset('avatars/'.Auth::user()->id.'.'.Auth::user()->extension) }}" alt="default"
                             class="img-circle" width="60">
                    @endif
                    <hr>
                    <form action="{{route('user.avatar', Auth::user())}}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="form-group">
                            <input type="file" class="form-control" name="avatar">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Modifier votre avatar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
