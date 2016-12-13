<?php
$commentaires = \App\TacheCommentaire::where('travail_id', $tache->id)->orderBy('created_at', 'desc')->get();
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
                <ins>Commentaires</ins>
                @foreach($commentaires as $commentaire)
                    <div class="tache_comm">
                        {{$commentaire->commentaire}}
                    </div>
                    <hr>
                @endforeach
                <form action="{{action('tacheController@addCommentaire')}}" method="post">
                    {{csrf_field()}}
                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                    <input type="hidden" name="projet_id" value="{{$tache->projet_id}}">
                    <input type="hidden" name="travail_id" value="{{$tache->id}}">
                    <input type="hidden" name="agence_id" value="{{$tache->agence_id}}">
                    <input type="text" name="commentaire">
                    <input type="submit" value="valider">
                </form>
            </div>
        </div>
    </div>
</div>
