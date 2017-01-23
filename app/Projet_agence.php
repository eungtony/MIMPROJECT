<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Projet_agence extends Model
{
    protected $fillable = ['projet_id', 'agence_id', 'nom_agence'];
}
