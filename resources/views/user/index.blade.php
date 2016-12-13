@extends('layouts.application')

@section('content')
    <div class="row mt">
        <div class="col-lg-12">
            <div class="row">
               
               <div class="col-md-3">
                    <div class="profile-sidebar content-panel">
                        <!-- SIDEBAR USERPIC -->
                        <div class="profile-userpic">
                            @if($user->avatar != 0)
                                <img src="{{asset('/avatars/'.$user->id.'.'.$user->extension)}}" class="img-circle img-responsive img-profile"
                                     alt="Image de profil" width="100px">
                            @else
                                <img src="{{ asset('/avatars/user.png') }}" class="img-circle profile-img" width="100"
                                     alt="Image de profil" width="100px">
                            @endif
                        </div>
                        <!-- END SIDEBAR USERPIC -->
                        <!-- SIDEBAR USER TITLE -->
                        <div class="profile-usertitle">
                            <div class="profile-usertitle-name">
                                {{ $user->name }}
                            </div>
                            <div class="profile-usertitle-job">
                                {{ $user->poste->nom }} | {{ $user->statut->titre }}
                            </div>
                        </div>
                        <!-- END SIDEBAR USER TITLE -->
                        <!-- SIDEBAR BUTTONS -->
                        <div class="profile-userbuttons">
                            <a href="#avatar" class="btn btn-success btn-sm" type="button" data-toggle="modal"
                               data-target="#avatar">
                                <i class="fa fa-picture-o fa-fw"></i> Avatar
                            </a>
                            <a href="{{ url('add/notif/personal/' . $user->id) }}" type="button" class="btn btn-primary btn-sm">
                                <i class="fa fa-envelope fa-fw"></i> Notifié
                            </a>
                        </div>
                        <!-- END SIDEBAR BUTTONS -->
                        <!-- SIDEBAR MENU -->
                        <div class="profile-usermenu">
                            <ul class="nav">
                                <li class="active" id="apropos-panel">
                                    <a href="#" id="apropos">
                                    <i class="fa fa-user"></i>
                                    A propos </a>
                                </li>
                                <li id="parameters-panel">
                                    <a href="#" id="parameters">
                                    <i class="fa fa-cogs"></i>
                                    Paramètres <span class="badge badge-xs coming">Coming</span></a>
                                </li>
                                <li id="taches-panel">
                                    <a href="#" id="taches">
                                    <i class="fa fa-check"></i>
                                    Tâches </a>
                                </li>
                                <li id="help-panel">
                                    <a href="#" id="help">
                                    <i class="fa fa-question"></i>
                                    Aide <span class="badge badge-xs coming">Coming</span></a>
                                </li>
                            </ul>
                        </div>
                        <!-- END MENU -->
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="profile-content content-panel">
                        
                        <div id="apropos-content">
                            <p style="font-size:24px">Description</p>
                            <p>{{ $user->description }}</p>
                            <a href="#description" class="btn btn-success btn-sm" type="button" data-toggle="modal"
                               data-target="#description">
                                <i class="fa fa-cogs fa-fw"></i> Modifier ma description
                            </a>
                        </div>
                        
                        <div id="taches-content" style="display: none;">
                            <table class="table table-striped">
                            <thead>
                              <tr>
                                  <th>Titre</th>
                                  <th>Catégorie</th>
                                  <th>Projet associé</th>
                                  <th>Remaining Time</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($taches as $tache)
                                    @php
                                        $date = \Carbon\Carbon::createFromFormat('Y-m-d', $tache->date);
                                        $difference = ($date->diff($now)->days < 1) ? 'today' : $date->diffInDays($now);
                                    @endphp

                                    <tr>
                                        <td>
                                            <a href="#voirtache{{$tache->id}}" data-toggle="modal">
                                              {{$tache->titre}}
                                            </a>
                                        </td>
                                        <td>
                                            <span class="label label-danger">{{$tache->categorie->titre}}</span>
                                        </td>
                                        <td>
                                            <span class="label label-primary ">{{$tache->projet->nom}}</span>
                                        </td>
                                        <td>
                                            @if($difference > 0)
                                                <span class="label label-info">J - {{ $difference }}</span>
                                            @else
                                                <span class="label label-danger">{{ $difference }} jours
                                                    de retard !!</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Inclusion de la sidebar -->
                @include('sidebar')
                <!-- Inclusion de la sidebar -->

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

    <div class="modal fade" id="description" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    Modifier ma Description
                </div>
                <div class="modal-body text-center">

                    <h3>Votre Description</h3>
                    <form action="{{ url('user/description/' . $user->id) }}" method="POST">
                        
                        {{csrf_field()}}

                         <div class="form-group">
                            <textarea name="description" id="" cols="30" rows="10" class="form-control">
                                {{ $user->description }}
                            </textarea>
                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Modifier</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
