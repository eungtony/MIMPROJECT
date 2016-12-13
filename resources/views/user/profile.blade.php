@extends('layouts.application')

@section('content')
    <div class="row mt">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-content">
                <div class="panel-body">
                    @if($user->avatar != 0)
                        <img src="{{asset('/avatars/'.$user->id.'.'.$user->extension)}}" class="img-circle profile-img" width="100"
                             alt="Image de profil">
                    @else
                        <img src="{{ asset('/avatars/user.png') }}" class="img-circle profile-img" width="100"
                             alt="Image de profil">
                    @endif

                    <h1 class="user-name">{{$user->name}}</h1>
                    
                    <div class="user-info">
                        <p>Appartient à l'agence <strong>{{$user->agence->nom}}</strong></p>
                        <p>Et ocupe le poste de : <strong>{{$user->poste->nom}}</strong></p>
                        <p><strong>Description :</strong></p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Id repudiandae, optio enim, eos maiores a accusantium hic amet veritatis commodi perspiciatis omnis nesciunt ipsam voluptatibus sequi consequatur odio laboriosam eaque.</p>
                    </div>

                    <div class="user-options">
                        <a href="{{ url('add/notif/personal/' . $user->id) }}" class="btn btn-primary">
                            <i class="fa fa-envelope fa-fw"></i> Notifié
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection