<div class="modal fade" id="notify-team-{{ $agence->id }}" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                Envoyer une notification
            </div>
            <div class="modal-body">

                <form action="{{ url('add/notif/team/' . $agence->id) }}" method="POST">

                    {{ csrf_field() }}

                    <input type="hidden" name="type" value="team">

                    <input type="hidden" name="to" value="{{ $agence->id }}">

                    <p style="text-align: left;"><strong>Aide : </strong>Vous pouvez envoyer une notification à l'agence {{ $agence->nom }}, celle-ci pourra être vue par tout les membres de l'équipe notifiée.</p>
                    
                    <div class="form-group">
                        <label for="message" class="">Votre Message</label><br/>
                        <textarea name="message" id="" cols="30" rows="10" class="form-control"></textarea>
                    </div>

                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Envoyer</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>