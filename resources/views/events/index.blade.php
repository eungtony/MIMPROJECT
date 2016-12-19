@extends('layouts.application')

@section('content')
<div class="row">
	@foreach ($events as $event)
		<!-- Bloc Evenement -->
		<div class="col-lg-4">
			<div class="content-panel" style="min-height: 260px;">
				@if ($event->from == Auth::user()->id)
					<div class="options" style="float: right;">
						<a href="{{ url('delete/event' . $event->id) }}" class="btn btn-danger btn-xs">
							<i class="fa fa-trash-o"></i>
						</a>
						<a href="#editevent-{{ $event->id }}" class="btn btn-primary btn-xs" data-toggle="modal">
							<i class="fa fa-pencil"></i>
						</a>
					</div>
				@endif
				<br>
				<div class="title text-center">
					<h2>{{ $event->title }}</h2>
					<muted>{{ $event->date }}</muted>
				</div>
				<p>{{ $event->description }}</p>
				<div class="text-center">
					<button class="btn btn-success btn-md">
						<strong>JE M'INSCRIS</strong>
					</button>
				</div>
			</div>
		</div>
		<!-- Modal d'édition d'evenements -->
		@include('events.edit')
		<!-- Modal d'édition d'evenements -->
		<!-- Bloc Evenement -->
	@endforeach
</div>
@endsection