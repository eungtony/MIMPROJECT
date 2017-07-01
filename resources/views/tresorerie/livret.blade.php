@extends('layouts.version-2.layouts.app')

@section('content')

    <div class="row mt">
        <div class="col-lg-9">
            <div class="content-panel">
                <h2>Livret de compte de l'association
                    @if(Auth::user()->statut_id == 2)
                        <a href="#money" data-toggle="modal" class="btn btn-success">Ajouter un montant</a>
                    @endif
                </h2>
                <table class="table">
                    <thead>
                    <tr>
                        <td>#</td>
                        <td>Libelle</td>
                        <td>Montant</td>
                        <td>Date</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($livrets as $livret)
                        <tr style="background-color: <?php if ((int)$livret->montant < 0) {
                            echo '#EA0000';
                        } else {
                            echo '#96CA12';
                        } ?>; color:white;">
                            <td>#{{$livret->id}}</td>
                            <td>
                                {{$livret->libelle}}
                            </td>
                            <td>
                                {{$livret->montant}}€
                            </td>
                            <td>
                                {{$livret->created_at}}
                            </td>
                                <td>
                                    <a href="#editlivret{{$livret->id}}"
                                       class="btn btn-primary btn-xs"
                                       data-toggle="modal"><i class="fa fa-pencil"></i></a>
                                    <a href="{{route('delete.montant', $livret->id)}}"
                                       data-method="delete"
                                       data-confirm="Souhaitez-vous réellement supprimer ce montant ?"
                                       class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></a>
                                </td>
                        </tr>
                        @include('tresorerie.edit')
                    @endforeach
                    </tbody>
                </table>
                {{$livrets->links()}}
            </div>
        </div>
        @include('sidebar')
    </div>
@endsection
