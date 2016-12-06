@section('content')

    <div class="row mt">
        <div class="col-lg-9">
            <div class="text-center">
                <h1>{{ $agence->nom }}</h1>

                @if($user_id == $cdp_id || $statut_id == $ca_id)
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
                @endif

            </div>

            <div>
                <!-- TELECHARGEMENT -->
                <h3>Fichiers disponible dans cette agence</h3>

                @if(!$agence->file->isEmpty())
                    @foreach($agence->file as $file)
                        <a href="{{app_path()}}/{{$agence->id}}/{{$file->name}}.{{$file->extension}}"
                           download="{{$file->titre}}">
                            {{$file->titre}}
                        </a><br>
                        <hr>
                        @if($user_id == $cdp_id || $statut_id == $ca_id)
                            @include('agence.editFile')
                        @endif
                    @endforeach
                @else
                    <span class="badge bg-important">
                        Aucun fichier présent.
                    </span>
                @endif

                @if($user_id == $cdp_id || $statut_id == $ca_id)
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

            <h2 class="text-center" style="margin-bottom: 40px;">Projets de l'agence</h2>

            @foreach($projets as $projet)
            <?php
            $taches = \App\Travail::where('projet_id', $projet->id)->where('fait', 0)->get();
            $taches->load('user');
            $users = \App\User::where('agence_id', $projet->agence_id)->get();
            $done = \App\Travail::where('projet_id', $projet->id)->where('fait', 1)->get()->count();
            $total = \App\Travail::where('projet_id', $projet->id)->get()->count();
            $pc = 0;
            $pc_projet = 0;

            if ($total_etape > 0) {
                $pc_projet = 100 * $projet->etape_id / $total_etape;
            }

            if ($total > 0) {
                $pc = 100 * $done / $total;
            }

            $etape = "Le projet n'a pas encore commencé";
            if ($projet->etape_id > 0) {
                $etape = \App\Etape::findOrFail($projet->etape_id);
            }
            ?>
                    <!-- TABLEAU PROJETS -->
            <div style="margin-bottom: 15px;">
                <div class="content-panel">
                    <h3 style="display: inline-block;">
                        <a href="#pr{{$projet->id}}"
                           data-toggle="collapse" aria-expanded="false"
                           aria-controls="#pr{{$projet->id}}">
                            {{ $projet->nom }}
                        </a>
                    </h3>
                    <a href="{{route('projet', [$projet->agence_id, $projet->id])}}" class="btn btn-success btn-xs"
                       style="margin-bottom: 15px;margin-left: 20px;">Détail du projet</a>
                    @if($user_id == $cdp_id || $statut_id == $ca_id)
                        <a class="btn btn-primary btn-xs" style="margin-bottom: 15px;margin-left: 20px;"
                           href="#edit{{$projet->id}}" data-toggle="modal" aria-controls="#edit{{$projet->id}}">
                            <i class="fa fa-pencil"></i>
                        </a>
                        <a class="btn btn-danger btn-xs" style="margin-bottom: 15px;"
                           href="{{ route('projet.destroy', [$agence->id, $projet->id]) }}" data-method="delete"
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
                    </span>
                    <div class="collapse" id="pr{{$projet->id}}">
                        <hr>
                        <p><strong>Description :</strong> {{ $projet->commentaire }}</p>
                        <hr>
                        @if($projet->etape_id > 0)
                            <span class="label label-success" style="font-size:10px;">
                                 {!! $etape->etape !!}
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
                            <h3>Progression dans les tâches</h3>
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
                    </div>

                    <div class="collapse" id="task{{$projet->id}}">
                        @include('tache.list')
                    </div>

                </div><!-- /content-panel -->
            </div><!-- /col-md-12 -->
            <!-- TABLEAU PROJETS -->
            @endforeach
        </div>

        @include('sidebar')
        
    </div>
@endsection