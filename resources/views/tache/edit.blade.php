<div class="modal fade" id="tache{{$tache->id}}" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                Modifier cette tâche
            </div>
            <div class="modal-body">
                <form action="{{route('edit.tache', [$tache->id,$tache->projet_id])}}"
                      method="POST">
                    <input type="hidden" name="_token"
                           value="{{ csrf_token() }}">

                    <div class="form-group">
                        <input class="form-control" type="text"
                               name="titre"
                               value="{{$tache->titre}}">
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" name="commentaire" id="" cols="30" rows="7">
                            {{$tache->commentaire}}
                        </textarea>
                    </div>
                    <div class="form-group">
                        <select name="categorie_id" class="form-control">
                            @foreach($categories as $categorie)
                                <option
                                        @if($categorie->id == $tache->categorie_id) selected @endif
                                value="{{$categorie->id}}" id="">{{$categorie->titre}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="" @if($tache->user_id == 0) style="color:red;" @endif >Assignez une personne</label>
                        <select name="user_id" class="form-control">
                            @foreach($users as $u)
                                <option value="{{$u->id}}"
                                        @if($u->id == $tache->user_id) selected @endif >{{$u->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Date</label><br>
                        <input type="text" name="date" value="{{$tache->date}}"
                               class="form-control datepicker" style="color:black; padding:10px;"/>
                    </div>
                    <div class="form-group">
                        <label for="" class="checkbox-inline">
                            <input type="checkbox" name="fait"
                                   value="{{$tache->fait}}"
                                   @if($tache->fait == 1) checked @endif>
                            Etat de la tâche
                        </label>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success"
                                type="submit">
                            Modifier cette tâche
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>