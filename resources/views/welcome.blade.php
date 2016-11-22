@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">Welcome</div>

            <div class="panel-body">

                <h1>Mes tâches ({{$taches->count()}})</h1>

                @if($taches->isEmpty())
                    <p class="bg-danger">
                        Vous n'avez pas de tâche assignée !
                    </p>
                @else
                    <ol>
                        @foreach($taches as $tache)

                            <li>
                                {{$tache->titre}}
                                <?php
                                $date = \Carbon\Carbon::createFromFormat('Y-m-d', $tache->date);
                                $difference = ($date->diff($now)->days < 1)
                                        ? 'today'
                                        : $date->diffInDays($now);
                                ?>
                                <span class="label label-success">
                                    J - {{$difference}}
                                </span>
                            </li>

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
                                                     role="progressbar" aria-valuenow="{{$pc_projet}}" aria-valuemin="0"
                                                     aria-valuemax="100" style="width: {{$pc_projet}}%">
                                                </div>
                                            </div>
                                        </td>
                                        <td>
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
