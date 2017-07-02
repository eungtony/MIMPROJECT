@section('content')

    <div class="row mt">
        <div class="col-lg-12">
            <div class="text-center">
                <h1>{{ $agence->nom }}</h1>

                @if($user_id == $cdp_id || Auth::user()->statut_id == 2)

                    <a href="#agence{{$agence->id}}" class="btn btn-primary btn-xs"
                       data-toggle="collapse" aria-expanded="false"
                       aria-controls="#agence{{$agence->id}}" style="margin-bottom: 15px;">
                        <i class="fa fa-pencil fa-fw"></i> Editer
                    </a>

                    <a href="#projet{{$agence->id}}" class="btn btn-success btn-xs"
                       data-toggle="collapse" aria-expanded="false"
                       aria-controls="#projet{{$agence->id}}" style="margin-bottom: 15px;">
                        <i class="fa fa-plus fa-fw"></i> Projet
                    </a>

                    <a href="#message" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#message"
                       style="margin-bottom: 15px;">
                        <i class="fa fa-envelope fa-fw"></i> Message
                    </a>

                    @include('agence.message')

                    @include('projet.add')

                    @include('agence.edit')

                @endif
            </div>

            <div>
                @if(Route::is('home'))
                    @include('info')
                @section('title') Troyes Point Zéro - Support @endsection
                @else
                @section('title') {{$agence->nom}} - Troyes Point Zéro - Support @endsection
                @endif

            </div>

            <!-- Visite de la page d'une autre agence -->
            @if (isset($members))
                <div class="row" style="padding: 10px;">
                    <div class="col-lg-12">
                        <h3 class="text-center">Membres de l'agence</h3>
                    </div>
                    @foreach ($members as $member)
                        <div class="col-lg-4 col-md-6 col-sm-12l">
                            <div class="panel member-panel mt">
                                <div class="panel-header">
                                    &nbsp;
                                </div>
                                <div class="panel-content">
                                    <p>
                                        @if($member->avatar == 0)
                                            <img src="{{ asset('avatars/user.png') }}" class="img-circle" width="60">
                                        @else
                                            <img src="{{ asset('avatars/'.$member->id.'.'.$member->extension) }}"
                                                 class="img-circle" width="60">
                                        @endif
                                    </p>
                                    <p>
                                        <a href="{{ route('profile', $member->id) }}">
                                            <strong>{{ $member->name }}</strong>
                                        </a>
                                    </p>
                                    <p class="description">{{ $member->description }}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        </ul>
                </div>
            @else
                <div class="alert alert-danger">
                    Aucun membre.
                </div>
                @endif
                        <!-- Visite de la page d'une autre agence -->

                @if(Auth::user()->agence_id == $agence->id)
                    <div class="row">
                        <div class="col-lg-12 portlets">
                            <div id="website-statistics1" class="widget">
                                <div class="widget-header transparent">
                                    <h2><i class="icon-share"></i> Fichiers <strong>Partagés</strong></h2>
                                </div>
                                <div class="widget-panel upload-panel" style="padding: 15px">
                                    <!-- TELECHARGEMENT -->

                                    @php
                                    $files = \App\File::where('agence_id', $agence->id)->where('projet_id',
                                    NULL)->get();
                                    @endphp

                                    @if(!$files->isEmpty())
                                        @foreach($files as $file)
                                            <a href="{{app_path()}}/{{$agence->id}}/{{$file->name}}.{{$file->extension}}"
                                               download="{{$file->titre}}">
                                                {{$file->titre}}
                                            </a>
                                            <a href="#editFile{{$file->id}}" data-toggle="collapse"
                                               class="btn btn-primary btn-xs">Modifier
                                                le fichier</a>
                                            @if($user_id == $cdp_id)
                                                @include('agence.editFile')
                                            @endif
                                        @endforeach
                                    @else
                                        <p>
                                            <span class="btn btn-danger btn-xs"><strong>Aucun fichier
                                                    partagé</strong></span>
                                        </p>
                                        </span>
                                    @endif

                                    <hr>
                                    <a href="#file" class="btn btn-primary btn-sm"
                                       data-toggle="collapse" aria-expanded="false"
                                       aria-controls="#file">
                                        Téléverser un fichier
                                    </a>

                                    @include('agence.file')
                                            <!-- TELECHARGEMENT -->
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <h2 class="text-center project-title" style="margin-bottom: 40px;">Projets de l'agence</h2>

        </div>
        <div class="row">
            <div class="col-lg-12 portlets">
                @if($projets->isEmpty())
                    <p class="alert alert-warning text-center">
                        Aucun projet n'a été crée !
                    </p>
                @else

                    @foreach ($projets as $projet)
                        @php
                        $taches = \App\Travail::where('projet_id', $projet->id)->orderBy('id', 'desc')->get();
                        if (request()->only('sort')['sort'] == 'date') {
                        $taches = \App\Travail::where('projet_id', $projet->id)->orderBy('date', 'asc')->get();
                        } elseif (request()->only('sort')['sort'] == 'category') {
                        $taches = \App\Travail::where('projet_id', $projet->id)->orderBy('categorie_id', 'asc')->get();
                        } elseif (request()->only('sort')['sort'] == 'done') {
                        $taches = \App\Travail::where('projet_id', $projet->id)->orderBy('fait', 'desc')->get();
                        }
                        $taches->load('user');
                        $users = \App\User::where('agence_id', $projet->agence_id)->get();
                        $done = \App\Travail::where('projet_id', $projet->id)->where('fait', 1)->get()->count();
                        $total = \App\Travail::where('projet_id', $projet->id)->get()->count();
                        $projet_heures = \App\HeuresTaches::where('projet_id', $projet->id)->get();
                        $heures_notees = 0;
                        foreach ($projet_heures as $heure) {
                        $heures_notees = $heures_notees + $heure->heures;
                        }
                        $pc = 0;
                        $pc_projet = 0;
                        $heures = 0;

                        if ($total_etape > 0) {
                        $pc_projet = 100 * $projet->etape_id / $total_etape;
                        }

                        if ($total > 0) {
                        $pc = 100 * $done / $total;
                        }
                        if ($projet->total_heures > 0) {
                        $heures = 100 * $heures_notees / $projet->total_heures;
                        }

                        $etape = "Le projet n'a pas encore commencé";
                        if ($projet->etape_id > 0) {
                        $etape = \App\Etape::findOrFail($projet->etape_id);
                        }
                        @endphp

                        <div id="website-statistics1" class="widget">
                            <div class="widget-header transparent">
                                <h2><i class="icon-bag"></i> Projet : <strong>{{ $projet->nom }}</strong></h2>
                                <div class="additional-btn">
                                    <a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>
                                    <a href="#" class="widget-close"><i class="icon-cancel-3"></i></a>
                                </div>
                            </div>
                            <div class="widget-content" style="display: none;">
                                <div id="website-statistic" class="statistic-chart">
                                    <div class="row stacked">
                                        <div class="col-sm-12">
                                            <div class="toolbar">
                                                <!-- Space for additional features -->
                                            </div>
                                            <div class="clearfix"></div>
                                            <div style="padding: 15px;">
                                                @if($user_id == $cdp_id)
                                                    <a href="#addtask{{$projet->id}}" data-toggle="modal"
                                                       data-target="#addtask{{$projet->id}}"
                                                       class="btn btn-success btn-xs" style="margin-bottom: 15px;">Ajouter
                                                        une tache</a>
                                                    <a class="btn btn-primary btn-xs"
                                                       style="margin-bottom: 15px;margin-left: 20px;"
                                                       href="#edit{{$projet->id}}" data-toggle="modal"
                                                       aria-controls="#edit{{$projet->id}}">Editer projet</a>
                                                    <a class="btn btn-danger btn-xs" style="margin-bottom: 15px;"
                                                       href="{{ route('projet.destroy', [$agence->id, $projet->id]) }}"
                                                       data-method="delete"
                                                       data-confirm="Voulez-vous réellement supprimer ce projet ?">Supprimer
                                                        projet</a>
                                                    @include('projet.edit')
                                                    @include('tache.add')
                                                @endif
                                                <div class="title">
                                                    <h4>Description du projet :</h4>
                                                    <p>{{ $projet->commentaire }}</p>
                                                    <hr>
                                                </div>
                                                <div>
                                                    <h4 class="project-title">Progression dans les tâches :
                                                        <strong>
                                                            {{$heures_notees}}h / {{$projet->total_heures}}h -
                                                        </strong>
                                                        <strong>
                                                            @if (round($pc) < 50)
                                                                <span class="text-danger">{{ round($pc) }} %</span>
                                                            @elseif (round($pc) >= 50 && round($pc) < 75)
                                                                <span class="text-warning">{{ round($pc) }} %</span>
                                                            @else
                                                                <span class="text-success">{{ round($pc) }} %</span>
                                                            @endif
                                                        </strong>
                                                    </h4>
                                                    <hr>
                                                </div>
                                                <div class="title">
                                                    <h4>Tâches relatives au projet :</h4>
                                                    <hr>
                                                </div>

                                                @php
                                                $taskDone = \App\Travail::where('projet_id', $projet->id)
                                                ->where('fait', 1)->get()->count();
                                                $totalTask = \App\Travail::where('projet_id',
                                                $projet->id)->get()->count();
                                                @endphp

                                                @if($taskDone != $totalTask)
                                                    <div class="table-responsive">
                                                        <table data-sortable class="table">
                                                            <thead>
                                                            <tr>
                                                                <th>N°</th>
                                                                <th>Description</th>
                                                                <th>Etat</th>
                                                                <th>Attribué à</th>
                                                                <th>Type</th>
                                                                <th>Délai</th>
                                                                @if($user_id == $cdp_id)
                                                                    <th data-sortable="false">Option</th>
                                                                @endif
                                                            </tr>
                                                            </thead>
                                                            @foreach($taches as $tache)
                                                                @php
                                                                $date = \Carbon\Carbon::createFromFormat('Y-m-d',
                                                                $tache->date);
                                                                $difference = ($date->diff($now)->days < 1) ? 'today' :
                                                                $date->diffInDays($now);
                                                                @endphp
                                                                <tr>
                                                                    <td>{{ $tache->id }}</td>
                                                                    <td>{{ $tache->titre }}</td>
                                                                    <td>
                                                                        @if($tache->fait == 0)
                                                                            <span class="label label-danger">A Faire</span>
                                                                        @else
                                                                            <span class="label label-success">Fait</span>
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        @if($tache->user)
                                                                            <strong>{{$tache->user->name}}</strong>
                                                                        @else
                                                                            <strong>Aucune personne assignée</strong>
                                                                        @endif
                                                                    </td>
                                                                    <td>{{ $tache->categorie->titre }}</td>
                                                                    <td>
                                                                        @if ($tache->fait == 0)
                                                                            J - {{ $difference }}
                                                                        @else
                                                                            -
                                                                        @endif
                                                                    </td>
                                                                    @if($user_id == $cdp_id)
                                                                        <td>
                                                                            <div class="btn-group btn-group-xs">
                                                                                <a href="{{action('tacheController@destroy', $tache->id)}}"
                                                                                   data-method="delete"
                                                                                   data-confirm="Souhaitez-vous réellement supprimer cette tâche ?"
                                                                                   class="btn btn-danger btn-xs"><i
                                                                                            class="fa fa-power-off"></i></a>
                                                                                <a href="#tache{{$tache->id}}"
                                                                                   class="btn btn-primary btn-xs"
                                                                                   data-toggle="modal"
                                                                                   aria-controls="#tache{{$tache->id}}"><i
                                                                                            class="fa fa-edit"></i></a>
                                                                            </div>
                                                                        </td>
                                                                    @endif
                                                                </tr>
                                                                @if($user_id == $cdp_id)
                                                                    @include('tache.edit')
                                                                @endif
                                                            @endforeach
                                                        </table>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @endforeach

                @endif
            </div>
        </div>
@endsection