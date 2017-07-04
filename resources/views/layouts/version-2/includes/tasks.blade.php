@php
$taches = \App\Travail::where('user_id', \Illuminate\Support\Facades\Auth::user()->id)
->with('projet', 'categorie')
->where('fait', 0)
->get();
@endphp

<li class="dropdown iconify hide-phone">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-tasks"></i><span
                class="label label-danger absolute">

        @php
            echo $taches->count();
            @endphp

    </span></a>
    <ul class="dropdown-menu dropdown-message">
        <li class="dropdown-header notif-header"><i class="icon-mail-2"></i> Vos tâches</li>

        @foreach ($taches as $tache)
            <li>
                <a href="#voirtache{{$tache->id}}" data-toggle="modal">
                    <strong>{{ $tache->titre }}</strong><i class="pull-right msg-time">{{ $tache->date }}</i><br/>
                    <p>{{ substr($tache->commentaire, 0, 50) . "..." }}</p>
                </a>
            </li>
        @endforeach

        <li class="dropdown-footer">
            <div class="">
                <a href="" class="btn btn-sm btn-block btn-primary">
                    <i class="fa fa-share"></i> Voir toutes mes tâches
                </a>
            </div>
        </li>
    </ul>
</li>