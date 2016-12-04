<?php
$user_id = Auth::user()->id;
$statut_id = Auth::user()->statut_id;
$ca_id = 1;
$projets = \App\Projet::where('agence_id', $id)->take(5)->get();
?>
@extends('layouts.application')

@include('agence.model')
