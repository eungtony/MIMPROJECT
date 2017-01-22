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

    public function file()
    {
        return $this->hasMany('App\File');
    }

    public function etape()
    {
        return $this->belongsTo('App\Etape');
    }

    public function commentaire()
    {
        return $this->hasMany('App\TacheCommentaire');
    }

    public function devis()
    {
        return $this->hasMany('App\Devis');
    }
}
