@php
	// ID de l'utilisateur
	$user_id = Auth::user()->id;
	// Statut de l'utilisateur
	$statut_id = Auth::user()->statut_id;
	//
	$ca_id = 1;
	// Recuperation de 5 projets de l'agence de l'utilisateur
	$projets = \App\Projet::where('agence_id', \Illuminate\Support\Facades\Auth::user()->agence_id)->take(5)->get();
	// MESSAGES
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

@extends('layouts.version-2.layouts.app')

@section('content')
<div class="row top-summary">
	<div class="col-md-12" style="text-align: center;">
		<h2>{{ $agence->nom }}</h2>

		<!-- Si l'utilisateur fait partie de l'agence -->
		@if (Auth::user()->agence_id == $agence->id)
			<a href="#agence{{$agence->id}}" data-toggle="collapse" aria-expanded="false"
	           aria-controls="#agence{{$agence->id}}" style="margin-bottom: 15px;">
	            <button class="btn btn-primary btn-xs md-trigger" data-modal="md-slide-stick-top-rename">
					<i class="fa fa-pencil fa-fw"></i> RENOMMER
				</button>
	        </a>
		@endif
		
		@if($user_id == $cdp_id || Auth::user()->statut_id == 2)
			<a href="#projet{{$agence->id}}" data-toggle="collapse" aria-expanded="false"
               aria-controls="#projet{{$agence->id}}" style="margin-bottom: 15px;">
                <button class="btn btn-success btn-xs md-trigger">
                	<i class="fa fa-plus fa-fw"></i> PROJET
                </button>
            </a>
		@endif
		<!-- Si l'utilisateur fait partie de l'agence -->

		<hr>

		<!-- Modal d'ajout de projets -->
		@include('layouts.version-2.projet.add')
		<!-- Modal d'ajout de projets -->

		@include('agence.edit')
		
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
					<h2><span class="animate-number" data-value="{{ count($taches) }}" data-duration="2000">0</span></h2>
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
					<h2><span class="animate-number" data-value="{{ count($projets) }}" data-duration="2000">0</span></h2>

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
					<h2><span class="animate-number" data-value="{{ $bankable }}" data-duration="2000">0</span> €</h2>
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
					<h2><span class="animate-number" data-value="{{ $countNotif }}" data-duration="2000">0</span></h2>
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

<div class="row top-summary">
	<div class="col-md-12" style="text-align: center;">
		<h2>Partage de fichiers</h2>
		<hr>
	</div>
</div>

@if(Auth::user()->agence_id == $agence->id)
<div class="row">
	<div class="col-lg-12 portlets animated fadeInDown">
		<div id="website-statistics1" class="widget">
			<div class="widget-header transparent">
				<h2><i class="icon-share"></i> Fichiers <strong>Partagés</strong></h2>
			</div>
		    <div class="widget-panel upload-panel" style="padding: 15px">
		        <!-- TELECHARGEMENT -->

		        @php
		        	$files = \App\File::where('agence_id', $agence->id)->where('projet_id', NULL)->get();
		        @endphp

		        @if(!$files->isEmpty())
		            @foreach($files as $file)
		                <a href="{{app_path()}}/{{$agence->id}}/{{$file->name}}.{{$file->extension}}"
		                   download="{{$file->titre}}">
		                    {{$file->titre}}
		                </a>
		                <a href="#editFile{{$file->id}}" data-toggle="collapse" class="btn btn-primary btn-xs">Modifier
		                    le fichier</a>
		                @if($user_id == $cdp_id)
		                    @include('agence.editFile')
		                @endif
		            @endforeach
		        @else
		            <p>
						<span class="btn btn-danger btn-xs"><strong>Pas de fichiers en partage.</strong></span>
					</p>
		        </span>
		        @endif

		        <hr>
	            <a href="#file" class="btn btn-primary btn-sm"
	               data-toggle="collapse" aria-expanded="false"
	               aria-controls="#file">
	                Téléverser un fichier
	            </a>

		        @include('agence.file')
		    	<!-- TELECHARGEMENT -->
		    </div>
		</div>
	</div>
</div>
@endif

<div class="row top-summary">
	<div class="col-md-12" style="text-align: center;">
		<h2>Projets de l'agence</h2>
		<hr>
	</div>
</div>

