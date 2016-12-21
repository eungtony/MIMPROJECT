<div class="modal fade" id="list-{{ $event->id }}" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                Liste des inscrits
            </div>
            <div class="modal-body">
                <table class="table table-striped">
                    <thead>
                      <tr>
                          <th>Nom / Prénom</th>
                          <th>Option</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($subscribers as $subscriber)
                            @if ($subscriber->event_id == $event->id)
                                <tr>
                                    <td>{{ $list[ $subscriber->subscriber_id ] }}</td>
                                    <td>
                                        <a href="#notify-someone-{{ $subscriber->subscriber_id }}" class="btn btn-primary btn-xs">
                                            <i class="fa fa-envelope"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>