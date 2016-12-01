<div class="collapse" id="file">
    <hr>
    <form action="{{route('file.agence', $agence->id)}}" enctype="multipart/form-data"
          method="POST">
        {{csrf_field()}}
        <div class="form-group">
            <label for="">Nommer votre fichier</label>
            <input class="form-control" type="text" name="titre">
        </div>
        <div class="form-group">
            <label for="">Téleverser un fichier</label>
            <input type="file" name="file" class="form-control">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">
                Téleverser
            </button>
        </div>
    </form>
</div>