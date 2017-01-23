@extends('layouts.application')

@section('content')
    <div class="row mt">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-content">
                <div class="panel-body">
                    
                    <h3>Demandes de comptes</h3>
                    <hr>
                    <table class="table table-striped">
	                    <thead>
	                      <tr>
	                          <th>Pseudo</th>
	                          <th>Statut</th>
	                          <th>Date de demande</th>
	                          <th>Validation</th>
	                      </tr>
	                    </thead>
	                    <tbody>
	                        @foreach ($users as $user)
	                        	<tr>
	                        		<td>{{ $user->name }}</td>
	                        		<td>
		                        		@if ($user->is_valid == 0)
		                        			<p class="text-danger">Non Valide</p>
		                        		@else
		                        			<p class="text-success">Valide</p>
		                        		@endif
		                        	</td>
		                        	<td>
		                        		{{ $user->created_at }}
		                        	</td>
		                        	<td>
		                        		@if ($user->is_valid == 0)
		                        			<a href="{{ url('/users/valid/' . $user->id) }}" class="btn btn-success btn-sm">VALIDE</a>
		                        		@else
		                        			<a href="{{ url('/users/unvalid/' . $user->id) }}" class="btn btn-danger btn-sm">INVALIDE</a>
		                        		@endif
		                        	</td>
	                        	</tr>
	                        @endforeach
	                    </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection