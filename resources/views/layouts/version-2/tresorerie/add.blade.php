<div class="modal fade" id="money" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                Ajouter ou retirer un montant
            </div>
            <div class="modal-body">
                <form action="{{route('money')}}" method="POST">
                    {{csrf_field()}}
                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                    <div class="form-group">
                        <input type="text" class="form-control" name="libelle" placeholder="Libellé du montant">
                    </div>
                    <div class="form-group">
                        <input type="number" class="form-control" name="montant" placeholder="Montant en €">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Valider le montant</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

