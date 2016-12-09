<div class="collapse" id="editMessage{{$message->id}}">
    <div class="panel-content">
        <form action="{{route('message.edit', $message->id)}}" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <input class="form-control" type="text" name="titre"
                       value="{{$message->titre}}" class="form-control">
            </div>
            <div class="form-group">
                       <textarea class="form-control" type="text" name="message" class="form-control">
                          {{$message->message}}
                       </textarea>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    Editer le message
                </button>
            </div>
        </form>
    </div>
</div>