@extends('layouts.application')

@section('content')
<div class="row">
	@foreach ($events as $event)
		<!-- Bloc Evenement -->
		<div class="col-lg-4">
			<div class="content-panel" style="min-height: 260px;">
				<div class="options" style="float: right;">
					@if ($event->from == Auth::user()->id)
						<a href="{{ url('delete/event' . $event->id) }}" class="btn btn-danger btn-xs">
							<i class="fa fa-trash-o"></i>
						</a>
						<a href="#editevent-{{ $event->id }}" class="btn btn-primary btn-xs" data-toggle="modal">
							<i class="fa fa-pencil"></i>
						</a>
					@endif
					<a href="" class="btn btn-primary btn-xs" data-toggle="modal">
						<i class="fa fa-eye"></i>
					</a>
				</div>
				<br>
				<div class="title text-center">
					<h2>{{ $event->title }}</h2>
					<muted>{{ $event->date }}</muted>
				</div>
				<p>{{ $event->description }}</p>
				<div class="text-center">
					@if (count($subscribers) == 0)
						<a href="{{ url('register/event/' . $event->id . '/' . Auth::user()->id) }}" class="btn btn-success btn-md">
							<strong>JE M'INSCRIS</strong>
						</a>
					@else
						@foreach ($subscribers as $subscriber)
							@if ($subscriber->event_id == $event->id && $subscriber->subscriber_id == Auth::user()->id)
								<a href="{{ url('unregister/event/' . $event->id . '/' . Auth::user()->id) }}" class="btn btn-danger btn-md">
									<strong>JE RAGEQUIT</strong>
								</a>
							@else
								<a href="{{ url('register/event/' . $event->id . '/' . Auth::user()->id) }}" class="btn btn-success btn-md">
									<strong>JE M'INSCRIS</strong>
								</a>
							@endif
						@endforeach
					@endif
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