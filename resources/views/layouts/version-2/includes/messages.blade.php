@php
    $message = \App\Message::where('agence_id', Auth::user()->agence_id)->count();
@endphp

<li class="dropdown iconify hide-phone">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i><span class="label label-danger absolute">

        @php
            echo $message;
        @endphp

    </span></a>
</li>