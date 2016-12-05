@extends('layouts.application')

@section('content')
<div class="row mt">
	<div class="col-lg-12">
		<h1 class="text-center">{{ $agence->nom }}</h1>
	</div>
	<div class="col-lg-12">
		<h2>Membres</h2>
		<ul>
			@foreach ($members as $member)
				<li>
					{{ $member->name }} - 
					<a href="{{ url('add/notif/personal/' . $member->id) }}" class="fa fa-envelope fa-fw"></a>
				</li>
			@endforeach
		</ul>
	</div>
</div>
@endsection