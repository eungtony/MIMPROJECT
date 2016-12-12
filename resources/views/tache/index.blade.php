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
            </div>
        </div>
    </div>
</div>