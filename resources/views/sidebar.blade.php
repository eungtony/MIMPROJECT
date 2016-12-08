@php
    $agence_id = \Illuminate\Support\Facades\Auth::user()->agence_id;
    $agences = \App\Agence::get();
    $agence = \App\Agence::findOrFail($agence_id);
    $agence->load('file', 'users');
    $messages = \App\Message::where('agence_id', Auth::user()->agence_id)->take(5)->orderBy('id', 'desc')->get();
@endphp

<!--  RIGHT SIDEBAR CONTENT -->
<div class="col-lg-3 ds">
    <!--COMPLETED ACTIONS DONUTS CHART-->
    <h3>EVENEMENTS</h3>
    <!-- First Action -->
    <div class="desc">
        <div class="thumb">
            <span class="badge bg-theme"><i class="fa fa-clock-o"></i></span>
        </div>
        <div class="details">
            <p>
                <muted>2 Minutes Ago</muted>
                <br/>
                <a href="#">James Brown</a> subscribed to your newsletter.<br/>
            </p>
        </div>
    </div>
    <!-- USERS ONLINE SECTION -->
    <h3>MEMBRES</h3>
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
                    -
                    <a href="{{ url('add/notif/personal/' . $user->id) }}" class="fa fa-envelope fa-fw"></a><br/>
                    <muted>{{$statut['nom']}}</muted>
                </p>
            </div>
        </div>
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
                <div class="details">
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
                    <p class="text-right">
                        {{$message->created_at}}
                        @if($user_id == $cdp_id || $statut_id == 1)
                            <a href="{{action('agenceController@deleteMessage', [$message->agence_id,$message->id])}}"
                               data-method="delete"
                               data-confirm="Souhaitez-vous réellement supprimer ce message ?"
                               class="btn btn-danger btn-xs" style="color:white;"><i class="fa fa-trash-o"></i></a>
                        @endif
                    </p>
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
    <div class="desc">
        <div class="details">
            <ul>
                @foreach ($agences as $agence)
                    <li>
                        <a href="{{ url('agence/' . $agence->id) }}" class="green">{{ $agence->nom }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div><!-- /col-lg-3 -->