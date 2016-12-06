<div class="row mt">
    <div class="col-md-12">
        <section class="task-panel tasks-widget">
            <div class="panel-heading">
                <div class="pull-left">
                    <h5>
                        <i class="fa fa-tasks"></i>
                        Tâches ({{$done}}/{{$total}})
                        @if($user_id == $cdp_id || $statut_id == $ca_id)
                            <a href="#addtask{{$projet->id}}" data-toggle="modal"
                               data-target="#addtask{{$projet->id}}"
                               class="btn btn-warning btn-xs">Ajouter une tache</a>
                            @include('tache.add')
                        @endif
                    </h5>
                </div>
                <br>
            </div>
            <div class="panel-body">
                <div class="task-content">
                    @foreach($taches as $tache)
                        <?php
                        $date = \Carbon\Carbon::createFromFormat('Y-m-d', $tache->date);
                        $difference = ($date->diff($now)->days < 1) ? 'today' : $date->diffInDays($now);
                        ?>
                        <ul class="task-list" style="margin-bottom: 20px;">
                            <li>
                                <div class="task-title">
                                    <span class="task-title-sp"><a href="#voirtache{{$tache->id}}"
                                                                   data-toggle="modal">{{$tache->titre}}</a></span>
                                    <span class="badge bg-theme">A faire</span>
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
                                                        <span class="badge bg-danger">
                                                            J - {{$difference}}
                                                        </span>
                                    @if($user_id == $cdp_id || $statut_id == $ca_id)
                                        <div class="pull-right hidden-phone">
                                            <button class="btn btn-success btn-xs"><i
                                                        class=" fa fa-check"></i></button>
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
                                        </div>
                                    @endif
                                </div>
                            </li>
                        </ul>
                        @if($user_id == $cdp_id || $statut_id == $ca_id)
                            @include('tache.edit')
                        @endif
                        @include('tache.index')
                    @endforeach
                </div>
            </div>
        </section>
    </div><!-- /col-md-12-->
</div><!-- /row -->