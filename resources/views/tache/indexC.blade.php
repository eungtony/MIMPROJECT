<div class="collapse" id="voirTache{{$tache->id}}">
    <p>{{$tache->commentaire}}</p>
    <p class="text-right">{{$tache->date}}</p>
    <p class="text-right">{{$tache->categorie->titre}}</p>
    <p class="text-right">{{$tache->user->name}}</p>
</div>