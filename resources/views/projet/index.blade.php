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
                    @if($user_id == $cdp_id || $statut_id == $ca_id)
                        <a href="#edit{{$projet->id}}" data-toggle="modal" data-target="#edit{{$projet->id}}"
                           class="btn btn-primary">
                            Modifier
                        </a>
                        @include('projet.edit')
                        <a href="{{route('projet.destroy', [$projet->projet_id, $projet->id])}}"
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
                                @if($user_id == $cdp_id || $statut_id == $ca_id)
                                    @include('projet.file')
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

                @include('tache.list')
            </div>
        </div>
        @include('sidebar')
    </div>
@endsection