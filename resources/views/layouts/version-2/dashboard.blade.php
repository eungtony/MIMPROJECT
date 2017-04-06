@php
	// ID de l'utilisateur
	$user_id = Auth::user()->id;
	// Statut de l'utilisateur
	$statut_id = Auth::user()->statut_id;
	//
	$ca_id = 1;
	// Recuperation de 5 projets de l'agence de l'utilisateur
	$projets = \App\Projet::where('agence_id', \Illuminate\Support\Facades\Auth::user()->agence_id)->take(5)->get();
@endphp

@extends('layouts.version-2.layouts.app')

@section('modals')
<!-- Modal slide stick top -->
<div class="md-modal md-slide-stick-top" id="md-slide-stick-top-rename">
	<div class="md-content">
		<h3>Modal Dialog Rename</h3>
		<div>
			<p>This is a modal window. You can do the following things with it:</p>	

			{!! Form::open(['url' => route('edit.agence', $agence->id) ]) !!}

				{!! Form::token() !!}

				<div class="form-group">

					{!! Form::label('nom', 'Nouveau nom') !!}

					{!! Form::text('nom', $agence->nom, ['class' => 'form-control']) !!}

				</div>

			{!! Form::close() !!}

			<button class="btn btn-danger md-close">Fermer!</button>
			<button class="btn btn-success md-close">Valider</button>
			</p>
		</div>
	</div><!-- End div .md-content -->
</div><!-- End div .md-modal .md-slide-stick-top -->
<!-- Modal slide stick top -->
<div class="md-modal md-slide-stick-top" id="md-slide-stick-top-message">
	<div class="md-content">
		<h3>Modal Dialog Message</h3>
		<div>
			<p>This is a modal window. You can do the following things with it:</p>
			
			{!! Form::open(['url' => '']) !!}

				{!! Form::token() !!}

				<div class="form-group">

					{!! Form::label('message', 'Votre message') !!}

					{!! Form::textarea('message', '', ['class' => 'form-control']) !!}

				</div>

			{!! Form::close() !!}

			<p>
			<button class="btn btn-danger md-close">Fermer!</button>
			<button class="btn btn-success md-close">Valider</button>
			</p>
		</div>
	</div><!-- End div .md-content -->
</div><!-- End div .md-modal .md-slide-stick-top -->
@endsection

@section('content')
<div class="row top-summary">
	<div class="col-md-12" style="text-align: center;">
		<h2>{{ $agence->nom }}</h2>
		<p class="text-muted"><i>Lorem ipsum</i></p>
		<button class="btn btn-primary btn-xs md-trigger" data-modal="md-slide-stick-top-rename">
			<i class="fa fa-pencil fa-fw"></i> RENOMMER
		</button>
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

@if (isset($members))

	<div class="row top-summary">
		<div class="col-md-12" style="text-align: center;">
			<h2>Membres de l'agence</h2>
			<hr>
		</div>
	</div>

	<div class="row">

		@foreach ($members as $member)
			<div class="col-lg-4 portlets">
				<div id="website-statistics1" class="widget">
					<div class="widget-header transparent">
						<h2><i class="icon-user"></i> Nom <strong>Prénom</strong></h2>
						<div class="additional-btn">
							<a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>
							<a href="#" class="widget-close"><i class="icon-cancel-3"></i></a>
						</div>
					</div>
					<div class="widget-content">
						<div id="website-statistic" class="statistic-chart">	
							<div class="row stacked">
								<div class="col-sm-12">
									<div class="toolbar">
										<!-- Space for additional features -->
									</div>
									<div class="clearfix"></div>
									<div style="padding: 15px;text-align: center;">
										<div class="col-xs-4 col-xs-offset-4">
							                <a href="#" class="rounded-image profile-image">
							                	@if($member->avatar == 0)
		                                           <img src="{{ asset('version-2/images/users/user-100.jpg') }}">
		                                        @else
		                                            <img src="{{ asset('avatars/'.$member->id.'.'.$member->extension) }}">
		                                        @endif
							                </a>
							            </div>
										<div class="col-xs-12">
											<p class="text-muted"><i>Poste</i></p>
										</div>
										<div class="col-xs-12">
											<p>{{ $member->description }}</p>
										</div>
										<div class="col-xs-12">
											<a href="#notify-someone-{{ $member->id }}" data-toggle="modal" data-target="#notify-someone-{{ $member->id }}" class="btn btn-primary btn-sm">
	                                            <i class="fa fa-envelope-o f-fw"></i> NOTIFIE
	                                        </a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		@endforeach

	</div>
