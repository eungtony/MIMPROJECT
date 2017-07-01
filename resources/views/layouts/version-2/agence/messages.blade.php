<?php 
    $agence_id = Auth::user()->agence_id;
    $messages = \App\Message::where('agence_id', $agence_id)->orderBy('id', 'desc')->get();
?>
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
                            @if($user_id == $cdp_id || $statut_id == 1)
                            <div class="text-right">
                                <a href="#editMessage{{$message->id}}"
                                   data-toggle="collapse"
                                   class="btn btn-primary btn-xs" style="color:white;"><i
                                            class="fa fa-pencil-square-o"></i></a>
                                    <a href="{{action('agenceController@deleteMessage', [$message->agence_id,$message->id])}}"
                                       data-method="delete"
                                       data-confirm="Souhaitez-vous réellement supprimer ce message ?"
                                       class="btn btn-danger btn-xs" style="color:white;"><i class="fa fa-trash-o"></i></a>
                            </div>
                                @include('agence.editMessage')
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>