@php
	$user_id = Auth::user()->id;
	$statut_id = Auth::user()->statut_id;
	// Visite de la page d'une autre agence
	if (isset($id)) {
		$members = \App\User::where('agence_id', $id)->get();
	}
	$ca_id = 1;
$projets = \App\Projet::where('agence_id', $id)->get();
	$now = \Carbon\Carbon::now();
@endphp

@extends('layouts.version-2.layouts.app')

@include('layouts.version-2.agence.model')
