@php
    $events = \App\Events::get();
    $subscribers = \App\EventSubscriber::get();
    // Tableau des inscriptions de l'utilisateur courant
    $hadSubscribe = [];
    // On créer un tableau contenant chaque ID d'évènement
    foreach ($events as $event) {
        $hadSubscribe[ $event->id ] = false;
    }
    // Compte des évènements où est inscrit l'élève
    $count = 0;
    // On determine à quel évènement l'utilisateur est inscrit
    foreach ($subscribers as $subscriber) {
        if ($subscriber->subscriber_id == Auth::user()->id) {
            //
            $hadSubscribe[ $subscriber->event_id ] = true;
            //
            $count++;
        }
    }
@endphp

<li id="header_inbox_bar" class="dropdown">
    <a data-toggle="dropdown" class="dropdown-toggle" href="index.html#" style="width: 30px;text-align: center;">
        <i class="fa fa-info"></i>
        <span class="badge bg-theme">
            {{ $count }}
        </span>
    </a>
    <ul class="dropdown-menu extended inbox">
        <div class="notify-arrow notify-arrow-green"></div>
        <li>
            @if ($count != 0)
                <p class="green">Vous participez à {{ $count }} Events !</p>
            @else
                <p class="green">Vous n'avez pas d'Events en cours.</p>
            @endif
        </li>
        <li>
            @foreach ($events as $event)
                @if ($hadSubscribe[ $event->id ] == true)
                    <a href="{{ route('index.event') }}">
                        <span class="subject">
                        <span class="from">{{ $event->title }}</span>
                        <span class="time">{{ $event->created_at }}</span>
                        </span>
                        <span class="message">
                            {{ substr($event->description, 0, 30) . '...' }}
                        </span>
                    </a>
                @endif
            @endforeach
        </li>
        @if ($count != 0)
            <li>
                <a href="{{ route('index.event') }}">Voir tout les évènements</a>
            </li>
        @endif
    </ul>
</li>