<!-- Left Sidebar Start -->
<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">
       <!-- Search form -->
        <form role="search" class="navbar-form">
            <!--
            <div class="form-group">
                <input type="text" placeholder="Search" class="form-control">
                <button type="submit" class="btn search-button"><i class="fa fa-search"></i></button>
            </div>
            -->
        </form>
        <div class="clearfix"></div>
        <!--- Profile -->
        <div class="profile-info" style="margin-top: 25px;">
            <div class="col-xs-4">
                <a href="profile.html" class="rounded-image profile-image">
                    <img src="{{ asset('version-2/images/users/user-100.jpg') }}">
                </a>
            </div>
            <div class="col-xs-8">
                <div class="profile-text">Bienvenue <b>{{ Auth::user()->name }}</b></div>
                <div class="profile-buttons">
                  <a href="javascript:;"><i class="fa fa-envelope-o pulse"></i></a>
                  <a href="#connect" class="open-right"><i class="fa fa-comments"></i></a>
                  <a href="javascript:;" title="Sign Out"><i class="fa fa-power-off text-red-1"></i></a>
                </div>
            </div>
        </div>
        <!--- Divider -->
        <div class="clearfix"></div>
        <hr class="divider" />
        <div class="clearfix"></div>
        <!--- Divider -->
        <div id="sidebar-menu">
            <ul>
                <li class='has_sub'><a href='javascript:void(0);'><i class='icon-home-3'></i><span>Dashboard</span> <span class="pull-right"><i class="fa fa-angle-down"></i></span></a>
                    <ul>
                        <li><a href="{{ url('/home') }}" class='active'><span>Dashboard d'agence</span></a></li>
                    </ul>
                </li>
                <li class='has_sub'><a href='javascript:void(0);'><i class='icon-user'></i><span>{{ Auth::user()->name }}</span> <span class="pull-right"><i class="fa fa-angle-down"></i></span></a>
                    <ul>
                        <li><a href="{{ route('user') }}"><span>Profil</span></a></li>
                        <li><a href="{{ route('agence', Auth::user()->agence_id) }}"><span>Agence</span></a></li>
                        <li><a href="{{ url('/logout') }}"><span>Déconnexion</span></a></li>
                    </ul>
                </li>
                <li class='has_sub'><a href='javascript:void(0);'><i class='icon-megaphone'></i><span>Evenements</span> <span class="pull-right"><i class="fa fa-angle-down"></i></span></a>
                    <ul>
                        <li><a href='forms.html'><span>Lancer un évènement</span></a></li>
                        <li><a href="{{ route('index.event') }}"><span>Voir les évènements</span></a></li>
                    </ul>
                </li>
                <li class='has_sub'><a href='javascript:void(0);'><i class='fa fa-eur'></i><span>Trésorerie</span> <span class="pull-right"><i class="fa fa-angle-down"></i></span></a>
                    <ul>
                        <li><a href="{{ route('livret') }}"><span>Livret de comptes</span></a></li>
                        <li><a href='datatables.html'><span>Datatables</span></a></li>
                    </ul>
                </li>
                <li class='has_sub'><a href='javascript:void(0);'><i class='fa fa-users'></i><span>Agences</span> <span class="pull-right"><i class="fa fa-angle-down"></i></span></a>
                    <ul>
                        <li><a href='google-maps.html'><span>Agence 1</span></a></li>
                        <li><a href='vector-maps.html'><span>Agence 2</span></a></li>
                    </ul>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
    <div class="clearfix"></div>
    <div class="portlets">
        <div id="recent_tickets" class="widget transparent nomargin">
            <h2>Recent Tickets</h2>
            <div class="widget-content">
                <ul class="list-unstyled">
                    <li>
                        <a href="javascript:;">My wordpress blog is broken <span>I was trying to save my page and...</span></a>
                    </li>
                    <li>
                        <a href="javascript:;">Server down, need help!<span>My server is not responding for the last...</span></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="clearfix"></div><br><br><br>
</div>
    <div class="left-footer">
        <div class="progress progress-xs">
          <div class="progress-bar bg-green-1" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
            <span class="progress-precentage">80%</span>
          </div>
          
          <a data-toggle="tooltip" title="See task progress" class="btn btn-default md-trigger" data-modal="task-progress"><i class="fa fa-inbox"></i></a>
        </div>
    </div>
</div>
<!-- Left Sidebar End -->