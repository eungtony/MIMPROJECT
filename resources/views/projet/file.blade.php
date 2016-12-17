<form action="{{route('file.edit.projet', [$projet->agence_id,$projet->id,$file->id])}}" class="form-inline"
      method="post">
    {{csrf_field()}}
    <div class="form-group">
        <input class="form-control" type="text" name="titre"
               value="{{$file->titre}}">
    </div>
    <div class="form-group">
        <button class="btn btn-primary">Modifier</button>
    </div>
    <a href="{{route('file.delete.projet', [$file->agence_id,$file->projet_id,$file->id])}}" class="btn btn-danger"
       data-method="delete"
       data-confirm="Voulez-vous supprimer ce fichier ?">
        <i class="fa fa-trash-o "></i>
    </a>
</form>