<div class="modal fade" id="listDevis" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                Liste des devis à valider
            </div>
            <div class="modal-body">
                <div class="list-group">
                    @foreach($devisList as $devis)
                        <?php
                        $agence = \App\Agence::findOrFail($devis->agence_id);
                        $devisTitle = $agence->nom;
                        ?>
                        <div class="list-group-item">
                            <h3>{{$devis->projet->nom}}</h3>
                            <p>{{substr($devis->projet->commentaire, 0, 50)}}</p>
                            <p class="text-right">{{$devisTitle}}</p>
                            <a href="{{route('projet', [$devis->agence_id, $devis->projet_id])}}#devis"
                               class="btn btn-info">Voir le devis</a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>