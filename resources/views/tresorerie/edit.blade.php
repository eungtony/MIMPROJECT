<div class="modal fade" id="editlivret{{$livret->id}}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                Modifier le montant
            </div>
            <div class="modal-body">
                <form action="{{route('edit.montant', $livret->id)}}" method="POST">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="">Modifier le libellé</label>
                        <input type="text" class="form-control" value="{{$livret->libelle}}" name="libelle">
                    </div>
                    <div class="form-group">
                        <label for="">Modifier le montant</label>
                        <input type="text" class="form-control" value="{{$livret->montant}}" name="montant">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success" type="submit">Modifier le montant</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>