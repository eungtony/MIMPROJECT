<div class="modal fade" id="progression_projet">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                Détail de l'avancée du projet
            </div>
            <div class="modal-body">
                @if($projet->etape_id !== 0)
                    @foreach($etapes as $etape)
                        <p
                                @if($etape->id == $projet->etape_id) class="alert alert-success" @endif
                        @if($etape->id < $projet->etape_id) class="alert alert-primary" style="opacity:0.5;" @endif
                                @if($etape->id > $projet->etape_id) class="alert alert-danger"
                                style="opacity:0.5;" @endif>
                            {{$etape->etape}}
                        </p>
                    @endforeach
                @else
                    <p class="alert alert-warning">
                        Projet non commencé
                    </p>
                @endif
            </div>
        </div>
    </div>
</div>