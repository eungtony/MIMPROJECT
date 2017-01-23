@php
    $users = App\User::where('is_valid', 0)->get();
@endphp

<li id="header_inbox_bar" class="dropdown">
    <a data-toggle="dropdown" class="dropdown-toggle" href="index.html#">
        <i class="fa fa-user"></i>
        <span class="badge bg-theme">
            {{ count($users) }}
        </span>
    </a>
    <ul class="dropdown-menu extended inbox">
        <div class="notify-arrow notify-arrow-green"></div>
        <li>
            @if (count($users) != 0)
                <p class="green">Vous avez {{ count($users) }} nouvelles demandes</p>
            @else
                <p class="green">Vous n'avez pas de nouvelles demandes</p>
            @endif
        </li>
        @if (count($users) != 0)
            <li>
                <a href="{{ url('/users/validation') }}">Voir les demandes</a>
            </li>
        @endif
    </ul>
</li>