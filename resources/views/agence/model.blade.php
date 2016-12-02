@section('content')

    <div class="row mt">
        <div class="col-lg-9" style="margin-bottom: 15px;">
            <div class="content-panel">
                <h1 style="display: inline-block;">{{ $agence->nom }}</h1>
                @if($user_id == $cdp_id || $statut_id == $ca_id)
                    <a href="#agence{{$agence->id}}" class="btn btn-primary btn-xs"
                       data-toggle="collapse" aria-expanded="false"
                       aria-controls="#agence{{$agence->id}}" style="margin-bottom: 15px;">
                        <i class="fa fa-pencil"></i> Modifier l'Agence
                    </a>
                    <a href="#projet{{$agence->id}}" class="btn btn-success btn-xs"
                       data-toggle="collapse" aria-expanded="false"
                       aria-controls="#projet{{$agence->id}}" style="margin-bottom: 15px;">
                        <i class="fa fa-trash-o "></i> Ajouter un projet
                    </a>
                    @include('projet.add')
                    @include('agence.edit')
                @endif
            </div>
            <div class="content-panel">
                <!-- TELECHARGEMENT -->
                <h3>Fichiers disponible dans cette agence</h3>

                @if(!$agence->file->isEmpty())
                    @foreach($agence->file as $file)
                        <a href="{{app_path()}}/{{$agence->id}}/{{$file->name}}.{{$file->extension}}"
                           download="{{$file->titre}}">
                            {{$file->titre}}</a>
                        @if($user_id == $cdp_id || $statut_id == $ca_id)
                            <hr>
                            @include('agence.editFile')
                            <a href="{{route('file.delete', [$agence->id,$file->id])}}" class="btn btn-danger"
                               data-method="delete"
                               data-confirm="Voulez-vous supprimer ce fichier ?">Supprimer</a>
                        @endif
                    @endforeach
                @else
                    <p class="bg-danger">
                        Aucun fichier présent.
                    </p>
                @endif
                @if($user_id == $cdp_id || $statut_id == $ca_id)
                    <a href="#file" class="btn btn-primary"
                       data-toggle="collapse" aria-expanded="false"
                       aria-controls="#file">
                        Téléverser un fichier
                    </a>
                    @include('agence.file')
                    @endif
                            <!-- TELECHARGEMENT -->
                    <h1 class="text-right">Projets de l'agence</h1>
            </div>
            @foreach($projets as $projet)
            <?php
            $travaux = \App\Travail::where('projet_id', $projet->id)->get();
            $travaux->load('user');
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
                    <h1 style="display: inline-block;">
                        <a href="#pr{{$projet->id}}"
                           data-toggle="collapse" aria-expanded="false"
                           aria-controls="#pr{{$projet->id}}">
                            {{ $projet->nom }}
                        </a>
                    </h1>
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
                           style="font-size:25px;">
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
                                    </h3>
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
                        <div class="content-panel">
                            <table class="table table-striped table-advance table-hover">
                                <h4>Tâches</h4>
                                <hr>
                                <thead>
                                <tr>
                                    <th><i class="fa fa-bullhorn"></i> Titre</th>
                                    <th class="hidden-phone"><i class="fa fa-question-circle"></i> Commentaires</th>
                                    <th><i class="fa fa-bookmark"></i> Catégorie</th>
                                    <th><i class=" fa fa-edit"></i> Etat</th>
                                    <th><i class=" fa fa-edit"></i> Date limite</th>
                                    <th><i class=" fa fa-edit"></i> Personne assignée</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($travaux->isEmpty())
                                    @if($user_id == $cdp_id || $statut_id == $ca_id)
                                        <a class="btn btn-success btn-xs"
                                           href="#addtask{{$projet->id}}" data-toggle="modal"
                                           data-target="#addtask{{$projet->id}}"><i
                                                    class="fa fa-check fa-fw"></i>Ajouter une tâche</a>
                                        @include('tache.add')
                                    @endif
                                    <tr>
                                        <td><p class="text-danger">Ce projet ne possède pas de tâches !</p></td>
                                    </tr>
                                @else
                                    @if($user_id == $cdp_id || $statut_id == $ca_id)
                                        <a class="btn btn-success btn-xs"
                                           href="#addtask{{$projet->id}}" data-toggle="modal"
                                           data-target="#addtask{{$projet->id}}"><i
                                                    class="fa fa-check fa-fw"></i>Ajouter une tâche</a>
                                        @include('tache.add')
                                    @endif
                                    @foreach($travaux as $tache)
                                        <tr>
                                            <td>
                                                <a href="{{route('index.tache', [$tache->agence_id, $tache->projet_id, $tache->id])}}">
                                                    {{$tache->titre}}
                                                </a>
                                            </td>
                                            <td>
                                                {{$tache->commentaire}}
                                            </td>
                                            <td>
                                                {{$tache->categorie->titre}}
                                            </td>
                                            <td>
                                                @if($tache->fait == 1) Fait @else Non Fait @endif
                                            </td>
                                            <td>
                                                {{$tache->date}}
                                            </td>
                                            <td class="hidden-phone">
                                                @if($tache->user)
                                                    {{$tache->user['name']}}
                                                @else
                                                    Aucune personne assignée
                                                @endif
                                            </td>
                                            <td>
                                                @if($user_id == $cdp_id || $statut_id == $ca_id)
                                                    <a href="" class="btn btn-success btn-xs"><i
                                                                class="fa fa-check"></i></a>
                                                    <a href="#tache{{$tache->id}}" class="btn btn-primary btn-xs"
                                                       data-toggle="modal" data-target="#tache{{$tache->id}}">
                                                        <i class="fa fa-pencil"></i></a>
                                                    @include('tache.edit')
                                                    <a href="{{ action('tacheController@destroy', $tache->id) }}"
                                                       class="btn btn-danger btn-xs" data-method="delete"
                                                       data-confirm="Souhaitez-vous réellement supprimer cette tâche ?"><i
                                                                class="fa fa-trash-o "></i></a>
                                                @endif
                                            </td>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                            @if($user_id == $cdp_id || $statut_id == $ca_id)
                            @endif
                        </div>
                    </div>
                </div><!-- /content-panel -->
            </div><!-- /col-md-12 -->
            <!-- TABLEAU PROJETS -->
            @endforeach
        </div>
        @include('sidebar')
    </div>
@endsection