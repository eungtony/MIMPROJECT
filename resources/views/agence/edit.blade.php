<div class="collapse" id="agence{{$agence->id}}">
    <form action="{{route('edit.agence', $agence->id)}}">

        <div class="form-group">
            <input class="form-control" type="text" name="nom" value="{{$agence->nom}}">
        </div>

        <div class="form-group">
            <button class="btn btn-primary" type="submit">Modifier le nom de l'agence</button>
        </div>

    </form>
</div>