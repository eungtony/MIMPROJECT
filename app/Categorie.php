<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    public function tache()
    {
        return $this->hasMany('App/Travail');
    }
}
