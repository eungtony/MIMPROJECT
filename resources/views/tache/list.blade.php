<div class="row mt">
    <div class="col-md-12">
        <section class="task-panel tasks-widget">
            <div class="panel-heading">
                <div class="pull-left">
                    <h5>
                        <i class="fa fa-tasks"></i>
                        Tâches ({{$done}}/{{$total}})
                        @if($user_id == $cdp_id)
                            <a href="#addtask{{$projet->id}}" data-toggle="modal"
                               data-target="#addtask{{$projet->id}}"
                               class="btn btn-warning btn-xs">Ajouter une tache</a>
                            @include('tache.add')
                        @endif
                        <a href="#taches{{$projet->id}}" data-toggle="modal" class="btn btn-success btn-xs">
                            Voir toutes les tâches
                        </a>
                        <span class="dropdown">
                            <button class="btn btn-primary btn-xs dropdown-toggle" type="button" data-toggle="dropdown">
                                Trier les tâches
                                <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                                <li><a href="{{request()->fullUrlWithQuery(['sort' => 'date'])}}">Par date</a></li>
                                <li><a href="{{request()->fullUrlWithQuery(['sort' => 'category'])}}">Par catégorie</a>
                                </li>
                                <li><a href="{{request()->fullUrlWithQuery(['sort' => 'done'])}}">Par tâche réalisée</a>
                                </li>
                            </ul>
                        </span>
                        <div class="modal fade" id="taches{{$projet->id}}">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        Toutes les tâches du projet: {{$projet->nom}}
                                    </div>
                                    <div class="modal-body">
                                        <?php
                                        $allTask = \App\Travail::where('projet_id', $projet->id)->with('user')->get();
                                        ?>
                                        <div class="task-content">
                                            @include('tache.taches')
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </h5>
                </div>
                <br>
            </div>
            <div class="panel-body">
                <div class="task-content">
                    <?php
                    $taskDone = \App\Travail::where('projet_id', $projet->id)->where('fait', 1)->get()->count();
                    $totalTask = \App\Travail::where('projet_id', $projet->id)->get()->count();
                    ?>
                    @if($taskDone != $totalTask)
                        @foreach($taches as $tache)
                            <?php
                            $date = \Carbon\Carbon::createFromFormat('Y-m-d', $tache->date);
                            $difference = ($date->diff($now)->days < 1) ? 'today' : $date->diffInDays($now);
                            ?>
                            <ul class="task-list" style="margin-bottom: 20px;">
                                <li>
                                    <div class="task-title">
                                        <span>#{{$tache->id}}</span>
                                    <span class="task-title-sp"><a href="#voirtache{{$tache->id}}"
                                                                   data-toggle="modal">{{$tache->titre}}</a></span>
                                        @if($tache->fait == 0)
                                            <span class="badge bg-theme">A faire</span>
                                        @else
                                            <span class="badge bg-danger">Fait</span>
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
                                        @if($user_id == $cdp_id)
                                            <div class="pull-right hidden-phone">
                                                <form action="{{route('check.tache')}}" method="POST">
                                                    {{csrf_field()}}
                                                    <input type="hidden" name="id" value="{{$tache->id}}">
                                                    <button type="submit" class="btn btn-success btn-xs"><i
                                                                class=" fa fa-check"
                                                                onclick="confirm('Cette tâche a bien été réalisé ?')"></i>
                                                    </button>
                                                    <a href="#tache{{$tache->id}}"
                                                       class="btn btn-primary btn-xs"
                                                       data-toggle="modal"
                                                       aria-controls="#tache{{$tache->id}}"><i class="fa fa-pencil"></i></a>
                                                    <a href="{{action('tacheController@destroy', $tache->id)}}"
                                                       data-method="delete"
                                                       data-confirm="Souhaitez-vous réellement supprimer cette tâche ?"
                                                       class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></a>
                                                </form>
                                            </div>
                                        @endif
                                    </div>
                                </li>
                            </ul>
                                @if($user_id == $cdp_id)
                                @include('tache.edit')
                            @endif
                            @include('tache.index')
                                @if(session()->has('success'.$tache->id) || session()->has('destroy'.$tache->id) || session()->has('edit'.$tache->id))
                                    <script src="{{ asset('js/jquery.js') }}"></script>
                                    <script src="{{ asset('js/jquery-1.8.3.min.js') }}"></script>
                                    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
                                    <script>
                                        $('#voirtache{{$tache->id}}').modal('show');
                                    </script>
                                @endif
                        @endforeach
                    @else
                        @if($totalTask != 0)
                            <p class="alert alert-success">
                                Toutes les tâches ont été effectué !
                            </p>
                        @else
                            <p class="alert alert-warning">
                                Aucune tâche n'a été créee !
                            </p>
                        @endif
                    @endif
                </div>
            </div>
        </section>
    </div><!-- /col-md-12-->
</div><!-- /row -->