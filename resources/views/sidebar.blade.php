@php
    $agence_id = \Illuminate\Support\Facades\Auth::user()->agence_id;
    $agence = \App\Agence::findOrFail($agence_id);
    $agence->load('file', 'users');
    $messages = \App\Message::where('agence_id', Auth::user()->agence_id)->take(5)->orderBy('id', 'desc')->get();
    $user_id = Auth::user()->id;
    $statut_id = Auth::user()->statut_id;
    $agences = \App\Agence::get();
    $events = \App\Events::get();
    $subscribers = \App\EventSubscriber::get();
    $cdp_id = $agence->user_id;
@endphp
<!--  RIGHT SIDEBAR CONTENT -->
<div class="col-lg-3 ds">
    <!--COMPLETED ACTIONS DONUTS CHART-->
    <h3>EVENEMENTS</h3>
    <!-- First Action -->
    @foreach ($events as $event)
        <div class="desc">
            <div class="thumb">
                <span class="badge bg-theme"><i class="fa fa-clock-o"></i></span>
            </div>
            <div class="details">
                <p>
                    <a href=""><strong>{{ $event->title }}</strong></a>
                    <br/>
                    <muted>{{ $event->date }}</muted><br/>
                </p>
            </div>
            <div class="subscribe">
                @if (count($subscribers) == 0)
                    <a href="{{ url('register/event/' . $event->id . '/' . Auth::user()->id) }}" class="btn btn-success btn-xs agence-notif" style="color: white;margin-left: 85px;margin-top: 10px;">
                        <strong>JE M'INSCRIS</strong>
                    </a>
                @else
                    @foreach ($subscribers as $subscriber)
                        @if ($subscriber->event_id == $event->id && $subscriber->subscriber_id == Auth::user()->id)
                            <a href="{{ url('unregister/event/' . $event->id . '/' . Auth::user()->id) }}" class="btn btn-danger btn-xs agence-notif" style="color: white;margin-left: 85px;margin-top: 10px;">
                                <strong>JE RAGEQUIT</strong>
                            </a>
                        @else
                            <a href="{{ url('register/event/' . $event->id . '/' . Auth::user()->id) }}" class="btn btn-success btn-xs agence-notif" style="color: white;margin-left: 85px;margin-top: 10px;">
                                <strong>JE M'INSCRIS</strong>
                            </a>
                        @endif
                    @endforeach
                @endif
            </div>
        </div>
    @endforeach
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
                        <i class="fa fa-envelope"></i>
                    </a>
                </p>
            </div>
        </div>

        @include('notif.notify-someone')

    @endforeach
    <!-- MESSAGES DE L'AGENCE -->
    <h3>MESSAGES DE VOTRE AGENCE</h3>
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
            <div class="details">
                <a href="{{ url('agence/' . $agence->id) }}" class="green agence">{{ $agence->nom }}</a>
                <a href="#notify-team-{{ $agence->id }}" class="btn btn-primary btn-xs agence-notif" style="color: white;" data-toggle="modal" data-target="#notify-team-{{ $agence->id }}">
                    <i class="fa fa-envelope"></i>
                </a>
            </div>
        </div>

        @include('notif.notify-team')

    @endforeach 
</div><!-- /col-lg-3 -->