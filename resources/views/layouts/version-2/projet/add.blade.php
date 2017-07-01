<div class="widget collapse" id="projet{{$agence->id}}" style="padding: 15px;">
    <div class="widget-content">
        <form action="{{route('add.projet')}}" method="POST">
            <input class="form-control" type="hidden" name="_token" value="{{ csrf_token() }}">

            <input class="form-control" type="hidden" value="{{$agence->id}}" name="agence_id">

            <div class="form-group">
                <input class="form-control" type="text" name="nom" class="form-control"
                       placeholder="Nom du projet">
            </div>

            <div class="form-group">
                <textarea class="form-control" type="text" name="commentaire" class="form-control"
                          placeholder="Description du projet"></textarea>
            </div>

            <div class="form-group">
                <label for="">Total heures requis</label><br>
                <input class="form-control" type="number" name="total_heures">
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    Ajouter le projet
                </button>
            </div>
        </form>
    </div>
</div>