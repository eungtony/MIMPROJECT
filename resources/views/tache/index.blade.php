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
                @endif
                <hr>
                <h3>Commentaires</h3>
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
                            </li>
                        @endforeach
                    </ul>
                @endif
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
            </div>
        </div>
    </div>
</div>