@endif

<div class="row top-summary">
	<div class="col-md-12" style="text-align: center;">
		<h2>Partage de fichiers</h2>
		<hr>
	</div>
</div>

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
								<div class="title">
									<h3>Tâches relatives au projet</h3>
									<hr>
								</div>
								<div class="table-responsive">
									<table data-sortable class="table">
										<thead>
											<tr>
												<th>No</th>
												<th style="width: 30px" data-sortable="false"><input type="checkbox" class="rows-check"></th>
												<th>Description</th>
												<th>Etat</th>
												<th>Attribué à</th>
												<th>Type</th>
												<th>Délai</th>
												<th data-sortable="false">Option</th>
											</tr>
										</thead>
										
										<tbody>
											<tr>
												<td>1</td>
												<td><input type="checkbox" class="rows-check"></td>
												<td>Une tâche</td>
												<td><span class="label label-danger">A Faire</span></td>
												<td><strong>John Doe</strong></td>
												<td>Gestion de projet</td>
												<td>J - 25</td>
												<td>
													<div class="btn-group btn-group-xs">
														<a data-toggle="tooltip" title="Off" class="btn btn-default"><i class="fa fa-power-off"></i></a>
														<a data-toggle="tooltip" title="Edit" class="btn btn-default"><i class="fa fa-edit"></i></a>
													</div>
												</td>
											</tr>
											<tr>
												<td>2</td>
												<td><input type="checkbox" class="rows-check"></td>
												<td>Une tâche</td>
												<td><span class="label label-success">Fait</span></td>
												<td><strong>John Doe</strong></td>
												<td>Gestion de projet</td>
												<td>J - 25</td>
												<td>
													<div class="btn-group btn-group-xs">
														<a data-toggle="tooltip" title="Off" class="btn btn-default"><i class="fa fa-power-off"></i></a>
														<a data-toggle="tooltip" title="Edit" class="btn btn-default"><i class="fa fa-edit"></i></a>
													</div>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('version-2/assets/libs/d3/d3.v3.js') }}"></script>
<script src="{{ asset('version-2/assets/libs/rickshaw/rickshaw.min.js') }}"></script>
<script src="{{ asset('version-2/assets/libs/raphael/raphael-min.js') }}"></script>
<script src="{{ asset('version-2/assets/libs/morrischart/morris.min.js') }}"></script>
<script src="{{ asset('version-2/assets/libs/jquery-knob/jquery.knob.js') }}"></script>
<script src="{{ asset('version-2/assets/libs/jquery-jvectormap/js/jquery-jvectormap-1.2.2.min.js') }}"></script>
<script src="{{ asset('version-2/assets/libs/jquery-jvectormap/js/jquery-jvectormap-us-aea-en.js') }}"></script>
<script src="{{ asset('version-2/assets/libs/jquery-clock/clock.js') }}"></script>
<script src="{{ asset('version-2/assets/libs/jquery-easypiechart/jquery.easypiechart.min.js') }}"></script>
<script src="{{ asset('version-2/assets/libs/jquery-weather/jquery.simpleWeather-2.6.min.js') }}"></script>
<script src="{{ asset('version-2/assets/libs/bootstrap-xeditable/js/bootstrap-editable.min.js') }}"></script>
<script src="{{ asset('version-2/assets/libs/bootstrap-calendar/js/bic_calendar.min.js') }}"></script>
<script src="{{ asset('version-2/assets/js/apps/calculator.js') }}"></script>
<script src="{{ asset('version-2/assets/js/apps/todo.js') }}"></script>
<script src="{{ asset('version-2/assets/js/apps/notes.js') }}"></script>
<script src="{{ asset('version-2/assets/js/pages/index.js') }}"></script>
@endsection