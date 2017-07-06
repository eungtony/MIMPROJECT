@section('content')

    <div class="row mt">
        <div class="col-lg-9">
            <div class="text-center">
                <h1>{{ $agence->nom }}</h1>

                @if($user_id == $cdp_id || $statut_id == 2 || Auth::user()->statut_id == 2)

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
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="content-panel member-panel">
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
                                    <p>
                                        <a href="#notify-someone-{{ $member->id }}" data-toggle="modal" data-target="#notify-someone-{{ $member->id }}" class="btn btn-primary btn-sm">
                                            <i class="fa fa-envelope-o f-fw"></i> NOTIFIE
                                        </a>
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </ul>
                </div>
            @endif
        <!-- Visite de la page d'une autre agence -->
        
            @if(Auth::user()->agence_id == $agence->id)
                <div class="content-panel upload-panel">
                    <!-- TELECHARGEMENT -->
                    <h3 class="upload-title">Fichiers partagés</h3>

                    <?php $files = \App\File::where('agence_id', $agence->id)->where('projet_id', NULL)->get(); ?>

                    @if(!$files->isEmpty())
                        @foreach($files as $file)
                            <a href="{{app_path()}}/{{$agence->id}}/{{$file->name}}.{{$file->extension}}"
                               download="{{$file->titre}}">
                                {{$file->titre}}
                            </a>
                            <a href="#editFile{{$file->id}}" data-toggle="collapse" class="btn btn-primary btn-xs">Modifier
                                le fichier</a>
                            @if($user_id == $cdp_id || $statut_id == 2)
                                @include('agence.editFile')
                            @endif
                        @endforeach
                    @else
                        <span class="badge bg-important">
                        Aucun fichier présent.
                    </span>
                    @endif

                    @if($user_id == $cdp_id || $statut_id == 2)
                        <hr>
                        <a href="#file" class="btn btn-primary btn-sm"
                           data-toggle="collapse" aria-expanded="false"
                           aria-controls="#file">
                            Téléverser un fichier
                        </a>

                    @include('agence.file')

                @endif
                <!-- TELECHARGEMENT -->
                </div>
            @endif

            <h2 class="text-center project-title" style="margin-bottom: 40px;">Projets de l'agence</h2>
            
        <div class="row">
            @if($projets->isEmpty())
                <p class="alert alert-warning text-center">
                    Aucun projet n'a été crée !
                </p>
            @else
                @foreach($projets as $projet)
                        <?php
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
                        ?>
                                <!-- TABLEAU PROJETS -->
                        <div style="margin-bottom: 15px;">
                            <div class="content-panel download">
                                <div class="text-center">
                                    <h3 style="display: inline-block;">
                                        <a href="#pr{{$projet->id}}"
                                           data-toggle="collapse" aria-expanded="false"
                                           aria-controls="#pr{{$projet->id}}">
                                            {{ $projet->nom }}
                                        </a>
                                    </h3>
                                    <a href="{{route('projet', [$projet->agence_id, $projet->id])}}"
                                       class="btn btn-success btn-xs"
                                       style="margin-bottom: 15px;margin-left: 20px;">Détail du projet</a>
                                    @if($user_id == $cdp_id || $statut_id == 2)
                                        <a class="btn btn-primary btn-xs" style="margin-bottom: 15px;margin-left: 20px;"
                                           href="#edit{{$projet->id}}" data-toggle="modal"
                                           aria-controls="#edit{{$projet->id}}">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <a class="btn btn-danger btn-xs" style="margin-bottom: 15px;"
                                           href="{{ route('projet.destroy', [$agence->id, $projet->id]) }}"
                                           data-method="delete"
                                           data-confirm="Voulez-vous réellement supprimer ce projet ?">
                                            <i class="fa fa-trash-o "></i>
                                        </a>
                                        @include('projet.edit')
                                    @endif
                                    <span style="margin-left:30px;">
                            <a href="#task{{$projet->id}}"
                               data-toggle="collapse" aria-expanded="false"
                               aria-controls="#task{{$projet->id}}"
                               style="font-size:12px;">
                                <i class="fa fa-chevron-circle-down" aria-hidden="true"></i>
                                Voir les tâches
                            </a>
                                    <button class="btn btn-info" style="margin-left:50px;">
                                        {{$projet->encaisse}} €
                                    </button>
                                    <button class="btn btn-success">
                                        {{$projet->facturable}} €
                                    </button>
                        </span>
                                </div>
                                <div class="collapse" id="pr{{$projet->id}}">
                                    <p style="margin-top:25px; margin-bottom:25px;"><strong>Description
                                            :</strong> {{ $projet->commentaire }}</p>
                                    @if($projet->etape_id > 0)
                                        <span class="label label-success" style="font-size:10px;">
                                     {!! $etape->etape !!} ({{round($pc_projet)}} %)
                                            @else
                                                <span class="label label-warning" style="font-size:10px;">
                                    {{ $etape }}
                                                    @endif
                                </span>
                                                <div class="progress">
                                                    <div class="progress-bar progress-bar-success progress-bar-striped"
                                                         role="progressbar" aria-valuenow="{{$pc_projet}}" aria-valuemin="0"
                                                         aria-valuemax="100" style="width: {{$pc_projet}}%">
                                                    </div>
                                                </div>
                                                <h3 class="project-title">Progression dans les tâches (<strong>{{ round($pc) }} %</strong>)</h3>
                                                @if($projet->etape_id > 0)
                                                    <div class="progress">
                                                        <div class="progress-bar progress-bar-success progress-bar-striped"
                                                             role="progressbar" aria-valuenow="{{$pc}}" aria-valuemin="0"
                                                             aria-valuemax="100" style="width: {{$pc}}%">
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="progress">
                                                        <div class="progress-bar progress-bar-danger progress-bar-striped"
                                                             role="progressbar" aria-valuenow="100" aria-valuemin="0"
                                                             aria-valuemax="100" style="width: {{$pc}}%">
                                                        </div>
                                                    </div>
                                                @endif
                                                <h3 class="project-title">Heures accomplies (<strong>{{$heures_notees}}h
                                                    / {{$projet->total_heures}}h</strong>)</h3>

                                                <div class="progress">
                                                    <div class="progress-bar progress-bar-info progress-bar-striped"
                                                         role="progressbar"
                                                         aria-valuenow="{{$heures}}" aria-valuemin="0" aria-valuemax="100"
                                                         style="width: {{$heures}}%">
                                                    </div>
                                                </div>
                                </div>

                                <div class="collapse" id="task{{$projet->id}}">
                                    @include('tache.list')
                                </div>

                            </div><!-- /content-panel -->
                        </div><!-- /col-md-12 -->
                        <!-- TABLEAU PROJETS -->
                        @endforeach
                    @endif
                </div>
        </div>

        @include('sidebar')

    </div>
@endsection