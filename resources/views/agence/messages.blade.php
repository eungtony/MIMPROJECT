<?php $agence_id = Auth::user()->agence_id;
$messages = \App\Message::where('agence_id', $agence_id)->orderBy('id', 'desc')->get(); ?>
<div class="modal fade" id="messages" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                Tous les messages de votre agence
            </div>
            <div class="modal-body">
                <div class="list-group">
                    @foreach($messages as $message)
                        <div class="list-group-item">
                            <h4>{{$message->titre}}</h4>
                            <p>{{$message->message}}</p>
                            <p class="text-right">{{$message->created_at}}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>