@extends('layouts.application')

@php
    // Variable qui contiendra les noms
    $name = [];
    // On rempli le tableau
    foreach ($users as $user) { $name[$user->id] = $user->name; }
@endphp

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">

                @foreach ($notifs as $notif)
                    <!-- Récupération des avatar -->
                    @php
                        $user = \App\User::findOrFail($notif->sender);
                        $user_id = 'user';
                        $user_extension = 'png';
                        if ($user->avatar) {
                            $user_id = $user->id;
                            $user_extension = $user->extension;
                        }
                    @endphp
                    <!-- Récupération des avatar -->
                    <!-- On verifie que les noifications sont destinées à l'utilisateur ou son équipe -->
                    @if ($notif->type == 'team' && $notif->to == Auth::user()->agence_id)
                        <div class="form-panel">
                            <p class="photo"><img alt="avatar" src="{{ asset('avatars/'.$user_id.'.'.$user_extension) }}" class="img-circle" style="max-width: 50px;"></p>
                            <p class="subject">
                            <p class="from">{{ $name[$notif->sender] }}</p>
                            <p class="time">{{ $notif->created_at }}</p>
                            </p>
                            <p class="message">
                                {{ $notif->message }}
                            </p>
                            <a href="{{ url('delete/notif/' . $notif->id) }}" class="btn btn-danger btn-xs fa fa-trash-o"></a>
                            <a href="{{ url('add/notif/' . $notif->type . '/' . $notif->sender) }}" class="btn btn-primary btn-xs fa fa-reply"></a>
                        </div>
                    <!-- On verifie que les notifications sont destinées personnellement à l'utilsateur -->
                    @elseif($notif->type == 'personal' && $notif->to == Auth::user()->id)
                        <div class="form-panel">
                            <p class="photo"><img alt="avatar" src="{{ asset('avatars/'.$user_id.'.'.$user_extension) }}" class="img-circle" style="max-width: 50px;"></p>
                            <p class="subject">
                            <p class="from">{{ $name[$notif->sender] }}</p>
                            <p class="time">{{ $notif->created_at }}</p>
                            </p>
                            <p class="message">
                                {{ $notif->message }}
                            </p>
                            <a href="{{ url('delete/notif/' . $notif->id) }}" class="btn btn-danger btn-xs fa fa-trash-o"></a>
                            <a href="{{ url('add/notif/' . $notif->type . '/' . $notif->sender) }}" class="btn btn-primary btn-xs fa fa-reply"></a>
                        </div>
                    <!-- On verifie si les notifications sont pour tout le monde -->
                    @elseif($notif->type == 'global')
                        <div class="form-panel">
                            <p class="photo"><img alt="avatar" src="{{ asset('avatars/'.$user_id.'.'.$user_extension) }}" class="img-circle" style="max-width: 50px;"></p>
                            <p class="subject">
                            <p class="from">{{ $name[$notif->sender] }}</p>
                            <p class="time">{{ $notif->created_at }}</p>
                            </p>
                            <p class="message">
                                {{ $notif->message }}
                            </p>
                            <a href="{{ url('delete/notif/' . $notif->id) }}" class="btn btn-danger btn-xs fa fa-trash-o"></a>
                        </div>
                    @endif
                @endforeach
                    
            </div>
        </div>
    </div>
@endsection
