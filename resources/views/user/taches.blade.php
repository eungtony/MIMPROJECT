<div class="modal fade" id="mestaches" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                Toutes mes tâches
            </div>
            <div class="modal-body">
                <?php $mesTaches = \App\Travail::where('user_id', Auth::user()->id)->with('categorie')->paginate(10); ?>
                @foreach($mesTaches as $tache)
                    <?php $date = \Carbon\Carbon::createFromFormat('Y-m-d', $tache->date);
                    $difference = ($date->diff($now)->days < 1) ? 'today' : $date->diffInDays($now); ?>
                    <div class="alert @if($tache->fait == 1) alert-success @else alert-danger @endif">
                        <h4>{{$tache->titre}}</h4>
                        <p>
                            {{$tache->commentaire}}
                        </p>
                        <p class="text-right">
                            <span class="label label-info">{{$tache->categorie->titre}}</span>
                            @if($tache->fait == 0)
                                <span class="label label-primary">J - {{$difference}}</span>
                            @else
                                <span class="label label-success">Fait</span>
                            @endif
                        </p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>