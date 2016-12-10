@if($allTask->isEmpty())
    <p class="alert alert-warning">
        Aucune tâche n'a été créee !
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
                <span>#{{$tache->id}}</span>
                <span class="task-title-sp">
                    <a href="#voirTache{{$tache->id}}" data-toggle="collapse">
                        {{$tache->titre}}
                    </a>
                </span>
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
                @if($user_id == $cdp_id || $statut_id == $ca_id)
                    <div class="pull-right hidden-phone">
                        <form action="
                         @if($tache->fait == 0)
                        {{route('check.tache')}}
                        @else
                        {{route('uncheck.tache')}}
                        @endif
                                " method="POST">
                            {{csrf_field()}}
                            <input type="hidden" name="id"
                                   value="{{$tache->id}}">
                            @if($tache->fait == 0)
                                <button type="submit"
                                        class="btn btn-success btn-xs"><i
                                            class=" fa fa-check"
                                            onclick="confirm('Cette tâche a bien été réalisé ?')"></i>
                                </button>
                            @else
                                <button type="submit"
                                        class="btn btn-danger btn-xs"><i
                                            class="fa fa-check"
                                            onclick="confirm('Remettre cette tâche a réalisé ?')"></i>
                                </button>
                            @endif
                            <a href="#tache{{$tache->id}}"
                               class="btn btn-primary btn-xs"
                               data-toggle="modal"
                               aria-controls="#tache{{$tache->id}}"><i
                                        class="fa fa-pencil"></i></a>
                            <a href="{{action('tacheController@destroy', $tache->id)}}"
                               data-method="delete"
                               data-confirm="Souhaitez-vous réellement supprimer cette tâche ?"
                               class="btn btn-danger btn-xs"><i
                                        class="fa fa-trash-o "></i></a>
                        </form>
                    </div>
                @endif
            </div>
        </li>
    </ul>
    @include('tache.indexC')
@endforeach
