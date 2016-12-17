<?php
$user_id = Auth::user()->id;
$statut_id = Auth::user()->statut_id;
$ca_id = 1;
$done = \App\Travail::where('projet_id', $projet->id)->where('fait', 1)->get()->count();
$total = \App\Travail::where('projet_id', $projet->id)->get()->count();
$pc = 0;
$pc_projet = 0;
$now = \Carbon\Carbon::now();
if ($total_etape > 0) {
    $pc_projet = 100 * $projet->etape_id / $total_etape;
}
if ($total > 0) {
    $pc = 100 * $done / $total;
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

                <p>
                    {{$projet->heures_faites}} heures /{{$projet->total_heures}} heures
                </p>

                <p>
                    {{$projet->encaisse}} € / {{$projet->facturable}} €
                </p>

                <div class="content-panel upload-panel">
                    <!-- TELECHARGEMENT -->
                    <h3 class="upload-title">Fichiers partagés</h3>

                    <?php $files = \App\File::where('projet_id', $projet->id)->get();?>

                    @if(!$files->isEmpty())
                        @foreach($files as $file)
                            <a href="{{app_path()}}/{{$projet->agence_id}}/{{$projet->id}}/{{$file->name}}.{{$file->extension}}"
                               download="{{$file->titre}}">
                                {{$file->titre}}
                            </a><br>
                            <hr>
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
                @include('tache.list')
            </div>
        </div>
        @include('sidebar')
    </div>
@endsection