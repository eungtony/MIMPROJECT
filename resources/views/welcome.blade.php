@extends('layouts.application')

@section('content')

    <div class="row mt">
        <div class="col-lg-9">
            <div class="panel-content">
                @include('admininfo')
                <div class="row mt">
                    <div class="panel-body">
                        <div class="col-md-6">
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    Dernières tâches réalisées
                                </div>
                                <div class="panel-body">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <td>Titre de la tâche</td>
                                            <td>Catégorie</td>
                                            <td>Nom du projet</td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(!$tasks->isEmpty())
                                            @foreach($tasks as $task)
                                                <tr>
                                                    <td>{{$task->titre}}</td>
                                                    <td>{{$task->categorie->titre}}</td>
                                                    <td>{{$task->projet->nom}}</td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <p class="alert alert-danger">
                                                    Aucun montant ajouté !
                                                </p>
                                            </tr>
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    Livret de compte
                                </div>
                                <div class="panel-body">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <td>Date</td>
                                            <td>Libéllé</td>
                                            <td>Montant</td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(!$tresorerie->isEmpty())
                                            @foreach($tresorerie as $tr)
                                                <tr>
                                                    <td>{{$tr->created_at}}</td>
                                                    <td>{{$tr->libelle}}</td>
                                                    <td>{{$tr->montant}} €</td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <p class="alert alert-danger">
                                                Aucune tâche n'a été effectuée !
                                            </p>
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @foreach($agences as $agence)
                    <?php
                    $cdp_id = $agence->user_id;
                    $cdp = \App\User::findOrFail($cdp_id);
                    $encaisse = 0;
                    $facturable = 0;
                    foreach ($agence->projets as $projet) {
                        $facturable = $facturable + $projet->facturable;
                        $encaisse = $encaisse + $projet->encaisse;
                    }
                    ?>
                    <div class="content-panel text-center" style="margin-bottom: 10px;">
                        <h4>
                            <a href="#agence{{$agence->id}}" data-parent="#accordion"
                               data-toggle="collapse">{{$agence->nom}}</a>
                            <span style="margin-right:30px; margin-left:30px;">
                                Chef de projet: {{$cdp->name}}
                            </span>
                            <span class="btn btn-success">
                                {{$encaisse}} €
                            </span>
                            <span class="btn btn-info" style="margin-right:20px;">
                                {{$facturable}} €
                            </span>
                            <a href="{{route('agence', $agence->id)}}" class="btn btn-success btn-xs" target="_blank">Voir
                                l'agence</a>
                        </h4>

                        <div class="collapse" id="agence{{$agence->id}}">
                            <h3>Projets</h3>

                            @if(!$agence->projets->isEmpty())

                                <table class="table">
                                    <thead>
                                    <th>Nom</th>
                                    <th>Progression du projet</th>
                                    <th>Progression des tâches</th>
                                    </thead>
                                    <tbody>

                                    @foreach($agence->projets as $projet)

                                        <?php
                                        $done = \App\Travail::where('projet_id', $projet->id)->where('fait', 1)->get()->count();
                                        $total = \App\Travail::where('projet_id', $projet->id)->get()->count();
                                        if ($total_etape > 0) {
                                            $pc_projet = 100 * $projet->etape_id / $total_etape;
                                        }
                                        $pc = 0;
                                        if ($total > 0) {
                                            $pc = 100 * $done / $total;
                                        }
                                        ?>

                                        <tr>
                                            <td>{{$projet->nom}}</td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar progress-bar-success progress-bar-striped"
                                                         role="progressbar" aria-valuenow="{{$pc_projet}}"
                                                         aria-valuemin="0"
                                                         aria-valuemax="100" style="width: {{$pc_projet}}%">
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                @if($projet->etape_id > 0)
                                                    <div class="progress">
                                                        <div class="progress-bar progress-bar-success progress-bar-striped"
                                                             role="progressbar" aria-valuenow="{{$pc}}"
                                                             aria-valuemin="0"
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
                                            </td>
                                        </tr>

                                    @endforeach

                                    @else

                                        <p class="bg-danger">
                                            Cette agence ne possède pas de projets !
                                        </p>

                                    @endif

                                    </tbody>
                                </table>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @include('sidebar')
    </div>
@endsection
