<div class="modal fade" id="message" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                Publier un message
            </div>
            <div class="modal-body">

                <form action="{{route('message.agence', [$agence->id, Auth::user()->id])}}" method="POST">
                    {{csrf_field()}}
                    <input type="hidden" name="agence_id" value="{{$agence->id}}">
                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                    <div class="form-group">
                        <input type="text" class="form-control" name="titre" placeholder="Titre de votre message">
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" name="message">
                            Votre message
                        </textarea>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success" type="submit">
                            Publier votre message !
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>