@extends('layouts.application')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="form-panel">

                    @foreach ($notifs as $notif)
                        <!-- On verifie que les noifications sont destinées à l'utilisateur ou son équipe -->
                        @if ($notif->type == 'team' && $notif->to == Auth::user()->agence_id)
                            <a href="">
                                <span class="photo"><img alt="avatar" src="{{ asset('img/ui-zac.jpg') }}"></span>
                                <span class="subject">
                                <span class="from">{{ $notif->sender }}</span>
                                <span class="time">{{ $notif->created_at }}</span>
                                </span>
                                <span class="message">
                                    {{ $notif->message }}
                                </span>
                            </a>
                        <!-- On verifie que les notifications sont destinées personnellement à l'utilsateur -->
                        @elseif($notif->type == 'personnal' && $notif->to == Auth::user()->id)
                            <a href="">
                                <span class="photo"><img alt="avatar" src="{{ asset('img/ui-zac.jpg') }}"></span>
                                <span class="subject">
                                <span class="from">{{ $notif->sender }}</span>
                                <span class="time">{{ $notif->created_at }}</span>
                                </span>
                                <span class="message">
                                    {{ $notif->message }}
                                </span>
                            </a>
                        <!-- On verifie si les notifications sont pour tout le monde -->
                        @elseif($notif->type == 'global')
                            <a href="">
                                <span class="photo"><img alt="avatar" src="{{ asset('img/ui-zac.jpg') }}"></span>
                                <span class="subject">
                                <span class="from">{{ $notif->sender }}</span>
                                <span class="time">{{ $notif->created_at }}</span>
                                </span>
                                <span class="message">
                                    {{ $notif->message }}
                                </span>
                            </a>
                        @endif
                    @endforeach
                    
                </div>
            </div>
        </div>
    </div>
@endsection
