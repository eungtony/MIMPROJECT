<?php
$user_id = Auth::user()->id;
$statut_id = Auth::user()->statut_id;
$ca_id = 1;
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
$recolte = 0;
$now = \Carbon\Carbon::now();
if ($total_etape > 0) {
    $pc_projet = 100 * $projet->etape_id / $total_etape;
}
if ($total > 0) {
    $pc = 100 * $done / $total;
}
if ($projet->facturable > 0) {
    $recolte = 100 * $projet->encaisse / $projet->facturable;
}
if ($projet->total_heures > 0) {
    $heures = 100 * $heures_notees / $projet->total_heures;
}
?>
@extends('layouts.application')

@section('content')

    <div class="row mt">
        <div class="col-lg-9" style="margin-bottom: 15px;">
            <div class="content-panel">
                <h1>
                    {{$projet->nom}}
                    @if($user_id == $cdp_id)
                        <a href="#edit{{$projet->id}}" data-toggle="modal" data-target="#edit{{$projet->id}}"
                           class="btn btn-primary">
                            Modifier
                        </a>
                        @include('projet.edit')
                        <a href="{{route('projet.destroy', [$projet->agence_id, $projet->id])}}"
                           class="btn btn-danger"
                           data-method="delete"
                           data-confirm="Voulez-vous réellement supprimer ce projet ?">Supprimer ce projet</a>
                    @endif
                </h1>

                <h3>
                    {{$projet->commentaire}}
                </h3>

                @if(Auth::user()->agence_id == $projet->agence_id)
                    <div class="content-panel upload-panel">
                        <!-- TELECHARGEMENT -->
                        <h3 class="upload-title">Fichiers partagés</h3>

                        <?php $files = \App\File::where('projet_id', $projet->id)->get();?>

                        @if(!$files->isEmpty())
                            @foreach($files as $file)
                                <a href="{{app_path()}}/{{$projet->agence_id}}/{{$projet->id}}/{{$file->name}}.{{$file->extension}}"
                                   download="{{$file->titre}}">
                                    {{$file->titre}}
                                </a>
                                <a href="#editFile{{$file->id}}" data-toggle="collapse" class="btn btn-primary btn-xs">Modifier
                                    le fichier</a>
                                @if($user_id == $cdp_id)
                                    @include('projet.file')
                                @endif
                            @endforeach
                        @else
                            <span class="badge bg-important">
                        Aucun fichier présent.
                    </span>
                        @endif

                        @if($user_id == $cdp_id)
                            <hr>
                            <a href="#file" class="btn btn-primary btn-sm"
                               data-toggle="collapse" aria-expanded="false"
                               aria-controls="#file">
                                Téléverser un fichier
                            </a>

                            @include('projet.addFile')

                            @endif
                                    <!-- TELECHARGEMENT -->
                    </div>
                @endif

                <h3>Progression du projet ({{round($pc_projet)}} %)
                    <span>
                        <a href="#progression_projet" data-toggle="modal" class="btn btn-info btn-xs">
                            <i class="fa fa-info"></i>
                            Détail de la progression
                        </a>
                    </span>
                </h3>
                @include('projet.progression')
                <div class="progress">
                    <div class="progress-bar progress-bar-success progress-bar-striped"
                         role="progressbar" aria-valuenow="{{$pc_projet}}" aria-valuemin="0"
                         aria-valuemax="100" style="width:{{$pc_projet}}%">
                    </div>
                </div>
                <h3>Progression dans les tâches ({{round($pc)}} %)</h3>
                @if($projet->etape_id > 0)
                    <div class="progress">
                        <div class="progress-bar progress-bar-success progress-bar-striped"
                             role="progressbar" aria-valuenow="{{$pc}}" aria-valuemin="0"
                             aria-valuemax="100" style="width:{{$pc}}%">
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

                <h3>Heures accomplies ({{$heures_notees}}h / {{$projet->total_heures}}h)</h3>

                <div class="progress">
                    <div class="progress-bar progress-bar-info progress-bar-striped" role="progressbar"
                         aria-valuenow="{{$heures}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$heures}}%">
                    </div>
                </div>

                <h3>Argents récoltés ({{$projet->encaisse}}€ / {{$projet->facturable}}€)</h3>

                <div class="progress">
                    <div class="progress-bar progress-bar-info progress-bar-striped" role="progressbar"
                         aria-valuenow="{{$recolte}}" aria-valuemin="0" aria-valuemax="100"
                         style="width: {{$recolte}}%">
                    </div>
                </div>

                <hr>

                <?php
                $devis = \App\Devis::where('projet_id', $projet->id)->get();
                if (isset($devis[0])) {
                    $devisModel = $devis[0];
                }
                $devis_taches = \App\devis_taches::where('projet_id', $projet->id)->get();
                $devis_id = null;
                if (isset($devis[0])) {
                    $devis_id = $devis[0]->id;
                }
                ?>

                <div id="devis">
                    <h2>
                        <form action="{{route('add.devis', [$projet->agence_id, $projet->id, Auth::user()->id])}}"
                              method="POST">
                            Devis du projet
                            @if($user_id == $cdp_id && $devis->isEmpty())
                                {{csrf_field()}}
                                <button type="submit" class="btn btn-success">Ajouter un devis à ce projet</button>
                            @endif
                        </form>
                    </h2>

                    @if($devis->isEmpty())
                        <div class="alert alert-warning">
                            Aucun devis n'a été ajouté !
                        </div>
                    @else
                        @if($devis_taches->isEmpty())
                            <div class="alert alert-warning">
                                Le devis est vide !
                            </div>
                        @else
                            <?php
                            $prix = 0;
                            foreach ($devis_taches as $devis_tache) {
                                $prix = $prix + $devis_tache->prix;
                            }
                            ?>
                            <table class="table">
                                <thead>
                                <tr>
                                    <td>
                                        Libellé
                                    </td>
                                    <td>
                                        Prix
                                    </td>
                                    @if($user_id == $cdp_id)
                                        <td>
                                            Actions
                                        </td>
                                    @endif
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($devis_taches as $devis_tache)
                                    <tr>
                                        @if($user_id == $cdp_id && $devisModel->valide == 0)
                                            <form action="{{route('edit.devis.task', [$projet->agence_id, $projet->id, $devis_tache->id])}}"
                                                  method="POST">
                                                {{csrf_field()}}
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="libelle"
                                                               value="{{$devis_tache->libelle}}">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="number" class="form-control" name="prix"
                                                               value="{{$devis_tache->prix}}">
                                                    </div>
                                                </td>
                                                @else
                                                    <td>
                                                        {{$devis_tache->libelle}}
                                                    </td>
                                                    <td>
                                                        {{$devis_tache->prix}}€
                                                    </td>
                                                @endif
                                                @if($user_id == $cdp_id && $devisModel->valide == 0)
                                                    <td>
                                                        <button class="btn btn-primary btn-xs" type="submit"><i
                                                                    class="fa fa-pencil"></i></button>
                                                        <a href="{{action('DevisController@deleteTask', [$projet->agence_id, $projet->id, $devis_tache->id])}}"
                                                           data-method="delete"
                                                           data-confirm="Souhaitez-vous réellement supprimer cette tâche ?"
                                                           class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></a>
                                                    </td>
                                            </form>
                                        @endif
                                    </tr>
                                @endforeach
                                </tbody>
                                <tr>
                                    <td>Total du devis: {{$prix}} €</td>
                                </tr>
                            </table>
                        @endif
                        @if($user_id == $cdp_id && $devisModel->valide == 0)
                            @include('devis.form')
                        @endif
                        @if($user_id == $cdp_id && $devisModel->a_valider == 0)
                            <form action="{{route('cp.valide.devis', $devis_id)}}" method="POST"
                                  style="margin-top:25px;">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <button type="submit" class="form-control btn btn-success">
                                        Mettre de le devis en attente de validation
                                    </button>
                                </div>
                            </form>
                        @endif
                        @if($statut_id == 2 && $devisModel->valide == 0 && $devisModel->a_valider == 1 && !$devis_taches->isEmpty())
                            <form action="{{route('valide.devis', $devis_id)}}" method="POST">
                                {{csrf_field()}}
                                <button type="submit" class="btn btn-success" style="width: 100%; margin-top:20px;">
                                    Valider le devis
                                </button>
                            </form>
                        @endif
                            @if($devisModel->valide == 1 && Auth::user()->statut_id == 2)
                            <div class="alert alert-success">
                                <form action="{{route('devalide.devis', $devis_id)}}" method="POST">
                                    {{csrf_field()}}
                                    Le devis a été validé par le Bureau !
                                    <button type="submit" class="btn btn-danger">Dévalidez le devis</button>
                                </form>
                            </div>
                        @endif
                    @endif
                </div>
                <hr>
                @include('tache.list')
            </div>
        </div>
        @include('sidebar')
    </div>
@endsection