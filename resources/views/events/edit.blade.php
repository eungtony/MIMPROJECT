<div class="modal fade" id="editevent-{{ $event->id }}" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                Modifier un Evenement
            </div>
            <div class="modal-body">
                <form action="{{ url('edit/event/' . $event->id) }}" method="POST">

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <input type="hidden" value="{{ $event->id }}" name="id">

                    <div class="form-group">
                        <label for="">Titre de l'évenement</label>
                        <input type="text" name="title" class="form-control" value="{{ $event->title }}">
                    </div>

                    <div class="form-group">
                        <textarea class="form-control"
                          name="description"
                          placeholder="Description de l'évenement ...">
                              {{ $event->description }}
                        </textarea>
                    </div>

                    <div class="form-group">
                        <label for="">Date</label><br>
                        <input type="text" id="datepicker" name="date" class="form-control" value="{{ $event->date }}">
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-md">
                            <strong>MODIFIER</strong>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>