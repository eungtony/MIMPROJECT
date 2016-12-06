@extends('layouts.application')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="form-panel"><a href="{{ url()->previous() }}">Retour</a></div>
                <div class="form-panel">

                    <div class="panel-heading">
                        <h1>Créer une Notification</h1>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perspiciatis quidem quae inventore. Dignissimos repudiandae velit inventore quos, aliquam quaerat sit, architecto cumque consequuntur porro assumenda, repellat. Nesciunt quia, ut doloremque!</p>
                    </div>

                    <div class="panel-body">
                        <form action="" method="POST">

                            {{ csrf_field() }}

                            <input type="hidden" name="type" value="{{ $type }}">

                            @if ($type == 'personal')
                                <input type="hidden" name="to" value="{{ $id }}">
                            @endif

                            @if ($type == 'team')
                                <div class="form-group">
                                    <!-- Si il existe des agences -->
                                    @if (!empty($agences))
                                        <label for="to">Agence</label>
                                        <select name="to" id="" class="form-control">
                                            <!-- On les affiches -->
                                            @foreach ($agences as $agence)
                                                <option value="{{ $agence->id }}">{{ $agence->nom }}</option>
                                            @endforeach
                                        </select><br/>
                                    <!-- Sinon -->
                                    @else
                                        <!-- On informe qu'aucune agence n'existe -->
                                        <p>Aucune agence disponible ...</p>
                                    @endif
                                </div>
                            @endif

                            <div class="form-group">
                                <label for="message" class="">Votre Message</label><br/>
                                <textarea name="message" id="" cols="30" rows="10" class="form-control"></textarea>
                            </div>

                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Envoyer</button>
                            </div>
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
@endsection
