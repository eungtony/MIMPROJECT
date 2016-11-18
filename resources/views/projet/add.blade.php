@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Ajouter un projet</div>

                    <div class="panel-body">

                        <a href="{{url()->previous()}}">Retour</a>

                        <form action="{{route('add.projet')}}" method="POST">
                                <input class="form-control" type="hidden" name="_token" value="{{ csrf_token() }}">

                                <input class="form-control" type="hidden" value="{{$id}}" name="agence_id">

                                <div class="form-group">
                                    <input class="form-control" type="text" name="nom" class="form-control" placeholder="Nom du projet">
                                </div>

                                <div class="form-group">
                                    <textarea class="form-control" type="text" name="commentaire" class="form-control" placeholder="Description du projet"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="">Total heures requis</label><br>
                                    <input class="form-control" type="number" name="total_heures">
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">
                                        Ajouter le projet
                                    </button>
                                </div>
                            </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
