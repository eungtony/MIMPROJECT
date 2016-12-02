<div class="modal fade" id="addtask{{$projet->id}}" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                Ajouter une tâche
            </div>
            <div class="modal-body">
                <form action="{{route('add.tache')}}" method="POST">

                    <input type="hidden" name="_token"
                           value="{{ csrf_token() }}">

                    <input type="hidden" value="{{$projet->id}}"
                           name="projet_id">
                    <input type="hidden" value="{{$projet->agence_id}}"
                           name="agence_id">
                    <div class="form-group">
                        <input class="form-control" type="text" class=""
                               name="titre"
                               placeholder="Titre de la tâche">
                    </div>

                    <div class="form-group">
                                                                        <textarea class="form-control"
                                                                                  name="commentaire"
                                                                                  placeholder="Commentaire de la tâche"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="">Catégorie de la tâche</label>
                        <select name="categorie_id" id=""
                                class="form-control">
                            @foreach($categories as $categorie)
                                <option value="{{$categorie->id}}">{{$categorie->titre}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">Date</label><br>
                        <input type="text" id="datepicker" name="date"
                               class="form-control">
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            Ajouter la tâche
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>