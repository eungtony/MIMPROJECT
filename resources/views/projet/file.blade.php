<form action="{{route('file.edit.projet', [$projet->agence_id,$projet->id,$file->id])}}"
      method="post">
    {{csrf_field()}}
    <div class="form-group">
        <input class="form-control" type="text" name="titre"
               value="{{$file->titre}}">
    </div>
    <button class="btn btn-primary">Modifier</button>
</form>