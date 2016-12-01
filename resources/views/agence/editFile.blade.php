<form action="{{route('file.edit', [$agence->id,$file->id])}}" method="post">
    {{csrf_field()}}
    <div class="form-group">
        <input class="form-control" type="text" name="titre"
               value="{{$file->titre}}">
    </div>
    <div class="form-group">
        <button class="btn btn-primary">Modifier</button>
    </div>
</form>