@extends('layouts.version-2.layouts.app')

@php
    $total = 0;
@endphp

@section('content')

    <div class="row mt">
        <div class="col-lg-8 col-lg-offset-2 panel">
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
                        <tr>
                            <td>#{{$livret->id}}</td>
                            <td>
                                {{$livret->libelle}}
                            </td>
                            <td>
                                @if ($livret->montant <= 0)
                                    <span class="text-danger">{{ $livret->montant }} €</span>
                                @else
                                    <span class="text-success">{{ $livret->montant }} €</span>
                                @endif
                            </td>
                            @php
                                $total = $total + $livret->montant;
                            @endphp
                            <td>
                                {{$livret->created_at}}
                            </td>
                            @if(Auth::user()->statut_id == 2)
                                <td>
                                    <a href="#editlivret{{$livret->id}}"
                                       class="btn btn-primary btn-xs"
                                       data-toggle="modal"><i class="fa fa-pencil"></i></a>
                                    <a href="{{route('delete.montant', $livret->id)}}"
                                       data-method="delete"
                                       data-confirm="Souhaitez-vous réellement supprimer ce montant ?"
                                       class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></a>
                                </td>
                            @endif
                        </tr>
                        @include('tresorerie.edit')
                    @endforeach
                    </tbody>
                </table>
                {{$livrets->links()}}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2 panel">
            <div class="panel-content">
                <hr>
                <p><strong>SOLDE TOTAL : 

                @if ($total <= 0)
                    <span class="text-danger">
                        {{ $total }} &euro;
                    </span>
                @else 
                    <span class="text-success">
                        {{ $total }} &euro;
                    </span>
                @endif

                </strong></p>
            </div>
        </div>
    </div>
@endsection