<div class="row">
	<div class="col-lg-12 portlets">
		@if($projets->isEmpty())
            <p class="alert alert-warning text-center">
                Aucun projet n'a été crée !
            </p>
        @else

        	@foreach ($projets as $projet)
        		@php
        			$taches = \App\Travail::where('projet_id', $projet->id)->orderBy('id', 'desc')->get();
                    if (request()->only('sort')['sort'] == 'date') {
                        $taches = \App\Travail::where('projet_id', $projet->id)->orderBy('date', 'asc')->get();
                    } elseif (request()->only('sort')['sort'] == 'category') {
                        $taches = \App\Travail::where('projet_id', $projet->id)->orderBy('categorie_id', 'asc')->get();
                    } elseif (request()->only('sort')['sort'] == 'done') {
                        $taches = \App\Travail::where('projet_id', $projet->id)->orderBy('fait', 'desc')->get();
                    }
                    $taches->load('user');
                    $users = \App\User::where('agence_id', $projet->agence_id)->get();
                    $done = \App\Travail::where('projet_id', $projet->id)->where('fait', 1)->get()->count();
                    $total = \App\Travail::where('projet_id', $projet->id)->get()->count();
                    $projet_heures = \App\HeuresTaches::where('projet_id', $projet->id)->get();
                    $heures_notees = 0;
                    foreach ($projet_heures as $heure) {
                        $heures_notees = $heures_notees + $heure->heures;
                    }
                    $pc = 0;
                    $pc_projet = 0;
                    $heures = 0;

                    if ($total_etape > 0) {
                        $pc_projet = 100 * $projet->etape_id / $total_etape;
                    }

                    if ($total > 0) {
                        $pc = 100 * $done / $total;
                    }
                    if ($projet->total_heures > 0) {
                        $heures = 100 * $heures_notees / $projet->total_heures;
                    }

                    $etape = "Le projet n'a pas encore commencé";
                    if ($projet->etape_id > 0) {
                        $etape = \App\Etape::findOrFail($projet->etape_id);
                    }
        		@endphp

				<div id="website-statistics1" class="widget animated fadeInDown">
					<div class="widget-header transparent">
						<h2><i class="icon-bag"></i> Projet : <strong>{{ $projet->nom }}</strong></h2>
						<div class="additional-btn">
							  <a class="hidden" id="dropdownMenu1" data-toggle="dropdown">
								<i class="fa fa-plus"></i>
							  </a>
							  <ul class="dropdown-menu pull-right" role="menu" aria-labelledby="dropdownMenu1">
								<li>
									<a href="{{ route('projet', [$projet->agence_id, $projet->id]) }}">Détails du projet</a>
								</li>
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
											<h4>Description du projet :</h4>
											<p>{{ $projet->commentaire }}</p>
											<hr>
										</div>
										<div>
											<h4 class="project-title">Progression dans les tâches :  
												<strong>
													{{$heures_notees}}h / {{$projet->total_heures}}h - 
                                                </strong>
                                                <strong>
                                                	@if (round($pc) < 50)
                                                		<span class="text-danger">{{ round($pc) }} %</span>
                                                	@elseif (round($pc) >= 50 && round($pc) < 75) 
														<span class="text-warning">{{ round($pc) }} %</span>
													@else
														<span class="text-success">{{ round($pc) }} %</span>
                                                	@endif
                                                </strong>
											</h4>
											<hr>
										</div>
										<div class="title">
											<h4>Tâches relatives au projet :</h4>
											<hr>
										</div>

										@php
											$taskDone = \App\Travail::where('projet_id', $projet->id)
												->where('fait', 1)->get()->count();
                    						$totalTask = \App\Travail::where('projet_id', $projet->id)->get()->count();
										@endphp

										@if($taskDone != $totalTask)
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
	                        					@foreach($taches as $tache)
	                        						@php
	                        							$date = \Carbon\Carbon::createFromFormat('Y-m-d', $tache->date);
	                            						$difference = ($date->diff($now)->days < 1) ? 'today' : $date->diffInDays($now);
	                        						@endphp
	                        						<tr>
														<td>{{ $tache->id }}</td>
														<td><input type="checkbox" class="rows-check"></td>
														<td>{{ $tache->titre }}</td>
														<td>
															@if($tache->fait == 0)
					                                            <span class="label label-danger">A Faire</span>
					                                        @else
					                                            <span class="label label-success">Fait</span>
					                                        @endif
														</td>
														<td>
															@if($tache->user)
				                                                <strong>{{$tache->user->name}}</strong>
				                                            @else
				                                                <strong>Aucune personne assignée</strong>
				                                            @endif
														</td>
														<td>{{ $tache->categorie->titre }}</td>
														<td>
															@if ($tache->fait == 0)
																J - {{ $difference }}
															@else 
																-
															@endif
														</td>
														<td>
															<div class="btn-group btn-group-xs">
																<a data-toggle="tooltip" title="Off" class="btn btn-default"><i class="fa fa-power-off"></i></a>
																<a data-toggle="tooltip" title="Edit" class="btn btn-default"><i class="fa fa-edit"></i></a>
															</div>
														</td>
													</tr>
	                        					@endforeach
	                        				</table>
	                        			</div>
                        				@endif
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

        	@endforeach

        @endif
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