@php
	$user_id = Auth::user()->id;
	$statut_id = Auth::user()->statut_id;
	// Visite de la page d'une autre agence
	if (isset($id)) {
		$members = \App\User::where('agence_id', $id)->get();
	}
	$ca_id = 1;
	$projets = \App\Projet::where('agence_id', $id)->take(5)->get();
	$now = \Carbon\Carbon::now();
@endphp

@extends('layouts.application')

@include('agence.model')
