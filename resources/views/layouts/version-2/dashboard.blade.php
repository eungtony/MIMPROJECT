@extends('layouts.version-2.layouts.app')

@section('content')
<div class="row top-summary">
	<div class="col-md-12" style="text-align: center;">
		<h2>Team Ngoky</h2>
		<p class="text-muted"><i>Lorem ipsum</i></p>
		<button class="btn btn-warning btn-xs"><i class="fa fa-pencil fa-fw"></i> EDITER</button>
		<hr>
	</div>
</div>
<!-- Start info box -->
<div class="row top-summary">
	<div class="col-lg-3 col-md-6">
		<div class="widget green-1 animated fadeInDown">
			<div class="widget-content padding">
				<div class="widget-icon">
					<i class="icon-list"></i>
				</div>
				<div class="text-box">
					<p class="maindata">TOTAL <b>TACHES</b></p>
					<h2><span class="animate-number" data-value="3" data-duration="2000">0</span></h2>
					<div class="clearfix"></div>
				</div>
			</div>
			<div class="widget-footer">
				<div class="row">
					<div class="col-sm-12">
						<i>* uniquement vos tâches</i> 
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>

	<div class="col-lg-3 col-md-6">
		<div class="widget darkblue-2 animated fadeInDown">
			<div class="widget-content padding">
				<div class="widget-icon">
					<i class="icon-bag"></i>
				</div>
				<div class="text-box">
					<p class="maindata">TOTAL <b>PROJETS</b></p>
					<h2><span class="animate-number" data-value="2" data-duration="2000">0</span></h2>

					<div class="clearfix"></div>
				</div>
			</div>
			<div class="widget-footer">
				<div class="row">
					<div class="col-sm-12">
						<i>* projets de l'agence en cours</i>
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>

	<div class="col-lg-3 col-md-6">
		<div class="widget orange-4 animated fadeInDown">
			<div class="widget-content padding">
				<div class="widget-icon">
					<i class="fa fa-eur"></i>
				</div>
				<div class="text-box">
					<p class="maindata">MONTANT <b>RECOLTE</b></p>
					<h2><span class="animate-number" data-value="832" data-duration="2000">0</span> €</h2>
					<div class="clearfix"></div>
				</div>
			</div>
			<div class="widget-footer">
				<div class="row">
					<div class="col-sm-12">
						<i>* montant recolté par votre agence</i>
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>

	<div class="col-lg-3 col-md-6">
		<div class="widget lightblue-1 animated fadeInDown">
			<div class="widget-content padding">
				<div class="widget-icon">
					<i class="fa fa-envelope"></i>
				</div>
				<div class="text-box">
					<p class="maindata">TOTAL <b>MESSAGES</b></p>
					<h2><span class="animate-number" data-value="6" data-duration="2000">0</span></h2>
					<div class="clearfix"></div>
				</div>
			</div>
			<div class="widget-footer">
				<div class="row">
					<div class="col-sm-12">
						<i>* uniquement vos messages</i>
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>

</div>
<!-- End of info box -->

<!-- Début fichiers partagées -->
<div class="row">
	<div class="col-lg-12 portlets">
		<div id="website-statistics1" class="widget">
			<div class="widget-header transparent">
				<h2><i class="icon-share"></i> Fichiers <strong>Partagés</strong></h2>
			</div>
			<div class="widget-content" style="padding: 10px;">
				<div class="row stacked">
					<div class="col-lg-12">
						<span class="btn btn-danger btn-xs"><strong>Pas de fichiers en partage.</strong></span>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Fin fichiers partagées -->

<div class="row top-summary">
	<div class="col-md-12" style="text-align: center;">
		<h2>Projets de l'agence</h2>
		<hr>
	</div>
</div>

<div class="row">
	<div class="col-lg-12 portlets">
		<div id="website-statistics1" class="widget">
			<div class="widget-header transparent">
				<h2><i class="icon-bag"></i> Projet : <strong>Solution 10</strong></h2>
				<div class="additional-btn">
					  <a class="hidden" id="dropdownMenu1" data-toggle="dropdown">
						<i class="fa fa-plus"></i>
					  </a>
					  <ul class="dropdown-menu pull-right" role="menu" aria-labelledby="dropdownMenu1">
						<li><a href="#">Détails du projet</a></li>
						<li><a href="#">Editer projet</a></li>
						<li class="divider"></li>
						<li><a href="#">Supprimer projet</a></li>
					  </ul>
					 <a href="#" class="widget-popout hidden tt" title="Pop Out/In"><i class="icon-publish"></i></a>
					<a href="#" class="widget-maximize hidden"><i class="icon-resize-full-1"></i></a>
					<a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>
					<a href="#" class="widget-close"><i class="icon-cancel-3"></i></a>
				</div>
			</div>
			<div class="widget-content" style="display: none;">
				<div id="website-statistic" class="statistic-chart">	
					<div class="row stacked">
						<div class="col-sm-12">
							<div class="toolbar">
								<!-- Space for additional features -->
							</div>
							<div class="clearfix"></div>
							<div style="padding: 15px;">
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odio distinctio, assumenda dolore soluta pariatur quidem mollitia, repudiandae laborum animi illo molestias blanditiis obcaecati minus nostrum omnis id voluptatum, fuga dolorem.</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-lg-12 portlets">
		<div id="website-statistics1" class="widget">
			<div class="widget-header transparent">
				<h2><i class="icon-bag"></i> Projet : <strong>PlayBoy</strong></h2>
				<div class="additional-btn">
					  <a class="hidden" id="dropdownMenu1" data-toggle="dropdown">
						<i class="fa fa-plus"></i>
					  </a>
					  <ul class="dropdown-menu pull-right" role="menu" aria-labelledby="dropdownMenu1">
						<li><a href="#">Détails du projet</a></li>
						<li><a href="#">Another action</a></li>
						<li><a href="#">Something else here</a></li>
						<li class="divider"></li>
						<li><a href="#">Separated link</a></li>
					  </ul>
					 <a href="#" class="widget-popout hidden tt" title="Pop Out/In"><i class="icon-publish"></i></a>
					<a href="#" class="widget-maximize hidden"><i class="icon-resize-full-1"></i></a>
					<a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>
					<a href="#" class="widget-close"><i class="icon-cancel-3"></i></a>
				</div>
			</div>
			<div class="widget-content" style="display: none;">
				<div id="website-statistic" class="statistic-chart">	
					<div class="row stacked">
						<div class="col-sm-12">
							<div class="toolbar">
								<!-- Space for additional features -->
							</div>
							<div class="clearfix"></div>
							<div style="padding: 15px;">
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odio distinctio, assumenda dolore soluta pariatur quidem mollitia, repudiandae laborum animi illo molestias blanditiis obcaecati minus nostrum omnis id voluptatum, fuga dolorem.</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection