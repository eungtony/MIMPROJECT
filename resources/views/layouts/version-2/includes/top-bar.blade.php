@php
    // On recupère toutes les notifications
    $notifs = App\Notifications::get();
    // Onrecupère tous les utilisateurs
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

<!-- Top Bar Start -->
<div class="topbar">
    <div class="topbar-left">
        <div class="logo">
            <h1><a href="#"><img src="{{ asset('version-2/assets/img/logo.png') }}" alt="Logo"></a></h1>
        </div>
        <button class="button-menu-mobile open-left">
        <i class="fa fa-bars"></i>
        </button>
    </div>
    <!-- Button mobile view to collapse sidebar menu -->
    <div class="navbar navbar-default" role="navigation">
        <div class="container">
            <div class="navbar-collapse2">
                <ul class="nav navbar-nav navbar-right top-navbar">

                    @include('layouts.version-2.includes.messages')
                    @include('layouts.version-2.includes.tasks')

                    <li class="dropdown iconify hide-phone"><a href="#" onclick="javascript:toggle_fullscreen()"><i class="icon-resize-full-2"></i></a></li>
                    <li class="dropdown topbar-profile">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="rounded-image topbar-profile-image">
                            <img src="{{ asset('version-2/images/users/user-35.jpg') }}"></span>
                            <strong>{{ Auth::user()->name }}</strong> <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="{{ route('user') }}">Profil</a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="{{ url('/logout') }}" data-modal="logout-modal">
                                    <i class="icon-logout-1"></i> Déconnexion
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
    </div>
</div>
<!-- Top Bar End -->