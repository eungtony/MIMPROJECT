<?php
$taches = \App\Travail::where('user_id', \Illuminate\Support\Facades\Auth::user()->id)->where('fait', 0)->get();
$agences = \App\Agence::get();
$now = \Carbon\Carbon::now();
?>
        <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <meta name="csrf-token" content="{!! csrf_token() !!}">

    <title>@yield('title')</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <!--external css-->
    <link href="{{ asset('font-awesome/css/font-awesome.css') }}" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/zabuto_calendar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('js/gritter/css/jquery.gritter.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('lineicons/style.css') }}">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style-responsive.css') }}" rel="stylesheet">

    <!-- Our Custom code -->
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

    <script src="{{ asset('js/chart-master/Chart.js') }}"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style type="text/css">
        .content-panel {
            padding: 15px;
        }
    </style>
</head>

<body>

<section id="container">
    <!-- TOP BAR CONTENT & NOTIFICATIONS -->
    <!--header start-->
    <header class="header black-bg">
        <div class="sidebar-toggle-box">
            <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
        </div>
        <!--logo start-->
        <a href="{{url('/')}}" class="logo"><b>Troyes Point Zéro</b></a>
        <!--logo end-->
        <div class="nav notify-row" id="top_menu">
            <!--  notification start -->
            <ul class="nav top-menu">
                <!-- settings start -->
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="index.html#">
                        <i class="fa fa-tasks"></i>
                        <span class="badge bg-theme">{{ $taches->count() }}</span>
                    </a>
                    <ul class="dropdown-menu extended tasks-bar">
                        <div class="notify-arrow notify-arrow-green"></div>
                        <li>
                            <p class="green">Mes tâches</p>
                        </li>
                        <li>
                            @if($taches->isEmpty())
                                <p class="text-danger">Vous n'avez pas de tâches en cours</p>
                            @else
                                @foreach($taches as $tache)
                                    <?php
                                    $date = \Carbon\Carbon::createFromFormat('Y-m-d', $tache->date);
                                    $difference = ($date->diff($now)->days < 1) ? 'today' : $date->diffInDays($now);
                                    ?>
                                    <div class="task-info">
                                        <div class="desc">
                                            <a href="#voirtache{{$tache->id}}" data-toggle="modal">
                                                {{$tache->titre}}
                                                @if($difference > 0)
                                                    <span class="label label-info">J - {{ $difference }}</span>
                                                @else
                                                    <span class="label label-danger">{{ $difference }} jours
                                                        de retard !!</span>
                                                @endif
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </li>
                        @if (count($taches) != 0)
                            <li class="external">
                                <a href="#mestaches" data-toggle="modal">Voir toutes les tâches</a>
                            </li>
                        @endif
                    </ul>
                </li>
                <!-- settings end -->
                <!-- inbox dropdown start-->

                @include('notifications');

                <!-- inbox dropdown end -->
            </ul>
            <!--  notification end -->
        </div>
        <div class="top-menu">
            <ul class="nav pull-right top-menu">
                <li><a class="logout" href="{{ url('/logout') }}">Déconnexion</a></li>
            </ul>
        </div>
    </header>
    <!--header end-->

    <!-- MAIN SIDEBAR MENU -->
    <!--sidebar start-->
    <aside>
        <div id="sidebar" class="nav-collapse ">
            <!-- sidebar menu start-->
            <ul class="sidebar-menu" id="nav-accordion">

                <p class="centered">
                    <a href="{{route('profile', Auth::user())}}">
                        @if(Auth::user()->avatar == 0)
                            <img src="{{ asset('img/ui-sam.jpg') }}" class="img-circle" width="60">
                        @else
                            <img src="{{ asset('avatars/'.Auth::user()->id.'.'.Auth::user()->extension) }}"
                                 class="img-circle" width="60">
                        @endif
                    </a>
                </p>
                <h5 class="centered">{{ Auth::user()->name }}</h5>

                <li class="mt">
                    <a class="active" href="{{ url('/home') }}">
                        <i class="fa fa-dashboard"></i>
                        <span>Tableau de bord</span>
                    </a>
                </li>

                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-user"></i>
                        <span>{{ Auth::user()->name }}</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{ route('user') }}">Mon profil</a></li>
                        <li><a href="{{ url('/logout') }}">Déconnexion</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-user"></i>
                        <span>Notifications</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{ url('add/notif/global') }}">Globale</a></li>
                        <li><a href="{{ url('add/notif/team') }}">Equipe</a></li>
                    </ul>
                </li>

                @if(Auth::user()->statut_id == 1)
                    <li class="sub-menu">
                        <a href="javascript:;">
                            <i class="fa fa-cogs"></i>
                            <span>Administration</span>
                        </a>
                        <ul class="sub">
                            <li><a href="{{ url('/supervisor') }}">Voir les Agences</a></li>
                        </ul>
                    </li>
                @endif
                @if(Auth::user()->statut_id == 1 || Auth::user()->statut_id == 2)
                    <?php
                    $agences = \App\Agence::all();
                    ?>
                    <li class="sub-menu">
                        <a href="javascript:;">
                            <i class="fa fa-cogs"></i>
                            <span>Trésorerie</span>
                        </a>
                        <ul class="sub">
                            <li><a href="{{ url('/supervisor') }}">Gérer la trésorerie</a></li>
                            <li><a href="#money" data-toggle="modal">Ajouter un montant</a></li>
                        </ul>
                    </li>
                    <li class="sub-menu">
                        <a href="javascript:;">
                            <i class="fa fa-cogs"></i>
                            <span>Les agences</span>
                        </a>
                        <ul class="sub">
                            @foreach($agences as $agence)
                                <li class="mt">
                                    <a href="{{ route('agence', $agence) }}">
                                        <i class="fa fa-dashboard"></i>
                                        <span>{{$agence->nom}}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @endif

            </ul>
            <!-- sidebar menu end-->
        </div>
    </aside>
    <!--sidebar end-->

    <!-- MAIN CONTENT -->
    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">
            @foreach($taches as $tache)
                @include('tache.index')
            @endforeach
            @include('user.taches')
            @include('flash')
            @yield('content')
        </section>
    </section>

    <!--main content end-->
    <!--footer start-->
    <footer class="site-footer">
        <div class="text-center">
            2017 - TPZ - version 1.0
            <a href="#" class="go-top">
                <i class="fa fa-angle-up"></i>
            </a>
        </div>
    </footer>
    <!--footer end-->
</section>

<!-- js placed at the end of the document so the pages load faster -->
<script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{ asset('js/jquery-1.8.3.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script class="include" type="text/javascript" src="{{ asset('js/jquery.dcjqaccordion.2.7.js') }}"></script>
<script src="{{ asset('js/jquery.scrollTo.min.js') }}"></script>
<script src="{{ asset('js/jquery.nicescroll.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/jquery.sparkline.js') }}"></script>


<!--common script for all pages-->
<script src="{{ asset('js/common-scripts.js') }}"></script>

<script type="text/javascript" src="{{ asset('js/gritter/js/jquery.gritter.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/gritter-conf.js') }}"></script>

<!--script for this page-->
<script src="{{ asset('js/sparkline-chart.js') }}"></script>
<script src="{{url('/js/laravel.js')}}"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $(function () {
        $("#datepicker").datepicker({dateFormat: 'yy-mm-dd'});
    });
</script>

</body>
</html>
