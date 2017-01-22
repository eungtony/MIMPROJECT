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
$bureau_id = 2;
$ca_id = 1;
$projets = \App\Projet::where('agence_id', 0)->get();
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
                        <muted>Prévu à la date : <strong>{{ $event->date }}</strong></muted>
                        <br/>
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

                    <a href="#notify-someone-{{ $user->id }}" class="btn btn-primary btn-xs agence-notif"
                       style="color: white;float: right;" data-toggle="modal"
                       data-target="#notify-someone-{{ $user->id }}">
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

                    <!-- <h3>AUTRES AGENCES</h3>
        @foreach ($agences as $agence)
                    <div class="desc">
                        <div class="details">
                            <a href="{{ url('agence/' . $agence->id) }}" class="green agence">{{ $agence->nom }}</a>
                    <a href="#notify-team-{{ $agence->id }}" class="btn btn-primary btn-xs agence-notif"
                       style="color: white;" data-toggle="modal" data-target="#notify-team-{{ $agence->id }}">
                        <i class="fa fa-envelope"></i>
                    </a>
                </div>
            </div>

            @include('notif.notify-team')

            @endforeach -->

            <h3>PROJETS LIBRES</h3>
            @foreach($projets as $project)
                <?php
                $propose = \App\Projet_agence::where('projet_id', $project->id)->where('agence_id', $agence_id)->get();
                $propose_id = 0;
                if (!$propose->isEmpty()) {
                    $propose_id = $propose[0]->id;
                }
                ?>
                <div class="desc">
                    <div class="details" style="padding:10px;">
                        <a href="#project{{$project->id}}" data-toggle="modal">{{$project->nom}}</a>
                        <p>{{substr($project->commentaire, 0, 50)}}</p>
                        @if($user_id == $cdp_id)
                            @if($propose->isEmpty())
                                <form action="{{route('add.projet.agence', [$project->id, Auth::user()->agence_id])}}"
                                      method="POST">
                                    {{csrf_field()}}
                                    <div class="form-group text-right">
                                        <button type="submit" class="btn btn-success btn-xs">
                                            Proposer mon agence !
                                        </button>
                                    </div>
                                </form>
                            @else
                                <div class="text-right">
                                    <a
                                            href="{{route('delete.projet.agence', $propose_id)}}"
                                            data-method="delete"
                                            data-confirm="Souhaitez-vous réellement vous désistez ?"
                                            class="btn btn-danger btn-xs"
                                            style="color:white;"
                                    >
                                        Me désister
                                    </a>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>

                <div class="modal fade" id="project{{$project->id}}" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                {{$project->nom}}
                                @if($statut_id == $bureau_id || $statut_id == $ca_id)
                                    <a href="#editProject{{$project->id}}" data-toggle="collapse"
                                       class="btn btn-primary btn-xs">Modifier</a>
                                @endif
                            </div>
                            <div class="modal-body">
                                {{$project->commentaire}}
                                <h4>Liste des agences qui se sont proposées</h4>
                                <?php
                                $propose_projet = \App\Projet_agence::where('projet_id', $project->id)->get();
                                ?>
                                @if(!$propose_projet->isEmpty())
                                    <ul>
                                        @foreach($propose_projet as $agency)
                                            <li>
                                                {{$agency->nom_agence}}
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <div class="alert alert-warning">
                                        Aucune agence ne s'est proposée !
                                    </div>
                                @endif
                                @if($user_id == $cdp_id)
                                    @if($propose->isEmpty())
                                        <form action="{{route('add.projet.agence', [$project->id, Auth::user()->agence_id])}}"
                                              method="POST">
                                            {{csrf_field()}}
                                            <div class="form-group text-right">
                                                <button type="submit" class="btn btn-success btn-xs">
                                                    Proposer mon agence !
                                                </button>
                                            </div>
                                        </form>
                                    @else
                                        <div class="text-right">
                                            <a
                                                    href="{{route('delete.projet.agence', $propose_id)}}"
                                                    data-method="delete"
                                                    data-confirm="Souhaitez-vous réellement vous désistez ?"
                                                    class="btn btn-danger btn-xs"
                                                    style="color:white;"
                                            >
                                                Me désister
                                            </a>
                                        </div>
                                    @endif
                                @endif
                                @if($statut_id == $bureau_id || $statut_id == $ca_id)
                                    <h4>Attribuez ce projet à une agence</h4>
                                    <form action="{{route('attribute.project', [$project->id])}}" method="POST">
                                        {{csrf_field()}}
                                        <div class="form-group">
                                            <select class="form-control" name="agence_id">
                                                @foreach($propose_projet as $agency)
                                                    <option value="{{$agency->agence_id}}">{{$agency->nom_agence}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">
                                                Attribuez le projet
                                            </button>
                                        </div>
                                    </form>
                                    <div class="collapse" id="editProject{{$project->id}}">
                                        <hr>
                                        <form action="{{route('edit.free.project', [$project->id])}}" method="POST">
                                            {{csrf_field()}}
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="nom"
                                                       value="{{$project->nom}}">
                                            </div>
                                            <div class="form-group">
                                            <textarea name="commentaire" class="form-control" cols="30" rows="10">
                                                {{$project->commentaire}}
                                            </textarea>
                                            </div>
                                            <div class="form-group">
                                                <button class="btn btn-primary" type="submit">
                                                    Modifier le projet
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
</div><!-- /col-lg-3 -->