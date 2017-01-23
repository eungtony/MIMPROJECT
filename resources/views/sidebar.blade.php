@php
    $agence_id = \Illuminate\Support\Facades\Auth::user()->agence_id;
    $agence = \App\Agence::findOrFail($agence_id);
    $agence->load('file', 'users');
    $messages = \App\Message::where('agence_id', Auth::user()->agence_id)->take(5)->orderBy('id', 'desc')->get();
    $user_id = Auth::user()->id;
    $statut_id = Auth::user()->statut_id;
    $agences = \App\Agence::get();
    $events = \App\Events::limit(3)->latest()->get();
    $cdp_id = $agence->user_id;
@endphp
<!--  RIGHT SIDEBAR CONTENT -->
<div class="col-lg-3 ds">
    <!--COMPLETED ACTIONS DONUTS CHART-->
    <h3>DERNIERS EVENEMENTS</h3>
    <!-- First Action -->
    @foreach ($events as $event)
        @php
            $now = \Carbon\Carbon::now();
            $date = \Carbon\Carbon::createFromFormat('Y-m-d', $event->date);
            $difference = $date->diffInDays($now, false);
        @endphp
        @if ($difference < 0)
            <div class="desc" difference="{{ $difference }}">
                <div class="thumb">
                    <span class="badge bg-theme"><i class="fa fa-clock-o"></i></span>
                </div>
                <div class="details">
                    <p>
                        <a href="{{ route('index.event') }}"><strong>{{ $event->title }}</strong></a>
                        <br/>
                        <muted>Prévu à la date : <strong>{{ $event->date }}</strong></muted><br/>
                    </p>
                </div>
            </div>
        @endif
    @endforeach
    <div class="desc">
        <p class="text-center">
            <a href="{{ route('index.event') }}">Voir tous les Events</a>
        </p>
    </div>

    <!-- USERS ONLINE SECTION -->
    <h3>MEMBRES DE L'AGENCE</h3>
    @foreach($agence->users as $user)
        @php
            $statut = \App\Poste::findOrFail($user->poste_id);
        @endphp

        <div class="desc">
            <div class="thumb">
                @if($user->avatar == 0)
                    <img class="img-circle" src="{{ asset('avatars/user.png') }}" width="35px" height="35px"
                         align="">
                @else
                    <img src="{{ asset('avatars/'.$user->id.'.'.$user->extension) }}" class="img-circle" width="35px"
                         height="35px">
                @endif
            </div>
            <div class="details">
                <p>
                    <a href="{{ route('profile', $user->id) }}">{{ $user->name }}</a>
                    
                    <a href="#notify-someone-{{ $user->id }}" class="btn btn-primary btn-xs agence-notif" style="color: white;float: right;" data-toggle="modal" data-target="#notify-someone-{{ $user->id }}">
                        <i class="fa fa-envelope-o"></i>
                    </a>
                </p>
            </div>
        </div>

        @include('notif.notify-someone')

    @endforeach
    <!-- MESSAGES DE L'AGENCE -->
    <h3>MESSAGES DE L'AGENCE</h3>
    @if($messages->isEmpty())
        <p class="alert alert-error">
            Aucun message de publié dans votre agence.
        </p>
    @else
        @foreach($messages as $message)
            <?php $user = \App\User::findOrFail($message->user_id); ?>
            <div class="desc">
                <div class="">
                    <div class="thumb">
                        @if($user->avatar == 0)
                            <img class="img-circle" src="{{ asset('avatars/user.png') }}" width="35px" height="35px"
                                 align="">
                        @else
                            <img src="{{ asset('avatars/'.$user->id.'.'.$user->extension) }}" class="img-circle"
                                 width="35px" height="35px">
                        @endif
                    </div>
                    <a href="#message{{$message->id}}" data-toggle="modal">
                        {{$message->titre}}
                    </a>
                    <p>{{ $message->created_at }}</p>
                </div>
            </div>
            <div class="modal fade" id="message{{$message->id}}" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            {{$message->titre}}
                        </div>
                        <div class="modal-body">
                            {{$message->message}}
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="desc">
            <p class="text-center">
                <a href="#messages" data-toggle="modal">Voir tous les messages</a>
            </p>
        </div>

        @include('agence.messages')

    @endif

    <h3>AUTRES AGENCES</h3>
    @foreach ($agences as $agence)
        <div class="desc">
            <div class="thumb">
                <img class="img-circle" src="{{ asset('avatars/user.png') }}" width="35px" height="35px" align="">
            </div>
            <div class="details">
                <a href="{{ url('agence/' . $agence->id) }}" class="green agence">{{ $agence->nom }}</a>
                <a href="#notify-team-{{ $agence->id }}" class="btn btn-primary btn-xs agence-notif" style="color: white;" data-toggle="modal" data-target="#notify-team-{{ $agence->id }}">
                    <i class="fa fa-envelope-o"></i>
                </a>
            </div>
        </div>

        @include('notif.notify-team')

    @endforeach 
</div><!-- /col-lg-3 -->