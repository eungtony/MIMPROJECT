@php
	$taches = \App\Travail::where('user_id', \Illuminate\Support\Facades\Auth::user()->id)
        ->with('projet', 'categorie')
        ->where('fait', 0)
        ->get();
$promo_id = \App\Promo::where('active', 1)->limit(1)->get();
    // On recupère toutes les agences
if($promo_id->isEmpty()){
$agences = \App\Agence::where('promo_id', 0)->get();
} else {
$agences = \App\Agence::where('promo_id', $promo_id[0]->id)->get();
}
	// On recupère la date
	$now = \Carbon\Carbon::now();
	// On recupère l'agence de l'utilisateurs
	$agence = \App\Agence::findOrFail(Auth::user()->agence_id);
	//
	$cdp_id = $agence->user_id;
	// Statut de l'utilisateur
	$statut_id = Auth::user()->statut_id;
	@endphp
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>TPZ | Version 2</title>  
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="description" content="">
        <meta name="keywords" content="coco bootstrap template, coco admin, bootstrap,admin template, bootstrap admin,">
        <meta name="author" content="Huban Creative">
        <meta name="csrf-token" content="{!! csrf_token() !!}">

        <!-- Base Css Files -->
        <link href="{{ asset('version-2/assets/libs/jqueryui/ui-lightness/jquery-ui-1.10.4.custom.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('version-2/assets/libs/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('version-2/assets/libs/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('version-2/assets/libs/fontello/css/fontello.css') }}" rel="stylesheet" />
        <link href="{{ asset('version-2/assets/libs/animate-css/animate.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('version-2/assets/libs/nifty-modal/css/component.css') }}" rel="stylesheet" />
        <link href="{{ asset('version-2/assets/libs/magnific-popup/magnific-popup.css') }}" rel="stylesheet" /> 
        <link href="{{ asset('version-2/assets/libs/ios7-switch/ios7-switch.css') }}" rel="stylesheet" /> 
        <link href="{{ asset('version-2/assets/libs/pace/pace.css') }}" rel="stylesheet" />
        <link href="{{ asset('version-2/assets/libs/sortable/sortable-theme-bootstrap.css') }}" rel="stylesheet" />
        <link href="{{ asset('version-2/assets/libs/bootstrap-datepicker/css/datepicker.css') }}" rel="stylesheet" />
        <link href="{{ asset('version-2/assets/libs/jquery-icheck/skins/all.css') }}" rel="stylesheet" />

        <!-- Code Highlighter for Demo -->
        <link href="{{ asset('version-2/assets/libs/prettify/github.css') }}" rel="stylesheet" />
        
        <!-- Extra CSS Libraries Start -->
        <link href="{{ asset('version-2/assets/libs/rickshaw/rickshaw.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('version-2/assets/libs/morrischart/morris.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('version-2/assets/libs/jquery-jvectormap/css/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('version-2/assets/libs/jquery-clock/clock.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('version-2/assets/libs/bootstrap-calendar/css/bic_calendar.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('version-2/assets/libs/sortable/sortable-theme-bootstrap.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('version-2/assets/libs/jquery-weather/simpleweather.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('version-2/assets/libs/bootstrap-xeditable/css/bootstrap-editable.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('version-2/assets/css/style.css') }}" rel="stylesheet" type="text/css" />
        <!-- Extra CSS Libraries End -->

        <link href="{{ asset('version-2/assets/css/style-responsive.css') }}" rel="stylesheet" />

        <!-- Our Custom code -->
    	<link rel="stylesheet" href="{{ asset('css/custom.css') }}">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <link rel="shortcut icon" href="{{ asset('version-2/assets/img/favicon.ico') }}">
        <link rel="apple-touch-icon" href="{{ asset('version-2/assets/img/apple-touch-icon.png') }}" />
        <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('version-2/assets/img/apple-touch-icon-57x57.png') }}" />
        <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('version-2/assets/img/apple-touch-icon-72x72.png') }}" />
        <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('version-2/assets/img/apple-touch-icon-76x76.png') }}" />
        <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('version-2/assets/img/apple-touch-icon-114x114.png') }}" />
        <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('version-2/assets/img/apple-touch-icon-120x120.png') }}" />
        <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('version-2/assets/img/apple-touch-icon-144x144.png') }}" />
        <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('version-2/assets/img/apple-touch-icon-152x152.png') }}" />
    </head>
    <body class="fixed-left">

    @include('layouts.version-2.includes.modals')	

	<!-- Begin page -->
	<div id="wrapper">
		
    @include('layouts.version-2.includes.top-bar')

	@include('layouts.version-2.includes.left-bar')

	<!-- Start right content -->
    <div class="content-page">
		<!-- ============================================================== -->
		<!-- Start Content here -->
		<!-- ============================================================== -->
        <div class="content">

        	@yield('modals')
			@include('flash')
            @yield('content')
		
			<!-- Footer Start -->
	        <footer>
	            Troyes Point Zero &copy; 2017 - Version 2.0
	            <div class="footer-links pull-right">
	            	<a href="#">About</a><a href="#">Support</a><a href="#">Terms of Service</a><a href="#">Legal</a><a href="#">Help</a><a href="#">Contact Us</a>
	            </div>
	        </footer>
	        <!-- Footer End -->
        
        </div>
		<!-- ============================================================== -->
		<!-- End content here -->
		<!-- ============================================================== -->

    </div>
	<!-- End right content -->

	</div>
	<div id="contextMenu" class="dropdown clearfix">
		    <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu" style="display:block;position:static;margin-bottom:5px;">
		        <li><a tabindex="-1" href="javascript:;" data-priority="high"><i class="fa fa-circle-o text-red-1"></i> High Priority</a></li>
		        <li><a tabindex="-1" href="javascript:;" data-priority="medium"><i class="fa fa-circle-o text-orange-3"></i> Medium Priority</a></li>
		        <li><a tabindex="-1" href="javascript:;" data-priority="low"><i class="fa fa-circle-o text-yellow-1"></i> Low Priority</a></li>
		        <li><a tabindex="-1" href="javascript:;" data-priority="none"><i class="fa fa-circle-o text-lightblue-1"></i> None</a></li>
		    </ul>
		</div>
	<!-- End of page -->
		<!-- the overlay modal element -->
	<div class="md-overlay"></div>
	<!-- End of eoverlay modal -->
	<script>
		var resizefunc = [];
	</script>
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="{{ asset('version-2/assets/libs/jquery/jquery-1.11.1.min.js') }}"></script>
	<script src="{{ asset('version-2/assets/libs/bootstrap/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('version-2/assets/libs/jqueryui/jquery-ui-1.10.4.custom.min.js') }}"></script>
	<script src="{{ asset('version-2/assets/libs/jquery-ui-touch/jquery.ui.touch-punch.min.js') }}"></script>
	<script src="{{ asset('version-2/assets/libs/jquery-detectmobile/detect.js') }}"></script>
	<script src="{{ asset('version-2/assets/libs/jquery-animate-numbers/jquery.animateNumbers.js') }}"></script>
	<script src="{{ asset('version-2/assets/libs/ios7-switch/ios7.switch.js') }}"></script>
	<script src="{{ asset('version-2/assets/libs/fastclick/fastclick.js') }}"></script>
	<script src="{{ asset('version-2/assets/libs/jquery-blockui/jquery.blockUI.js') }}"></script>
	<script src="{{ asset('version-2/assets/libs/bootstrap-bootbox/bootbox.min.js') }}"></script>
	<script src="{{ asset('version-2/assets/libs/jquery-slimscroll/jquery.slimscroll.js') }}"></script>
	<script src="{{ asset('version-2/assets/libs/jquery-sparkline/jquery-sparkline.js') }}"></script>
	<script src="{{ asset('version-2/assets/libs/nifty-modal/js/classie.js') }}"></script>
	<script src="{{ asset('version-2/assets/libs/nifty-modal/js/modalEffects.js') }}"></script>
	<script src="{{ asset('version-2/assets/libs/sortable/sortable.min.js') }}"></script>
	<script src="{{ asset('version-2/assets/libs/bootstrap-fileinput/bootstrap.file-input.js') }}"></script>
	<script src="{{ asset('version-2/assets/libs/bootstrap-select/bootstrap-select.min.js') }}"></script>
	<script src="{{ asset('version-2/assets/libs/bootstrap-select2/select2.min.js') }}"></script>
	<script src="{{ asset('version-2/assets/libs/magnific-popup/jquery.magnific-popup.min.js') }}"></script> 
	<script src="{{ asset('version-2/assets/libs/pace/pace.min.js') }}"></script>
	<script src="{{ asset('version-2/assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
	<script src="{{ asset('version-2/assets/libs/jquery-icheck/icheck.min.js') }}"></script>
    <script src="{{ asset('js/laravel.js') }}"></script>

	<!-- Specific JS Libraries -->
	<script src="{{ asset('version-2/assets/libs/prettify/prettify.js') }}"></script>

	<script src="{{ asset('version-2/assets/js/init.js') }}"></script>
    <script src="{{ asset('summernote/summernote.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.js') }}"></script>
    <script>
        $(function () {
            $("#datepicker").datepicker({dateFormat: 'yy-mm-dd'});
            $("#calendar").datepicker({dateFormat: 'yy-mm-dd'});
            $("#another").datepicker({dateFormat: 'yy-mm-dd'});
            $('#summernote').summernote({
                height: 300,
                lang: 'fr-FR',
            });
        });
    </script>

    @yield('scripts')

	</body>
</html>