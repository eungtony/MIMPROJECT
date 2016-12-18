<?php
$commentaires = \App\TacheCommentaire::where('travail_id', $tache->id)->with('user')->orderBy('created_at', 'desc')->get();
$mesheures = \App\HeuresTaches::where('user_id', Auth::user()->id)->where('tache_id', $tache->id)->get();
$heuresnotes = 0;
foreach ($mesheures as $mesheure) {
    $heuresnotes = $heuresnotes + $mesheure->heures;
}
?>
<div class="modal fade" id="voirtache{{$tache->id}}" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                {{$tache->titre}}
            </div>
            <div class="modal-body">
                <p>{{$tache->commentaire}}</p>
                <span class="badge bg-danger">{{$tache->date}}</span>
                <span class="badge bg-important">{{$tache->categorie->titre}}</span>
                @if($tache->user == null)
                    <span class="badge bg-success">Aucune personne assignée</span>
                @else
                    <span class="badge bg-success">{{$tache->user->name}}</span>
                @endif
                <span class="badge bg-info">
                    {{$heuresnotes}}h notées
                </span><br>
                @if(Auth::user()->id == $tache->user_id)
                    <hr>
                    <a href="#heures{{$tache->id}}" data-toggle="collapse">Notez mes heures</a>&nbsp;
                    <a href="#mesheures{{$tache->id}}" data-toggle="collapse">Historique des heures
                        notées</a>
                    <div class="collapse" id="heures{{$tache->id}}">
                        <form action="{{route('add.hours')}}" method="POST">
                            {{csrf_field()}}
                            <input type="hidden" name="agence_id" value="{{$tache->agence_id}}">
                            <input type="hidden" name="projet_id" value="{{$tache->projet_id}}">
                            <input type="hidden" name="tache_id" value="{{$tache->id}}">
                            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                            <div class="form-group col-md-6">
                                <label for="">Notez mes heures sur cette tâche</label>
                                <input type="number" class="form-control" name="heures">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Description de la tâche réalisée</label>
                                <input type="text" name="description" class="form-control">
                            </div>
                            <div class="form-group col-md-12">
                                <button type="submit" class="btn btn-primary btn-block">Ajouter mes heures
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="collapse" id="mesheures{{$tache->id}}">
                        @if($mesheures->isEmpty())
                            <p class="alert alert-warning">
                                Aucune heure n'a été noté sur cette tâche !
                            </p>
                        @else
                            @include('tache.heures')
                        @endif
                    </div>
                @endif
                <hr>
                <h3>Commentaires</h3>

                @if(session()->has('success'.$tache->id))
                    <p class="alert alert-success">
                        Votre commentaire a été ajouté avec succès !
                    </p>
                @endif
                @if(session()->has('destroy'.$tache->id))
                    <p class="alert alert-success">
                        Votre commentaire a été supprimé avec succès !
                    </p>
                @endif
                @if(session()->has('edit'.$tache->id))
                    <p class="alert alert-success">
                        Votre commentaire a bien été édité !
                    </p>
                @endif

                @if($commentaires->isEmpty())
                    <p class="alert alert-warning">
                        Aucun commentaire n'a été posté !
                    </p>
                @else
                    <ul class="list-group">
                        @foreach($commentaires as $commentaire)
                            <li class="list-group-item">
                                {{$commentaire->commentaire}}
                                <p class="text-right">
                                    {{$commentaire->user->name}}
                                </p>
                                <p class="text-right">
                                    {{$commentaire->created_at}}
                                </p>
                                @if($commentaire->user_id == Auth::user()->id)
                                    <p class="text-right">
                                        <a href="#editcommentaire{{$commentaire->id}}"
                                           class="btn btn-primary btn-xs"
                                           data-toggle="collapse"
                                           aria-controls="#editcommentaire{{$commentaire->id}}"><i
                                                    class="fa fa-pencil"></i></a>
                                        <a href="{{action('tacheController@deleteCommentaire', [$tache->id, $commentaire->id])}}"
                                           data-method="delete"
                                           data-confirm="Souhaitez-vous réellement supprimer votre commentaire ?"
                                           class="btn btn-danger btn-xs"><i
                                                    class="fa fa-trash-o "></i></a>
                                    </p>
                                @endif
                            </li>
                            @if($tache->agence_id == Auth::user()->agence_id && $tache->user_id == Auth::user()->id)
                                <div class="collapse" id="editcommentaire{{$commentaire->id}}">
                                    <form action="{{route('edit.tache.commentaire', [$tache->id, $commentaire->id])}}"
                                          method="POST">
                                        {{csrf_field()}}
                                        <div class="form-group">
                                    <textarea name="commentaire" class="form-control" id="" cols="30" rows="5">
                                        {{$commentaire->commentaire}}
                                    </textarea>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Editer votre commentaire
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            @endif
                        @endforeach
                    </ul>
                @endif
                @if($tache->agence_id == Auth::user()->agence_id && $tache->user_id == Auth::user()->id)
                    <h4 class="text-center">
                        <a href="#ajoutCommentaire{{$tache->id}}" data-toggle="collapse">
                            Ajouter un commentaire
                        </a>
                    </h4>
                    <div class="collapse" id="ajoutCommentaire{{$tache->id}}">
                        <form action="{{action('tacheController@addCommentaire')}}" method="post">
                            {{csrf_field()}}
                            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                            <input type="hidden" name="projet_id" value="{{$tache->projet_id}}">
                            <input type="hidden" name="travail_id" value="{{$tache->id}}">
                            <input type="hidden" name="agence_id" value="{{$tache->agence_id}}">
                            <div class="form-group">
                                <textarea type="text" class="form-control" name="commentaire" rows="5"></textarea>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" value="Ajouter un commentaire">
                            </div>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>