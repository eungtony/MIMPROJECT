<div class="modal fade" id="edit{{$projet->id}}" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                Editer le projet
            </div>
            <div class="modal-body">
                <form action="{{route('edit.projet', $projet->id)}}" method="POST">

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="form-group">
                        <input class="form-control" type="text" name="nom"
                               value="{{$projet->nom}}" class="form-control"
                               placeholder="Nom du projet">
                    </div>

                    <div class="form-group">
                                    <textarea class="form-control" type="text" name="commentaire" class="form-control"
                                              placeholder="Description du projet">
                                        {{$projet->commentaire}}
                                    </textarea>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="">Encaissé</label><br>
                        <input class="form-control" type="number" name="encaisse"
                               value="{{$projet->encaisse}}">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="">Facturable</label><br>
                        <input class="form-control" type="number" name="facturable"
                               value="{{$projet->facturable}}">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="">Total heures requis</label><br>
                        <input class="form-control" type="number" name="total_heures"
                               value="{{$projet->total_heures}}">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="">Heures faites</label><br>
                        <input class="form-control" type="number" name="heures_faites"
                               value="{{$projet->heures_faites}}">
                    </div>

                    <div class="form-group">
                        <select class="form-control" name="etape_id">
                            @foreach($etapes as $etape)
                                <option value="{{$etape->id}}"
                                        @if($etape->id == $projet->etape_id) selected @endif>{{$etape->etape}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            Editer le projet
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>