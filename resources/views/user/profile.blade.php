@extends('layouts.application')

@section('content')
    <div class="row mt">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">{{$user->name}}</div>

                <div class="panel-body">
                    @if($user->avatar != 0)
                        <img src="{{asset('/avatars/'.$user->id.'.'.$user->extension)}}" class="img-circle" width="100"
                             alt="">
                    @else
                        <img src="{{asset('/avatars/user.png')}}" class="img-circle" width="100"
                             alt="">
                    @endif
                        <h1>{{$user->name}}</h1>
                        <h2>Appartient à l'agence {{$user->agence->nom}}</h2>
                        <h3>{{$user->poste->nom}}</h3>
                </div>
            </div>
        </div>
    </div>
@endsection