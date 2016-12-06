<div class="modal fade" id="mestaches" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                Toutes mes tâches
            </div>
            <div class="modal-body">
                <?php $mesTaches = \App\Travail::where('user_id', Auth::user()->id)->paginate(10) ?>
                @foreach($mesTaches as $tache)
                    <div class="alert @if($tache->fait == 1) alert-success @else alert-danger @endif">
                        <h4>{{$tache->titre}}</h4>
                        <p>
                            {{$tache->commentaire}}
                        </p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>