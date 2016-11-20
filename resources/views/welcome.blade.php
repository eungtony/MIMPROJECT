@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">Welcome</div>

            <div class="panel-body">

                <h1>Mes tâches</h1>

                @if($taches->isEmpty())
                    <p class="bg-danger">
                        Vous n'avez pas de tâche assignée !
                    </p>
                @else
                    <ol>
                        @foreach($taches as $tache)

                            <li>{{$tache->titre}}</li>

                        @endforeach
                    </ol>
                @endif

                @foreach($agences as $agence)

                    <div class="col-md-12">

                        <h1>
                            <a href="{{route('agence', $agence->id)}}">{{$agence->nom}}</a>
                        </h1>

                        <h3>Projets</h3>

                        @if(!$agence->projets->isEmpty())

                        <table class="table">
                            <thead>
                            <th>Nom</th>
                            <th>Commentaire</th>
                            <th>Progression</th>
                            </thead>
                            <tbody>

                            @foreach($agence->projets as $projet)

                                <?php
                                $done = \App\Travail::where('projet_id', $projet->id)->where('fait', 1)->get()->count();
                                $total = \App\Travail::where('projet_id', $projet->id)->get()->count();
                                $pc = 0;
                                if ($total > 0) {
                                    $pc = 100 * $done / $total;
                                }
                                ?>

                                <tr>
                                    <td>{{$projet->nom}}</td>
                                    <td>{{$projet->commentaire}}</td>
                                    <td>
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-success progress-bar-striped"
                                                 role="progressbar" aria-valuenow="{{$pc}}" aria-valuemin="0"
                                                 aria-valuemax="100" style="width: {{$pc}}%">
                                            </div>
                                            </div>
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

                @endforeach
            </div>
        </div>
    </div>
@endsection
