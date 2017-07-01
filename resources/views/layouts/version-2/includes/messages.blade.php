@php
    $notifs = App\Notifications::get();
    $users = App\User::get();
    $names = [];
    foreach ($users as $user) { $names[$user->id] = $user->name; }
    // Compte des notifications
    $countNotif = 0;
    foreach ($notifs as $notif) {
        if ($notif->type == 'team' && $notif->to == Auth::user()->agence_id) {
            $countNotif++;
        } elseif ($notif->type == 'personal' && $notif->to == Auth::user()->id) {
            $countNotif++;
        } elseif ($notif->type == 'global') {
            $countNotif++;
        }
    }
@endphp

<li class="dropdown iconify hide-phone">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i><span class="label label-danger absolute">3</span></a>
    <ul class="dropdown-menu dropdown-message">
        <li class="dropdown-header notif-header"><i class="icon-mail-2"></i> Vos Messages</li>
        
        @foreach ($notifs as $notif)
                
            @php
                $user = \App\User::findOrFail($notif->sender);
                $user_id = 'user';
                $user_extension = 'png';
                if ($user->avatar) {
                    $user_id = $user->id;
                    $user_extension = $user->extension;
                }
            @endphp

            <!-- On verifie que les noifications sont destinées à l'utilisateur ou son équipe -->
            @if ($notif->type == 'team' && $notif->to == Auth::user()->agence_id)
                <li>
                    <a href="#" class="clearfix">
                        <img src="{{ asset('version-2/images/users/chat/3.jpg') }}" class="xs-avatar ava-dropdown" alt="Avatar">
                        <strong>{{ $names[$notif->sender] }}</strong><i class="pull-right msg-time">{{ $notif->created_at }}</i><br />
                        <p>{{ substr($notif->message, 0, 50) . "..." }}</p>
                    </a>
                </li>
            <!-- On verifie que les notifications sont destinées personnellement à l'utilsateur -->
            @elseif($notif->type == 'personal' && $notif->to == Auth::user()->id)
                <li>
                    <a href="#" class="clearfix">
                        <img src="{{ asset('version-2/images/users/chat/3.jpg') }}" class="xs-avatar ava-dropdown" alt="Avatar">
                        <strong>{{ $names[$notif->sender] }}</strong><i class="pull-right msg-time">{{ $notif->created_at }}</i><br />
                        <p>{{ substr($notif->message, 0, 50) . "..." }}</p>
                    </a>
                </li>
            <!-- On verifie si les notifications sont pour tout le monde -->
            @elseif($notif->type == 'global')
                <li>
                    <a href="#" class="clearfix">
                        <img src="{{ asset('version-2/images/users/chat/3.jpg') }}" class="xs-avatar ava-dropdown" alt="Avatar">
                        <strong>{{ $names[$notif->sender] }}</strong><i class="pull-right msg-time">{{ $notif->created_at }}</i><br />
                        <p>{{ substr($notif->message, 0, 50) . "..." }}</p>
                    </a>
                </li>
            @endif
        @endforeach

        <li class="dropdown-footer">
            <div class="">
                <a href="#" class="btn btn-sm btn-block btn-primary"><i class="fa fa-share"></i> Voir tout les messages</a>
            </div>
        </li>
    </ul>
</li>