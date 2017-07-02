@extends('layouts.version-2.layouts.app')

@php
    // Variable qui contiendra les noms
    $name = [];
    // On rempli le tableau
    foreach ($users as $user) { $name[$user->id] = $user->name; }
@endphp

@section('content')
    <div class="container">
        <div class="row" style="padding-right: 50px;">

                <h3 class="notif-title">> Show Notifications</h3>

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
                        <div class="col-lg-6">
                            <div class="widget content-panel notif-panel" style="padding: 8px;">
                                <div class="block">
                                    <div class="notif-avatar">
                                        <img alt="avatar" src="{{ asset('avatars/'.$user_id.'.'.$user_extension) }}" class="img-circle" style="max-width: 50px;">
                                    </div>
                                    <div class="info-notif">
                                        <p><strong>{{ $name[$notif->sender] }}</strong></p>
                                        <p>{{ $notif->created_at }}</p>
                                    </div>
                                    <div class="notif-options">
                                        <a href="{{ url('delete/notif/' . $notif->id) }}" class="btn btn-danger btn-xs fa fa-trash-o"></a>
                                        <a href="{{ url('add/notif/' . $notif->type . '/' . $notif->sender) }}" class="btn btn-primary btn-xs fa fa-reply"></a>
                                    </div>
                                </div>
                                <div class="block">
                                    <div class="notif-message">
                                        <p><strong>MESSAGE :</strong> {{ $notif->message }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!-- On verifie que les notifications sont destinées personnellement à l'utilsateur -->
                    @elseif($notif->type == 'personal' && $notif->to == Auth::user()->id)
                        <div class="col-lg-6">
                            <div class="widget content-panel notif-panel" style="padding: 8px;">
                                <div class="block">
                                    <div class="notif-avatar">
                                        <img alt="avatar" src="{{ asset('avatars/'.$user_id.'.'.$user_extension) }}" class="img-circle" style="max-width: 50px;">
                                    </div>
                                    <div class="info-notif">
                                        <p><strong>{{ $name[$notif->sender] }}</strong></p>
                                        <p>{{ $notif->created_at }}</p>
                                    </div>
                                    <div class="notif-options">
                                        <a href="{{ url('delete/notif/' . $notif->id) }}" class="btn btn-danger btn-xs fa fa-trash-o"></a>
                                        <a href="{{ url('add/notif/' . $notif->type . '/' . $notif->sender) }}" class="btn btn-primary btn-xs fa fa-reply"></a>
                                    </div>
                                </div>
                                <div class="block">
                                    <div class="notif-message">
                                        <p><strong>MESSAGE :</strong> {{ $notif->message }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!-- On verifie si les notifications sont pour tout le monde -->
                    @elseif($notif->type == 'global')
                        <div class="col-lg-6">
                            <div class="widget content-panel notif-panel" style="padding: 8px;">
                                <div class="block">
                                    <div class="notif-avatar">
                                        <img alt="avatar" src="{{ asset('avatars/'.$user_id.'.'.$user_extension) }}" class="img-circle" style="max-width: 50px;">
                                    </div>
                                    <div class="info-notif">
                                        <p><strong>{{ $name[$notif->sender] }}</strong></p>
                                        <p>{{ $notif->created_at }}</p>
                                    </div>
                                    <div class="notif-options">
                                        @if ($notif->sender == Auth::user()->id)
                                             <a href="{{ url('delete/notif/' . $notif->id) }}" class="btn btn-danger btn-xs fa fa-trash-o"></a>
                                        @endif
                                    </div>
                                </div>
                                <div class="block">
                                    <div class="notif-message">
                                        <p><strong>MESSAGE :</strong> {{ $notif->message }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
                
        </div>
    </div>
@endsection
