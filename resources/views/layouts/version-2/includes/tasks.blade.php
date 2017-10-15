@php
    $taches = \App\Travail::where('user_id', \Illuminate\Support\Facades\Auth::user()->id)
    ->with('projet', 'categorie')
    ->where('fait', 0)
    ->get();
@endphp

<li class="dropdown iconify hide-phone">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-tasks"></i>
        <span class="label label-danger absolute">
            @php
                echo $taches->count();
            @endphp
        </span>
    </a>
</li>