@if($allTask->isEmpty())
    <p class="alert alert-warning">
        Aucune tâche n'a été réalisé !
    </p>
@endif
@foreach($allTask as $tache)
    <?php
    $date = \Carbon\Carbon::createFromFormat('Y-m-d', $tache->date);
    $difference = ($date->diff($now)->days < 1) ? 'today' : $date->diffInDays($now);
    ?>
    <ul class="task-list" style="margin-bottom: 20px;">
        <li>
            <div class="task-title">
                <div class="task-title-sp" style="margin-bottom:10px;">
                    #{{$tache->id}}
                    <a href="#voirTache{{$tache->id}}" data-toggle="collapse">
                        {{$tache->titre}}
                    </a>
                </div>
                @include('tache.indexC')
                @if($tache->fait == 0)
                    <span class="badge bg-info">
                        A faire
                    </span>
                @else
                    <span class="badge bg-succes">
                        Fait
                    </span>
                @endif
                <span class="badge bg-success">
                    @if($tache->user)
                        {{$tache->user->name}}
                    @else
                        Aucune personne assignée
                    @endif
                </span>
                <span class="badge bg-important">
                    {{$tache->categorie->titre}}
                </span>
                @if($tache->fait == 0)
                    <span class="badge bg-danger">
                        J - {{$difference}}
                    </span>
                @endif
            </div>
        </li>
    </ul>
    <hr>
@endforeach