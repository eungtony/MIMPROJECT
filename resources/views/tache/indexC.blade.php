<div class="collapse" id="voirTache{{$tache->id}}">
    <p>{{$tache->commentaire}}</p>
    <p class="text-right">{{$tache->date}}</p>
    <p class="text-right">{{$tache->categorie->titre}}</p>
    @if($tache->user == null)
        <p class="text-right">Aucune personne assignée</p>
    @else
        <p class="text-right">{{$tache->user->name}}</p>
    @endif
</div>