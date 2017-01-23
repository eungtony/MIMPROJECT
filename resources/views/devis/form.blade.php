<form class="form-inline" action="{{route('add.devis.task', [$projet->agence_id, $projet->id, $devis_id])}}"
      method="POST">
    {{csrf_field()}}
    <div class="form-group">
        <label for="">Libellé</label>
        <input type="text" class="form-control" name="libelle">
    </div>
    <div class="form-group">
        <label for="">Prix</label>
        <input type="number" class="form-control" name="prix">
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i></button>
    </div>
</form>