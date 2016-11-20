<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Projet extends Model
{

    protected $fillable = ['nom', 'commentaire', 'total_heures', 'facturable', 'encaisse', 'heures_faites', 'agence_id', 'etape_id'];

    public function Agence(){
        return $this->belongsTo('App\Agence');
    }

    public function travail(){
        return $this->hasMany('App\Travail');
    }
}
