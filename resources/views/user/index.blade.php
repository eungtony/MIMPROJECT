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
                                <li class="active">
                                    <a href="#">
                                    <i class="fa fa-user"></i>
                                    A propos </a>
                                </li>
                                <li>
                                    <a href="#">
                                    <i class="fa fa-cogs"></i>
                                    Paramètres de compte </a>
                                </li>
                                <li>
                                    <a href="#">
                                    <i class="fa fa-check"></i>
                                    Tâches </a>
                                </li>
                                <li>
                                    <a href="#">
                                    <i class="fa fa-question"></i>
                                    Aide </a>
                                </li>
                            </ul>
                        </div>
                        <!-- END MENU -->
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="profile-content panel-content">
                        <p style="font-size:24px">Description</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ut cumque iure temporibus molestias aspernatur. Quo praesentium quibusdam quaerat eos, deleniti dolorem sint expedita omnis similique veniam eveniet repellendus. Recusandae, sequi!</p>
                        <p>Totam voluptatum id explicabo voluptatibus recusandae, nobis laboriosam iure repudiandae minima autem rem accusamus voluptas quos laudantium eaque, praesentium aut molestias libero officiis repellendus veniam eos fugiat officia. Assumenda, eum?</p>
                        <p>Expedita sequi reiciendis voluptas dicta saepe possimus, quas temporibus, porro eius vero corporis hic enim, quaerat sint incidunt similique sunt placeat accusantium officia, nesciunt tempore fugit! Atque incidunt similique, quo.</p>
                        <p>Voluptas, vitae. Earum distinctio harum doloribus temporibus est soluta provident sunt, tenetur suscipit iste, laboriosam quae inventore sapiente magni exercitationem nesciunt nobis, consequatur nostrum ad. Magni nulla, autem quibusdam id.</p>
                        <a href="#description" class="btn btn-success btn-sm" type="button" data-toggle="modal"
                           data-target="#description">
                            <i class="fa fa-cogs fa-fw"></i> Modifier ma description
                        </a>
                    </div>
                </div>

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

    <div class="modal fade" id="description" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    Modifier ma Description
                </div>
                <div class="modal-body text-center">

                    <h3>Votre Description</h3>
                    <form action="{{route('user.avatar', Auth::user())}}" method="POST" enctype="multipart/form-data">
                        
                        {{csrf_field()}}

                         <div class="form-group">
                            <textarea name="message" id="" cols="30" rows="10" class="form-control"></textarea>
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
