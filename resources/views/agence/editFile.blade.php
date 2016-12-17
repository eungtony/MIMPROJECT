<div class="collapse" id="editFile{{$file->id}}">
    <div class="row mt">
        <div class="col-md-12">
            <form action="{{route('file.edit', [$agence->id,$file->id])}}" method="post" class="form-inline">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="">Modifier le nom du fichier</label>
                    <input class="form-control" type="text" name="titre"
                           value="{{$file->titre}}">
                </div>
                <div class="form-group">
                    <button class="btn btn-primary">Modifier</button>
                </div>
                <a href="{{route('file.delete', [$agence->id,$file->id])}}" class="btn btn-danger"
                   data-method="delete"
                   data-confirm="Voulez-vous supprimer ce fichier ?">
                    <i class="fa fa-trash-o "></i>
                </a>
            </form>
        </div>
    </div>
</div>