<div class="collapse" id="agence{{$agence->id}}">
    <form action="{{route('edit.agence', $agence->id)}}">

        <div class="form-group">
            <input class="form-control" type="text" name="nom" value="{{$agence->nom}}">
        </div>

        <h4>Sélectionnez le chef de l'agence</h4>

        <div class="form-group">
            <select name="user_id" class="form-control" value="{{$agence->user_id}}">
                @foreach($users as $user)
                    <option value="{{$user->id}}"
                            @if($user->id == $cdp_id) selected @endif>{{$user->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <button class="btn btn-primary" type="submit">Modifier l'agence</button>
        </div>

    </form>
</div>