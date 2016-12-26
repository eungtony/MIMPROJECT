<div class="modal fade" id="notify-someone-{{ $user->id }}" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                Envoyer une notification
            </div>
            <div class="modal-body">

                <form action="{{ url('add/notif/personal/' . $user->id) }}" method="POST">

                    {{ csrf_field() }}

                    <input type="hidden" name="type" value="personal">

                    <input type="hidden" name="to" value="{{ $user->id }}">

                    <p style="text-align: left;"><strong>Aide : </strong>Vous pouvez envoyer une notification à <strong>{{ $user->name }}</strong>, celle-ci ne pourra être lue que par cette personne.</p>
                    
                    <div class="form-group">
                        <label for="message" class="">Votre Message</label><br/>
                        <textarea name="message" id="summernote" cols="30" rows="10" class="form-control"></textarea>
                    </div>

                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Envoyer</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>