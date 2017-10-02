@extends('layouts.version-2.layouts.app')

@section('title') Troyes Point Zéro - Support @endsection

@section('content')

    <div class="row mt">
        <div class="col-lg-12">
            <div class="panel-content">

                @include('admininfo')

                <div class="row mt">
                    <div class="panel-body">
                        <div class="col-md-6">
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    Dernières tâches réalisées
                                    <a href="#voirTaches" data-toggle="modal" class="label label-primary">
                                        Voir toutes les tâches réalisées
                                    </a>
                                </div>
                                <div class="modal fade" id="voirTaches" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                Les dernières tâches réalisées !
                                            </div>
                                            <div class="modal-body">
                                                @include('tache.allTask')
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    @if(!$tasks->isEmpty())
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <td>Titre de la tâche</td>
                                                <td>Catégorie</td>
                                                <td>Nom du projet</td>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($tasks as $task)
                                                <tr>
                                                    <td>{{$task->titre}}</td>
                                                    <td>{{$task->categorie->titre}}</td>
                                                    <td>{{$task->projet->nom}}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    @else
                                        <tr>
                                            <p class="alert alert-danger">
                                                Aucune tâche n'a été effectué !
                                            </p>
                                        </tr>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    Livret de compte
                                    <a href="{{route('livret')}}" class="label label-info">Voir le livret</a>
                                    @if(Auth::user()->statut_id == 2)
                                    <a href="#money" data-toggle="modal" class="label label-success">Ajouter un
                                        montant</a>
                                    @endif
                                </div>
                                <div class="panel-body">
                                    @if(!$tresorerie->isEmpty())
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <td>Date</td>
                                                <td>Libéllé</td>
                                                <td>Montant</td>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($tresorerie as $tr)
                                                <tr>
                                                    <td>{{$tr->created_at}}</td>
                                                    <td>{{\Illuminate\Support\Str::limit($tr->libelle, 50, '...')}}</td>
                                                    <td>{{$tr->montant}} €</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    @else
                                        <p class="alert alert-danger">
                                            Aucun montant n'a été ajouté !
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt">
                    <div class="col-md-12">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                Liste des devis à valider <a href="#listDevis" data-toggle="modal"
                                                             class="btn btn-primary btn-xs">Voir tous les devis</a>
                            </div>
                            <div class="panel-body">
                                @if($devisList)
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <td>Nom du projet</td>
                                            <td>Description</td>
                                            <td>Nom de l'agence</td>
                                            <td>Le devis</td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <p class="alert alert-danger">J'obtient une erreur avec les devis !!! "Try to get property of non-object !</p>
                                        </tbody>
                                    </table>
                                @else
                                    <div class="alert alert-warning">
                                        Aucun devis à valider !
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- include('devis.all') -->

                <div class="content-panel text-center" style="margin-bottom:10px;">
                    <a href="#addprojet" data-toggle="collapse">
                        <h3>Proposer un projet</h3>
                    </a>
                    <div class="collapse" id="addprojet">
                        <form action="{{route('add.projet')}}" method="POST">
                            <input class="form-control" type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="bureau" value="bureau">
                            <div class="form-group">
                                <input class="form-control" type="text" name="nom" class="form-control"
                                       placeholder="Nom du projet">
                            </div>

                            <div class="form-group">
                                    <textarea class="form-control" type="text" name="commentaire" class="form-control"
                                              placeholder="Description du projet"></textarea>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                    Ajouter le projet
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                @if(!$agences->isEmpty())
                    @foreach($agences as $agence)
                        <?php
                        $cdp = 'None';
                        $cdp_id = $agence->user_id;
                        if ($cdp_id != 0) {
                            $cdp = \App\User::findOrFail($cdp_id);
                        }
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
                                Chef de projet: @if($cdp == 'None') AUCUN @else {{$cdp->name}} @endif
                            </span>
                            <span class="btn btn-success">
                                {{$encaisse}} €
                            </span>
                            <span class="btn btn-info" style="margin-right:20px;">
                                {{$facturable}} €
                            </span>
                                <a href="{{route('agence', $agence->id)}}" class="btn btn-success btn-xs">Voir
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
                                        <th>Devis</th>
                                        </thead>
                                        <tbody>

                                        @foreach($agence->projets as $projet)

                                            <?php
                                            $done = \App\Travail::where('projet_id', $projet->id)->where('fait', 1)->get()->count();
                                            $total = \App\Travail::where('projet_id', $projet->id)->get()->count();
                                            $devis = \App\Devis::where('projet_id', $projet->id)->get();
                                            if (isset($devis[0])) {
                                                $devisModel = $devis[0];
                                            }
                                            if ($total_etape > 0) {
                                                $pc_projet = 100 * $projet->etape_id / $total_etape;
                                            }
                                            $pc = 0;
                                            if ($total > 0) {
                                                $pc = 100 * $done / $total;
                                            }
                                            ?>

                                            <tr>
                                                <td>
                                                    <a href="{{route('projet', [$projet->agence_id, $projet->id])}}">{{$projet->nom}}</a>
                                                </td>
                                                <td>
                                                    <div class="progress">
                                                        <div class="progress-bar progress-bar-success progress-bar-striped"
                                                             role="progressbar" aria-valuenow="{{$pc_projet}}"
                                                             aria-valuemin="0"
                                                             aria-valuemax="100" style="width: {{$pc_projet}}%">
                                                            {{round($pc_projet)}} %
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
                                                                {{round($pc)}} %
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="progress">
                                                            <div class="progress-bar progress-bar-danger progress-bar-striped"
                                                                 role="progressbar" aria-valuenow="100"
                                                                 aria-valuemin="0"
                                                                 aria-valuemax="100" style="width: {{$pc}}%">
                                                            </div>
                                                            Le projet n'a pas commencé !
                                                        </div>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($devis->isEmpty())
                                                        Aucun devis n'a été posté !
                                                    @else
                                                        @if($devisModel->valide ==0)
                                                            <a href="{{route('projet', [$projet->agence_id, $projet->id])}}#devis"
                                                               class="btn btn-info btn-xs">Voir le devis</a>
                                                        @else
                                                            <button class="btn btn-success">Devis validé</button>
                                                        @endif
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
                @else
                    <div class="alert alert-warning">
                        Aucune promotion active !
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="row top-summary">
        <div class="col-md-12" style="text-align: center;">
            <h2>Projets libres</h2>
            <hr>
        </div>
    </div>

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

    <div class="row">
        <div class="col-lg-12 portlets">
            <div id="website-statistics1" class="widget animated fadeInDown" style="padding: 15px;">
                @if(!$projets->isEmpty())
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
                                                <form action="{{route('edit.free.project', [$project->id])}}"
                                                      method="POST">
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
                @else
                    <div class="alert alert-warning">
                        Aucun projet proposé
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
