<?php
$commentaires = \App\TacheCommentaire::where('travail_id', $tache->id)->with('user')->orderBy('created_at', 'desc')->get();
?>
<div class="modal fade" id="voirtache{{$tache->id}}" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                {{$tache->titre}}
            </div>
            <div class="modal-body">
                <p>{{$tache->commentaire}}</p>
                <p class="text-right">{{$tache->date}}</p>
                <p class="text-right">{{$tache->categorie->titre}}</p>
                @if($tache->user == null)
                    <p class="text-right">Aucune personne assignée</p>
                @else
                    <p class="text-right">{{$tache->user->name}}</p>
                    @endifheuresta
                    @if(Auth::user()->id == $tache->user_id)
                        <a href="#heures{{$tache->id}}" data-toggle="collapse">Notez mes heures</a>
                        <div class="collapse" id="heures{{$tache->id}}">
                            <form action="" class="form-inline">
                                <div class="form-group">
                                    <label for="">Notez mes heures sur cette tâche</label>
                                    <input type="number" class="form-control" name="heures">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Ajouter mes heures</button>
                                </div>
                            </form>
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