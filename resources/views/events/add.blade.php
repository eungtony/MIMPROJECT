<div class="modal fade" id="addevent" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                Créer un Evenement
            </div>
            <div class="modal-body">
                <form action="{{ route('add.event') }}" method="POST">

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <input type="hidden" value="{{ Auth::user()->id }}" name="from">

                    <div class="form-group">
                        <label for="">Titre de l'évenement</label>
                        <input type="text" name="title" class="form-control">
                    </div>

                    <div class="form-group">
                        <textarea class="form-control"
                                  name="description"
                                  placeholder="Description de l'évenement ..."></textarea>
                    </div>

                    <div class="form-group">
                        <label for="">Date</label><br>
                        <input type="text" id="datepicker" name="date"
                               class="form-control">
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            Créer l'évenement
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>